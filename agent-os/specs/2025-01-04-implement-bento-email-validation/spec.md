# Implement Bento Email Validation

## Overview

Add Bento's email validation API to complement existing Cloudflare Turnstile and rate limiting protections. This will provide an additional layer of spam protection by validating email quality, detecting typos, blocking disposable emails, and checking domain validity before accepting form submissions.

## Goals

- Improve email list quality by catching invalid emails before they enter the system
- Reduce bounce rates and protect sender reputation
- Prevent disposable and temporary email addresses from subscribing
- Detect common email typos (e.g., "gmai.com" instead of "gmail.com")
- Maintain high deliverability rates for legitimate emails

## Technical Approach

### Architecture

1. **Integration Layer**
   - Extend existing `BentoService` class with validation methods
   - Implement graceful fallback if Bento API is unavailable
   - Cache validation results to reduce API calls for repeated attempts

2. **Validation Flow**
   - Validate after Turnstile passes but before processing submission
   - Log all validation failures for monitoring
   - Provide clear user feedback for validation failures

3. **Implementation Points**
   - Newsletter signup form (footer and dedicated page)
   - Contact form email field
   - Optional: IP blacklist checking for suspicious patterns

### Components

#### 1. BentoService Extensions

Add validation methods to `app/Integrations/BentoService.php`:

```php
public function validateEmail(string $email, ?string $name = null): bool
{
    // Check cache first
    $cacheKey = 'bento_email_validation:' . md5($email);
    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }
    
    try {
        $data = new ValidateEmailData(
            emailAddress: $email,
            fullName: $name,
            userAgent: request()->userAgent(),
            ipAddress: request()->ip()
        );
        
        $response = Bento::validateEmail($data);
        
        if (!$response->successful()) {
            // Fail open if API is down
            Log::warning('Bento validation API unavailable', [
                'email' => $email,
                'status' => $response->status()
            ]);
            return true;
        }
        
        $isValid = $response->json('data.valid', true);
        
        // Cache result for 1 hour
        Cache::put($cacheKey, $isValid, 3600);
        
        if (!$isValid) {
            Log::info('Email failed Bento validation', [
                'email' => $email,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        }
        
        return $isValid;
    } catch (\Exception $e) {
        Log::error('Bento validation exception', [
            'error' => $e->getMessage(),
            'email' => $email
        ]);
        
        // Fail open on exception
        return true;
    }
}

public function checkBlacklistStatus(?string $ipAddress = null): array
{
    try {
        $ip = $ipAddress ?? request()->ip();
        
        $data = new BlacklistStatusData(
            ipAddressOrDomain: $ip
        );
        
        $response = Bento::getBlacklistStatus($data);
        
        if (!$response->successful()) {
            return ['clean' => true]; // Fail open
        }
        
        $status = $response->json('data', []);
        
        // Check if flagged by any service
        $isBlacklisted = 
            ($status['spamhaus'] ?? false) ||
            ($status['nordspam'] ?? false) ||
            ($status['spfbl'] ?? false) ||
            ($status['sorbs'] ?? false) ||
            ($status['abusix'] ?? false);
        
        if ($isBlacklisted) {
            Log::warning('IP flagged in blacklist check', [
                'ip' => $ip,
                'status' => $status
            ]);
        }
        
        return [
            'clean' => !$isBlacklisted,
            'details' => $status
        ];
    } catch (\Exception $e) {
        Log::error('Blacklist check failed', [
            'error' => $e->getMessage()
        ]);
        
        return ['clean' => true]; // Fail open
    }
}
```

#### 2. Form Request Validation

Update `app/Http/Requests/NewsletterRequest.php`:

```php
public function authorize(): bool
{
    // Check IP blacklist (optional, low priority)
    if (config('bentonow.check_blacklist', false)) {
        $blacklistCheck = app(BentoService::class)->checkBlacklistStatus();
        if (!$blacklistCheck['clean']) {
            abort(403, 'Your request cannot be processed at this time.');
        }
    }
    
    return true;
}

protected function passedValidation(): void
{
    // Validate email with Bento after Laravel validation passes
    $bentoService = app(BentoService::class);
    
    if (!$bentoService->validateEmail($this->email)) {
        throw ValidationException::withMessages([
            'email' => ['This email address appears to be invalid or temporary. Please use a valid email address.'],
        ]);
    }
}
```

Update `app/Http/Requests/ContactRequest.php`:

```php
protected function passedValidation(): void
{
    // Validate email with Bento
    $bentoService = app(BentoService::class);
    $fullName = trim($this->first_name . ' ' . $this->last_name);
    
    if (!$bentoService->validateEmail($this->email, $fullName)) {
        throw ValidationException::withMessages([
            'email' => ['This email address appears to be invalid. Please check for typos and try again.'],
        ]);
    }
}
```

#### 3. Configuration

Add to `config/bentonow.php`:

