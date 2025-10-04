<?php

use App\Integrations\BentoService;
use Bentonow\BentoLaravel\Facades\Bento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

use function Pest\Laravel\mock;
use function Pest\Laravel\post;

beforeEach(function () {
    // Clear cache before each test
    Cache::flush();
    
    // Mock Turnstile to always pass for validation tests
    mock(\RyanChandler\LaravelCloudflareTurnstile\TurnstileClient::class)
        ->shouldReceive('siteverify')
        ->andReturn(new SiteverifyResponse(
            success: true,
            errorCodes: []
        ));
});

describe('BentoService Email Validation', function () {
    it('validates legitimate email addresses', function () {
        // Mock Bento facade
        Bento::shouldReceive('validateEmail')
            ->once()
            ->andReturn(Http::response(['data' => ['valid' => true]], 200));

        $service = new BentoService();
        $result = $service->validateEmail('valid@example.com');

        expect($result)->toBeTrue();
    });

    it('rejects invalid email addresses', function () {
        // Mock Bento facade
        Bento::shouldReceive('validateEmail')
            ->once()
            ->andReturn(Http::response(['data' => ['valid' => false]], 200));

        $service = new BentoService();
        $result = $service->validateEmail('invalid@tempmail.com');

        expect($result)->toBeFalse();
    });

    it('fails open when Bento API is unavailable', function () {
        // Mock Bento API to return error
        Bento::shouldReceive('validateEmail')
            ->once()
            ->andReturn(Http::response('Server Error', 500));

        $service = new BentoService();
        $result = $service->validateEmail('test@example.com');

        // Should return true (fail open) when API is down
        expect($result)->toBeTrue();
    });

    it('caches validation results', function () {
        // Mock Bento API - should only be called once
        Bento::shouldReceive('validateEmail')
            ->once() // Only called once due to caching
            ->andReturn(Http::response(['data' => ['valid' => true]], 200));

        $service = new BentoService();
        
        // First call - should hit API
        $result1 = $service->validateEmail('cached@example.com');
        expect($result1)->toBeTrue();
        
        // Second call - should use cache
        $result2 = $service->validateEmail('cached@example.com');
        expect($result2)->toBeTrue();
        
        // Verify cache was used
        expect(Cache::has('bento_email_validation:' . md5('cached@example.com')))->toBeTrue();
    });

    it('respects validation disabled config', function () {
        config(['bentonow.validate_emails' => false]);

        // Should not call Bento API when validation is disabled
        Bento::shouldReceive('validateEmail')->never();

        $service = new BentoService();
        $result = $service->validateEmail('any@example.com');

        expect($result)->toBeTrue();
    });

    it('handles exception gracefully', function () {
        // Mock Bento to throw exception
        Bento::shouldReceive('validateEmail')
            ->once()
            ->andThrow(new \Exception('API Error'));

        $service = new BentoService();
        $result = $service->validateEmail('test@example.com');

        // Should return true (fail open) on exception
        expect($result)->toBeTrue();
    });
});

describe('Newsletter Form with Bento Validation', function () {
    it('accepts newsletter signup with valid email', function () {
        // Mock BentoService methods
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->with('valid@example.com')
            ->andReturn(true)
            ->shouldReceive('createOrUpdateSubscriber')
            ->andReturn(true);

        $response = post(route('newsletter.store'), [
            'email' => 'valid@example.com',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('newsletter'));
        $response->assertSessionHas('success');
    });

    it('rejects newsletter signup with invalid email', function () {
        // Mock Bento validation to fail
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->with('invalid@tempmail.com')
            ->andReturn(false);

        $response = post(route('newsletter.store'), [
            'email' => 'invalid@tempmail.com',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        expect($errors[0])->toContain('invalid or temporary');
    });

    it('accepts newsletter signup when Bento API is down', function () {
        // Mock Bento API to fail but return true (fail open)
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->andReturn(true) // Fail open
            ->shouldReceive('createOrUpdateSubscriber')
            ->andReturn(true);

        $response = post(route('newsletter.store'), [
            'email' => 'test@example.com',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('newsletter'));
        $response->assertSessionHas('success');
    });
});

describe('Contact Form with Bento Validation', function () {
    beforeEach(function () {
        // Mock the job dispatch for contact form
        \Illuminate\Support\Facades\Queue::fake();
    });

    it('accepts contact form with valid email', function () {
        // Mock Bento validation to pass
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->with('john@example.com', 'John Doe')
            ->andReturn(true);

        $response = post(route('contact.store'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'subject' => 'General Question',
            'message' => 'This is a test message',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');
    });

    it('rejects contact form with invalid email', function () {
        // Mock Bento validation to fail
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->with('typo@gmai.com', 'Jane Smith')
            ->andReturn(false);

        $response = post(route('contact.store'), [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'typo@gmai.com',
            'subject' => 'General Question',
            'message' => 'This is a test message',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        expect($errors[0])->toContain('check for typos');
    });

    it('includes full name in validation request', function () {
        // Mock to verify full name is passed
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->with('test@example.com', 'Alice Johnson')
            ->once()
            ->andReturn(true);

        $response = post(route('contact.store'), [
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'test@example.com',
            'subject' => 'Test',
            'message' => 'Test message',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('contact'));
    });
});

describe('Blacklist Status Check', function () {
    it('checks IP blacklist status', function () {
        // Mock Bento facade
        Bento::shouldReceive('getBlacklistStatus')
            ->once()
            ->andReturn(Http::response([
                'data' => [
                    'spamhaus' => false,
                    'nordspam' => false,
                    'spfbl' => false,
                    'sorbs' => false,
                    'abusix' => false,
                ]
            ], 200));

        $service = new BentoService();
        $result = $service->checkBlacklistStatus('192.168.1.1');

        expect($result['clean'])->toBeTrue();
        expect($result['details'])->toBeArray();
    });

    it('detects blacklisted IP', function () {
        // Mock Bento API to return blacklisted
        Bento::shouldReceive('getBlacklistStatus')
            ->once()
            ->andReturn(Http::response([
                'data' => [
                    'spamhaus' => true, // Blacklisted!
                    'nordspam' => false,
                    'spfbl' => false,
                    'sorbs' => false,
                    'abusix' => false,
                ]
            ], 200));

        $service = new BentoService();
        $result = $service->checkBlacklistStatus('192.168.1.1');

        expect($result['clean'])->toBeFalse();
        expect($result['details']['spamhaus'])->toBeTrue();
    });

    it('fails open when blacklist API is unavailable', function () {
        // Mock Bento API to return error
        Bento::shouldReceive('getBlacklistStatus')
            ->once()
            ->andReturn(Http::response('Server Error', 500));

        $service = new BentoService();
        $result = $service->checkBlacklistStatus('192.168.1.1');

        // Should return clean (fail open) when API is down
        expect($result['clean'])->toBeTrue();
    });

    it('blocks form submission when IP is blacklisted', function () {
        config(['bentonow.check_blacklist' => true]);

        // Mock blacklist check to return blacklisted
        $this->mock(BentoService::class)
            ->shouldReceive('checkBlacklistStatus')
            ->andReturn(['clean' => false, 'details' => ['spamhaus' => true]]);

        $response = post(route('newsletter.store'), [
            'email' => 'test@example.com',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertStatus(403);
        $response->assertSee('Your request cannot be processed');
    });
});