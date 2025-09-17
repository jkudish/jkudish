<?php

namespace App\Jobs;

use App\Integrations\BentoService;
use App\Mail\ContactFormNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessContactFormSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $formData
    ) {}

    /**
     * Execute the job.
     */
    public function handle(BentoService $bentoService): void
    {
        // Build tags array - always include "Lead" tag
        $tags = ['Lead'];
        if ($this->formData['newsletter_opt_in']) {
            $tags[] = 'Maker Notes';
        }

        // Create/update subscriber with all form data as custom fields
        $bentoService->createOrUpdateSubscriber(
            email: $this->formData['email'],
            firstName: $this->formData['first_name'],
            lastName: $this->formData['last_name'],
            tags: $tags,
            fields: [
                'source' => 'contact_form',
                'subject' => $this->formData['subject'],
                'message' => $this->formData['message'],
                'newsletter_opt_in' => $this->formData['newsletter_opt_in'] ? 'yes' : 'no',
                'subscribed' => $this->formData['newsletter_opt_in'] ? true : false,
                'unsubscribed_at' => !$this->formData['newsletter_opt_in'] ? now()->toDateTimeString() : null,
                'submitted_at' => now()->toDateTimeString(),
            ]
        );

        // Track contact form event with all details
        $bentoService->trackEvent(
            type: '$contact_form_submitted',
            email: $this->formData['email'],
            details: [
                'first_name' => $this->formData['first_name'],
                'last_name' => $this->formData['last_name'],
                'subject' => $this->formData['subject'],
                'message' => $this->formData['message'],
                'newsletter_opt_in' => $this->formData['newsletter_opt_in'],
            ]
        );

        // Send email notification to joey@jkudish.com
        Mail::to('joey+contactform@jkudish.com')->send(
            new ContactFormNotification($this->formData)
        );
    }
}
