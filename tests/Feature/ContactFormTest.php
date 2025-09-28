<?php

use App\Jobs\ProcessContactFormSubmission;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    Queue::fake();
});

it('shows the contact page', function () {
    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertSee('Get in Touch');
    $response->assertSee('Receive Human in the Loop newsletter');
});

it('submits contact form with newsletter opt-in', function () {
    $response = $this->post('/contact', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'subject' => 'Project Inquiry',
        'message' => 'I have a project for you.',
        'newsletter_opt_in' => true,
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
    $response = $this->post('/contact', [
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'email' => 'jane@example.com',
        'subject' => 'General Question',
        'message' => 'I have a question about your services.',
        'newsletter_opt_in' => false,
    ]);

    $response->assertRedirect('/contact');
    $response->assertSessionHas('success');

    Queue::assertPushed(ProcessContactFormSubmission::class, function ($job) {
        return $job->formData['email'] === 'jane@example.com' &&
               $job->formData['newsletter_opt_in'] === false;
    });
});

it('rejects spam submissions with honeypot field', function () {
    $response = $this->post('/contact', [
        'first_name' => 'Spam',
        'last_name' => 'Bot',
        'email' => 'spam@bot.com',
        'subject' => 'Spam',
        'message' => 'This is spam.',
        'website' => 'http://spam.com', // Honeypot field filled
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
    ]);
});

it('validates email format', function () {
    $response = $this->post('/contact', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'invalid-email',
        'subject' => 'Test',
        'message' => 'Test message here.',
    ]);

    $response->assertSessionHasErrors(['email']);
});
