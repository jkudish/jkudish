<?php

namespace App\Integrations;

use Bentonow\BentoLaravel\DataTransferObjects\BlacklistStatusData;
use Bentonow\BentoLaravel\DataTransferObjects\EventData;
use Bentonow\BentoLaravel\DataTransferObjects\ImportSubscribersData;
use Bentonow\BentoLaravel\DataTransferObjects\ValidateEmailData;
use Bentonow\BentoLaravel\Facades\Bento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BentoService
{
    private const BROADCASTS_ENDPOINT = 'https://app.bentonow.com/api/v1/fetch/broadcasts';

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

    /**
     * Get all broadcasts from Bento API
     * Returns array of broadcast data filtered for sent broadcasts only
     */
    public function getBroadcasts(): array
    {
        try {
            $broadcasts = collect();
            $page = 1;
            $maxPages = max(1, (int) config('bentonow.broadcasts_max_pages', 50));

            do {
                $response = Http::withBasicAuth(
                    config('bentonow.publishable_key'),
                    config('bentonow.secret_key')
                )
                    ->acceptJson()
                    ->get(self::BROADCASTS_ENDPOINT, [
                        'site_uuid' => config('bentonow.site_uuid'),
                        'page' => $page,
                        'status' => 'sent',
                    ]);

                if (! $response->successful()) {
                    Log::error('Bento getBroadcasts API call failed', [
                        'page' => $page,
                        'status' => $response->status(),
                    ]);

                    if ($broadcasts->isEmpty()) {
                        return [];
                    }

                    break;
                }

                $data = $response->json('data') ?? [];
                $broadcasts = $broadcasts->merge($data);

                if (! empty($data) && $page >= $maxPages) {
                    Log::warning('Bento getBroadcasts stopped at configured page limit', [
                        'max_pages' => $maxPages,
                    ]);

                    break;
                }

                $page++;
            } while (! empty($data));

            // Filter for sent broadcasts and transform to our format
            return $broadcasts
                ->filter(function ($broadcast) {
                    return isset($broadcast['attributes']['sent_final_batch_at'])
                        && $broadcast['attributes']['sent_final_batch_at'] !== null;
                })
                ->map(function ($broadcast) {
                    return [
                        'bento_id' => $broadcast['id'],
                        'name' => $broadcast['attributes']['name'],
                        'subject' => $broadcast['attributes']['template']['subject'] ?? '',
                        'html_content' => $broadcast['attributes']['template']['html'] ?? '',
                        'share_url' => $broadcast['attributes']['share_url'] ?? null,
                        'sent_at' => $broadcast['attributes']['sent_final_batch_at'],
                        'stats' => $broadcast['attributes']['stats'] ?? null,
                    ];
                })
                ->values()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Bento getBroadcasts failed', [
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }

    /**
     * Validate an email address using Bento's validation API
     * Caches results to reduce API calls
     */
    public function validateEmail(string $email, ?string $name = null): bool
    {
        // Skip validation if disabled in config
        if (! config('bentonow.validate_emails', true)) {
            return true;
        }

        // Check cache first
        $cacheKey = 'bento_email_validation:'.md5($email);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $data = new ValidateEmailData(
                emailAddress: $email,
                fullName: $name,
                userAgent: request()->userAgent(),
                ipAddress: request()->ip()
            );

            $response = Bento::validateEmail($data);

            if (! $response->successful()) {
                // Fail open if API is down
                Log::warning('Bento validation API unavailable', [
                    'email' => $email,
                    'status' => $response->status(),
                ]);

                return true;
            }

            $isValid = $response->json('data.valid', true);

            // Cache result - longer for valid emails, shorter for invalid
            $cacheTtl = $isValid
                ? config('bentonow.validation_cache_ttl', 3600)
                : 300; // 5 minutes for invalid emails to allow retry

            Cache::put($cacheKey, $isValid, $cacheTtl);

            if (! $isValid) {
                Log::info('Email failed Bento validation', [
                    'email' => $email,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
            }

            return $isValid;
        } catch (\Exception $e) {
            Log::error('Bento validation exception', [
                'error' => $e->getMessage(),
                'email' => $email,
            ]);

            // Fail open on exception
            return true;
        }
    }

    /**
     * Check if an IP address or domain is blacklisted
     * Returns array with 'clean' status and details
     */
    public function checkBlacklistStatus(?string $ipAddressOrDomain = null): array
    {
        try {
            $target = $ipAddressOrDomain ?? request()->ip();

            // Determine if target is IP or domain
            $isIp = filter_var($target, FILTER_VALIDATE_IP);

            $data = new BlacklistStatusData(
                domain: $isIp ? null : $target,
                ipAddress: $isIp ? $target : null
            );

            $response = Bento::getBlacklistStatus($data);

            if (! $response->successful()) {
                Log::warning('Blacklist check API unavailable', [
                    'target' => $target,
                    'status' => $response->status(),
                ]);

                return ['clean' => true]; // Fail open
            }

            $status = $response->json('data', []);

            // Check if flagged by any service
            $isBlacklisted =
                ($status['spamhaus'] ?? false) ||
                ($status['nordspam'] ?? false) ||
                ($status['spfbl'] ?? false) ||
                ($status['sorbs'] ?? false) ||
                ($status['abusix'] ?? false);

            if ($isBlacklisted) {
                Log::warning('Target flagged in blacklist check', [
                    'target' => $target,
                    'status' => $status,
                ]);
            }

            return [
                'clean' => ! $isBlacklisted,
                'details' => $status,
            ];
        } catch (\Exception $e) {
            Log::error('Blacklist check failed', [
                'error' => $e->getMessage(),
                'target' => $ipAddressOrDomain ?? request()->ip(),
            ]);

            return ['clean' => true]; // Fail open
        }
    }
}
