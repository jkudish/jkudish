<?php

use App\Integrations\BentoService;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile;

use function Pest\Laravel\mock;

it('requires turnstile validation on newsletter form submission', function () {
    $response = $this->post(route('newsletter.store'), [
        'email' => 'john@example.com',
        // Missing cf-turnstile-response field
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
});

it('fails newsletter signup with invalid turnstile token', function () {
    Turnstile::fake()->fail();

    $response = $this->post(route('newsletter.store'), [
        'email' => 'john@example.com',
        'cf-turnstile-response' => 'invalid-token',
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
});

it('accepts newsletter signup with valid turnstile token', function () {
    Turnstile::fake();

    // Mock BentoService to avoid actual API calls
    mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true)
        ->shouldReceive('createOrUpdateSubscriber')
        ->once()
        ->andReturn(true);

    $response = $this->post(route('newsletter.store'), [
        'email' => 'john@example.com',
        'cf-turnstile-response' => 'valid-token',
    ]);

    $response->assertRedirect(route('newsletter'));
    $response->assertSessionHas('success');
});

it('handles turnstile validation on AJAX newsletter submissions', function () {
    Turnstile::fake()->fail();

    $response = $this->postJson(route('newsletter.store'), [
        'email' => 'john@example.com',
        'cf-turnstile-response' => 'invalid-token',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('cf-turnstile-response');
});

it('accepts AJAX newsletter signup with valid turnstile', function () {
    Turnstile::fake();

    // Mock BentoService to avoid actual API calls
    mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true)
        ->shouldReceive('createOrUpdateSubscriber')
        ->once()
        ->andReturn(true);

    $response = $this->postJson(route('newsletter.store'), [
        'email' => 'john@example.com',
        'cf-turnstile-response' => 'valid-token',
    ]);

    $response->assertSuccessful();
    $response->assertJson([
        'success' => true,
        'message' => 'Welcome to Human in the Loop! You\'ll receive the first issue right away.',
    ]);
});
