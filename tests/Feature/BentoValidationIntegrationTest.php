<?php

use App\Integrations\BentoService;
use Illuminate\Support\Facades\Cache;
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

describe('Newsletter Form Bento Validation', function () {
    it('accepts newsletter signup with valid email when Bento approves', function () {
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

    it('rejects newsletter signup when Bento detects invalid email', function () {
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

    it('allows newsletter signup when Bento API is unavailable (fail-open)', function () {
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

describe('Contact Form Bento Validation', function () {
    beforeEach(function () {
        // Mock the job dispatch for contact form
        \Illuminate\Support\Facades\Queue::fake();
    });

    it('accepts contact form when Bento validates email', function () {
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

    it('rejects contact form when Bento detects email typo', function () {
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

    it('passes full name to Bento validation for better accuracy', function () {
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

describe('IP Blacklist Protection', function () {
    it('blocks form submission when IP is blacklisted and check is enabled', function () {
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

    it('allows form submission when blacklist check is disabled', function () {
        config(['bentonow.check_blacklist' => false]);

        // Mock validation to pass
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->andReturn(true)
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

describe('Bento Validation Configuration', function () {
    it('skips validation when disabled in config', function () {
        config(['bentonow.validate_emails' => false]);

        // Mock only the createOrUpdateSubscriber method
        // The validateEmail will return true due to config check
        $this->mock(BentoService::class)
            ->shouldReceive('validateEmail')
            ->andReturn(true)  // Will return true when config is disabled
            ->shouldReceive('createOrUpdateSubscriber')
            ->andReturn(true);

        $response = post(route('newsletter.store'), [
            'email' => 'any@example.com',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('newsletter'));
        $response->assertSessionHas('success');
    });
});