<?php

use Illuminate\Support\Facades\Cache;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

use function Pest\Laravel\mock;
use function Pest\Laravel\post;

beforeEach(function () {
    // Clear any existing rate limit data
    Cache::flush();

    // Mock Turnstile to always pass for these tests
    mock(\RyanChandler\LaravelCloudflareTurnstile\TurnstileClient::class)
        ->shouldReceive('siteverify')
        ->andReturn(new SiteverifyResponse(
            success: true,
            errorCodes: []
        ));
});

it('rate limits contact form submissions to 5 per minute', function () {
    // Make 5 successful requests
    for ($i = 0; $i < 5; $i++) {
        post(route('contact.store'), [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'subject' => 'General Question',
            'message' => 'Test message',
            'cf-turnstile-response' => 'test-token',
        ])->assertSessionHasNoErrors();
    }

    // The 6th request should be rate limited (429 Too Many Requests)
    post(route('contact.store'), [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'subject' => 'General Question',
        'message' => 'Test message',
        'cf-turnstile-response' => 'test-token',
    ])->assertStatus(429);
});

it('rate limits newsletter form submissions to 10 per minute', function () {
    // Make 10 successful requests
    for ($i = 0; $i < 10; $i++) {
        post(route('newsletter.store'), [
            'email' => "test{$i}@example.com",
            'cf-turnstile-response' => 'test-token',
        ])->assertSessionHasNoErrors();
    }

    // The 11th request should be rate limited (429 Too Many Requests)
    post(route('newsletter.store'), [
        'email' => 'test11@example.com',
        'cf-turnstile-response' => 'test-token',
    ])->assertStatus(429);
});

it('resets rate limit after one minute', function () {
    // Make 5 contact form requests to hit the limit
    for ($i = 0; $i < 5; $i++) {
        post(route('contact.store'), [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'subject' => 'General Question',
            'message' => 'Test message',
            'cf-turnstile-response' => 'test-token',
        ])->assertSessionHasNoErrors();
    }

    // Should be rate limited
    post(route('contact.store'), [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'subject' => 'General Question',
        'message' => 'Test message',
        'cf-turnstile-response' => 'test-token',
    ])->assertStatus(429);

    // Travel forward in time by 61 seconds
    $this->travel(61)->seconds();

    // Should be allowed again
    post(route('contact.store'), [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'subject' => 'General Question',
        'message' => 'Test message',
        'cf-turnstile-response' => 'test-token',
    ])->assertSessionHasNoErrors();
});

it('tracks rate limits per IP address', function () {
    // Make 5 requests from one IP
    for ($i = 0; $i < 5; $i++) {
        post(route('contact.store'), [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'subject' => 'General Question',
            'message' => 'Test message',
            'cf-turnstile-response' => 'test-token',
        ], ['REMOTE_ADDR' => '192.168.1.1'])->assertSessionHasNoErrors();
    }

    // 6th request from same IP should be rate limited
    post(route('contact.store'), [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'subject' => 'General Question',
        'message' => 'Test message',
        'cf-turnstile-response' => 'test-token',
    ], ['REMOTE_ADDR' => '192.168.1.1'])->assertStatus(429);

    // Request from different IP should work
    post(route('contact.store'), [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'subject' => 'General Question',
        'message' => 'Test message',
        'cf-turnstile-response' => 'test-token',
    ], ['REMOTE_ADDR' => '192.168.1.2'])->assertSessionHasNoErrors();
});
