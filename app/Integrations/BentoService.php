<?php

namespace App\Integrations;

use Bentonow\BentoLaravel\DataTransferObjects\EventData;
use Bentonow\BentoLaravel\DataTransferObjects\ImportSubscribersData;
use Bentonow\BentoLaravel\Facades\Bento;
use Illuminate\Support\Facades\Log;

class BentoService
{
    /**
     * Track a pageview event
     */
    public function trackPageView(string $url, ?string $email = null): void
    {
        try {
            if (! $email) {
                return; // Skip tracking if no email
            }

            $data = collect([
                new EventData(
                    type: '$pageView',
                    email: $email,
                    details: [
                        'url' => $url,
                        'timestamp' => now()->toIso8601String(),
                    ]
                ),
            ]);

            Bento::trackEvent($data);
        } catch (\Exception $e) {
            Log::error('Bento pageview tracking failed', [
                'error' => $e->getMessage(),
                'url' => $url,
                'email' => $email,
            ]);
        }
    }

    /**
     * Create or update a subscriber with tags and custom fields
     */
    public function createOrUpdateSubscriber(
        string $email,
        ?string $firstName = null,
        ?string $lastName = null,
        array $tags = [],
        array $fields = []
    ): bool {
        try {
            $data = collect([
                new ImportSubscribersData(
                    email: $email,
                    firstName: $firstName ?? '',
                    lastName: $lastName ?? '',
                    tags: $tags,
                    removeTags: [],
                    fields: $fields
                ),
            ]);

            $response = Bento::importSubscribers($data);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Bento subscriber creation/update failed', [
                'error' => $e->getMessage(),
                'email' => $email,
                'tags' => $tags,
            ]);

            return false;
        }
    }

    /**
     * Track a custom event
     */
    public function trackEvent(
        string $type,
        string $email,
        array $details = []
    ): void {
        try {
            $data = collect([
                new EventData(
                    type: $type,
                    email: $email,
                    details: array_merge($details, [
                        'timestamp' => now()->toIso8601String(),
                    ])
                ),
            ]);

            Bento::trackEvent($data);
        } catch (\Exception $e) {
            Log::error('Bento event tracking failed', [
                'error' => $e->getMessage(),
                'type' => $type,
                'email' => $email,
                'details' => $details,
            ]);
        }
    }
}
