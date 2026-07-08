<?php

use App\Integrations\BentoService;
use App\Jobs\ProcessContactFormSubmission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile;

beforeEach(function () {
    Queue::fake();

    Turnstile::fake();
});

it('shows the contact page', function () {
    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertSee('Get in Touch');
    $response->assertSee('Receive Human in the Loop newsletter');
});

it('submits contact form with newsletter opt-in', function () {
    // Mock Bento validation
    $this->mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true);

    $response = $this->post('/contact', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'Project Inquiry',
        'message' => 'I have a project for you.',
        'newsletter_opt_in' => true,
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertRedirect('/contact');
    $response->assertSessionHas('success');
    $response->assertSessionHas('visitor_email', 'john@example.com');

    Queue::assertPushed(ProcessContactFormSubmission::class, function ($job) {
        return $job->formData['email'] === 'john@example.com' &&
               $job->formData['newsletter_opt_in'] === true;
    });
});

it('submits contact form without newsletter opt-in', function () {
    // Mock Bento validation
    $this->mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true);

    $response = $this->post('/contact', [
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'email' => 'jane@example.com',
        'subject' => 'General Question',
        'message' => 'I have a question about your services.',
        'newsletter_opt_in' => false,
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertRedirect('/contact');
    $response->assertSessionHas('success');

    Queue::assertPushed(ProcessContactFormSubmission::class, function ($job) {
        return $job->formData['email'] === 'jane@example.com' &&
               $job->formData['newsletter_opt_in'] === false;
    });
});

it('tags contact newsletter opt-ins as Human in the Loop', function () {
    Mail::fake();

    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('createOrUpdateSubscriber')
        ->once()
        ->withArgs(fn (string $email, string $firstName, string $lastName, array $tags, array $fields): bool => $email === 'john@example.com'
            && $firstName === 'John'
            && $lastName === 'Doe'
            && $tags === ['Lead', 'Human in the Loop']
            && $fields['newsletter_opt_in'] === 'yes')
        ->andReturn(true);
    $bentoService->shouldReceive('trackEvent')
        ->once();

    (new ProcessContactFormSubmission([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'Project Inquiry',
        'message' => 'I have a project for you.',
        'newsletter_opt_in' => true,
    ]))->handle($bentoService);
});

it('rejects spam submissions with honeypot field', function () {
    // Mock Bento validation (even though honeypot will prevent it from being called)
    $this->mock(BentoService::class)
        ->shouldReceive('validateEmail')
        ->andReturn(true);

    $response = $this->post('/contact', [
        'first_name' => 'Spam',
        'last_name' => 'Bot',
        'email' => 'spam@bot.com',
        'subject' => 'Spam',
        'message' => 'This is spam.',
        'website' => 'http://spam.com', // Honeypot field filled
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertRedirect('/contact');
    $response->assertSessionMissing('success');

    Queue::assertNothingPushed();
});

it('validates required fields', function () {
    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors([
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
        'cf-turnstile-response',
    ]);
});

it('validates email format', function () {
    // No need to mock Bento validation since Laravel validation will fail first
    $response = $this->post('/contact', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'invalid-email',
        'subject' => 'Test',
        'message' => 'Test message here.',
        'cf-turnstile-response' => 'test-token',
    ]);

    $response->assertSessionHasErrors(['email']);
});
