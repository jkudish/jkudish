<?php

use App\Integrations\BentoService;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile;

beforeEach(function () {
    Turnstile::fake();
});

it('shows the newsletter page with updated Human in the Loop branding', function () {
    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Human in the Loop');
    $response->assertSee('Monthly-ish');
    $response->assertDontSee('Maker Notes');
    $response->assertDontSee('Every two weeks');
    $response->assertSee('AI', false);
    $response->assertSee('newsletter', false);
});

it('subscribes to newsletter with valid email', function () {
    $this->mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true)
        ->shouldReceive('createOrUpdateSubscriber')
        ->once()
        ->withArgs(fn (string $email, ?string $firstName, ?string $lastName, array $tags, array $fields): bool => $email === 'test@example.com'
            && $firstName === null
            && $lastName === null
            && $tags === ['Human in the Loop']
            && $fields['source'] === 'newsletter_form')
        ->andReturn(true);

    $response = $this->post('/newsletter', [
        'email' => 'test@example.com',
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertRedirect('/newsletter');
    $response->assertSessionHas('success');
    $response->assertSessionHas('visitor_email', 'test@example.com');
});

it('validates email is required for newsletter', function () {
    $response = $this->post('/newsletter', [
        'email' => '',
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertSessionHasErrors(['email']);
});

it('validates email format for newsletter', function () {
    $response = $this->post('/newsletter', [
        'email' => 'invalid-email',
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertSessionHasErrors(['email']);
});

it('handles Bento API failure gracefully', function () {
    // Override the mock for this test
    $this->mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true)
        ->shouldReceive('createOrUpdateSubscriber')
        ->andReturn(false);

    $response = $this->post('/newsletter', [
        'email' => 'test@example.com',
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertRedirect('/newsletter');
    $response->assertSessionHas('error');
});
