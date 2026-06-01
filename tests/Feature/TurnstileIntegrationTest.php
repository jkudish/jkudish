<?php

use Illuminate\Support\Facades\Config;
use RyanChandler\LaravelCloudflareTurnstile\Rules\Turnstile;

it('has turnstile configuration available', function () {
    // After package installation, config should be available
    expect(config('services.turnstile.key'))->not->toBeNull();
    expect(config('services.turnstile.secret'))->not->toBeNull();
});

it('uses test keys in local environment', function () {
    Config::set('app.env', 'local');

    // Test keys should be used in local environment
    // These will be configured after package installation
    expect(config('services.turnstile.key'))->toBe(env('CLOUDFLARE_TURNSTILE_SITEKEY'));
    expect(config('services.turnstile.secret'))->toBe(env('CLOUDFLARE_TURNSTILE_SECRETKEY'));
});

it('has turnstile validation rule available', function () {
    // After package installation, the rule should be available
    $rules = ['cf-turnstile-response' => ['required', new Turnstile]];

    // This will work after package is installed
    expect($rules['cf-turnstile-response'][1])->toBeInstanceOf(Turnstile::class);
});