```php
return [
    'secret_key' => env('BENTO_SECRET_KEY'),
    'publishable_key' => env('BENTO_PUBLISHABLE_KEY'),
    'site_uuid' => env('BENTO_SITE_UUID'),
    
    // Validation settings
    'validate_emails' => env('BENTO_VALIDATE_EMAILS', true),
    'check_blacklist' => env('BENTO_CHECK_BLACKLIST', false),
    'validation_cache_ttl' => env('BENTO_VALIDATION_CACHE_TTL', 3600),
];
```

#### 4. Testing

Create comprehensive test coverage:

```php
// tests/Feature/BentoValidationTest.php

it('validates legitimate email addresses', function () {
    mock(Bento::class)
        ->shouldReceive('validateEmail')
        ->andReturn(mockResponse(['data' => ['valid' => true]]));
    
    $response = post(route('newsletter.store'), [
        'email' => 'valid@example.com',
        'cf-turnstile-response' => 'test-token',
    ]);
    
    $response->assertSessionHasNoErrors();
});

it('rejects invalid email addresses', function () {
    mock(Bento::class)
        ->shouldReceive('validateEmail')
        ->andReturn(mockResponse(['data' => ['valid' => false]]));
    
    $response = post(route('newsletter.store'), [
        'email' => 'invalid@tempmail.com',
        'cf-turnstile-response' => 'test-token',
    ]);
    
    $response->assertSessionHasErrors(['email']);
});

it('fails open when Bento API is unavailable', function () {
    mock(Bento::class)
        ->shouldReceive('validateEmail')
        ->andThrow(new Exception('API unavailable'));
    
    $response = post(route('newsletter.store'), [
        'email' => 'test@example.com',
        'cf-turnstile-response' => 'test-token',
    ]);
    
    $response->assertSessionHasNoErrors();
});

it('caches validation results', function () {
    Cache::shouldReceive('has')
        ->with('bento_email_validation:' . md5('test@example.com'))
        ->once()
        ->andReturn(true);
    
    Cache::shouldReceive('get')
        ->with('bento_email_validation:' . md5('test@example.com'))
        ->once()
        ->andReturn(true);
    
    // Should not call Bento API due to cache hit
    Bento::shouldReceive('validateEmail')->never();
    
    $service = new BentoService();
    $result = $service->validateEmail('test@example.com');
    
    expect($result)->toBeTrue();
});
```

### User Experience

#### Success Flow
1. User fills out form with email
2. Turnstile validates (bot check)
3. Rate limiting passes
4. Bento validates email quality
5. Form submission succeeds
6. User sees success message

#### Failure Scenarios

**Invalid Email Format:**
- Message: "This email address appears to be invalid. Please check for typos and try again."
- Log: Record validation failure with details

**Disposable Email:**
- Message: "This email address appears to be invalid or temporary. Please use a valid email address."
- Log: Record attempt to use disposable email

**API Unavailable:**
- Action: Fail open (allow submission)
- Log: Warning about API unavailability
- Monitor: Track failure rate

### Security Considerations

1. **Fail Open Strategy**: If Bento API is unavailable, allow submissions to prevent blocking legitimate users
2. **Cache Validation Results**: Reduce API calls and improve performance
3. **Rate Limiting**: Existing rate limits prevent validation API abuse
4. **Logging**: Track all validation failures for security monitoring
5. **No PII in Logs**: Only log email domain patterns, not full addresses in production

### Performance Considerations

1. **Caching Strategy**
   - Cache successful validations for 1 hour
   - Cache failures for 5 minutes (allow retry)
   - Use Redis/cache driver for performance

2. **Async Validation** (Future Enhancement)
   - Could validate in background job for non-critical paths
   - Immediate validation for newsletter signup

3. **API Timeout**
   - Set reasonable timeout (2 seconds)
   - Fail open if timeout exceeded

### Monitoring & Metrics

Track the following metrics:
- Validation pass/fail rates
- API response times
- Cache hit rates
- Types of validation failures (typos vs. disposable)
- Geographic patterns in failures

### Dependencies

- Existing: `bentonow/bento-laravel-sdk` v1.3.1 (already installed)
- No new package dependencies required
- Uses Laravel's built-in cache and logging

## Implementation Priority

1. **Phase 1 - Core Validation** (High Priority)
   - Add validation to newsletter signup
   - Implement BentoService methods
   - Add basic tests

2. **Phase 2 - Contact Form** (Medium Priority)
   - Add validation to contact form
   - Enhance error messages
   - Add monitoring

3. **Phase 3 - Advanced Features** (Low Priority)
   - IP blacklist checking
   - Advanced analytics
   - A/B testing strict vs. lenient validation

## Success Criteria

- [ ] Email validation active on newsletter and contact forms
- [ ] 0% false positive rate for common email providers
- [ ] <2% increase in form abandonment
- [ ] API failures don't block legitimate users
- [ ] All validation failures logged for analysis
- [ ] Comprehensive test coverage (>90%)
- [ ] Performance impact <100ms per validation

## Notes

- Bento's validation is marked as "experimental" - monitor for changes
- Consider implementing Jesse's stricter ruleset after gathering baseline data
- May need to whitelist certain corporate domains if false positives occur
- Consider user feedback mechanism for incorrectly rejected emails