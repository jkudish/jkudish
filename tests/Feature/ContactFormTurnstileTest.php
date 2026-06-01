<?php

use App\Integrations\BentoService;
use Illuminate\Support\Facades\Queue;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile;

use function Pest\Laravel\mock;

beforeEach(function () {
    Queue::fake();
});

it('requires turnstile validation on contact form submission', function () {
    $response = $this->post(route('contact.store'), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'General Question',
        'message' => 'This is a test message',
        // Missing cf-turnstile-response field
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
});

it('fails with invalid turnstile token', function () {
    Turnstile::fake()->fail();

    $response = $this->post(route('contact.store'), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'General Question',
        'message' => 'This is a test message',
        'cf-turnstile-response' => 'invalid-token',
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
});

it('accepts valid turnstile token', function () {
    Turnstile::fake();

    // Mock BentoService for email validation
    mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true);

    $response = $this->post(route('contact.store'), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'General Question',
        'message' => 'This is a test message',
        'cf-turnstile-response' => 'valid-token',
    ]);

    $response->assertRedirect(route('contact'));
    $response->assertSessionHas('success');
});

it('maintains existing honeypot protection alongside turnstile', function () {
    // Even with valid Turnstile, honeypot should still work
    Turnstile::fake();

    // Mock BentoService (though honeypot should prevent it from being called)
    mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true);

    $response = $this->post(route('contact.store'), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'General Question',
        'message' => 'This is a test message',
        'cf-turnstile-response' => 'valid-token',
        'website' => 'https://spam-site.com', // Honeypot field filled (indicates spam)
    ]);

    // Should redirect without success message (silent rejection)
    $response->assertRedirect(route('contact'));
    $response->assertSessionMissing('success');
});
