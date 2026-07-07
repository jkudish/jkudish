<?php

return [
    'secret_key' => env('BENTO_SECRET_KEY'),
    'publishable_key' => env('BENTO_PUBLISHABLE_KEY'),
    'site_uuid' => env('BENTO_SITE_UUID'),

    // Broadcast sync settings
    'broadcasts_max_pages' => env('BENTO_BROADCASTS_MAX_PAGES', 50),

    // Email validation settings
    'validate_emails' => env('BENTO_VALIDATE_EMAILS', true),
    'check_blacklist' => env('BENTO_CHECK_BLACKLIST', false),
    'validation_cache_ttl' => env('BENTO_VALIDATION_CACHE_TTL', 3600),
];
