<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

it('generates a new API key with --generate-key flag', function () {
    config(['services.indexnow.key' => null]);

    $this->artisan('indexnow:submit', ['--generate-key' => true])
        ->expectsOutput('IndexNow API key generated successfully!')
        ->expectsOutputToContain('Key saved to INDEXNOW_KEY environment variable')
        ->expectsOutputToContain('Verification file created at: public/')
        ->assertSuccessful();

    // Check that a key was set in config
    $key = config('services.indexnow.key');
    expect($key)->toBeString();
    expect(strlen($key))->toBe(32);
    expect($key)->toMatch('/^[a-zA-Z0-9]+$/');

    // Check verification file was created
    $verificationFile = public_path($key.'.txt');
    expect(File::exists($verificationFile))->toBeTrue();
    expect(File::get($verificationFile))->toBe($key);

    // Cleanup
    File::delete($verificationFile);
});

it('submits URL to IndexNow with valid key', function () {
    $testKey = Str::random(32);
    config(['services.indexnow.key' => $testKey]);
    config(['app.url' => 'https://example.com']);

    Http::fake([
        'https://www.bing.com/indexnow' => Http::response(null, 200),
    ]);

    $this->artisan('indexnow:submit', ['url' => 'https://example.com/test-page'])
        ->expectsOutput('✓ URL submitted successfully to IndexNow!')
        ->expectsOutput('URL: https://example.com/test-page')
        ->expectsOutputToContain('This URL will be shared with: Bing, Yandex, Seznam, and Naver')
        ->assertSuccessful();

    Http::assertSent(function ($request) use ($testKey) {
        return $request->url() === 'https://www.bing.com/indexnow' &&
               $request['host'] === 'example.com' &&
               $request['key'] === $testKey &&
               $request['keyLocation'] === 'https://example.com/'.$testKey.'.txt' &&
               $request['urlList'] === ['https://example.com/test-page'];
    });
});

it('defaults to APP_URL when no URL provided', function () {
    $testKey = Str::random(32);
    config(['services.indexnow.key' => $testKey]);
    config(['app.url' => 'https://example.com']);

    Http::fake([
        'https://www.bing.com/indexnow' => Http::response(null, 200),
    ]);

    $this->artisan('indexnow:submit')
        ->expectsOutput('✓ URL submitted successfully to IndexNow!')
        ->expectsOutput('URL: https://example.com')
        ->assertSuccessful();

    Http::assertSent(function ($request) {
        return $request['urlList'] === ['https://example.com'];
    });
});

it('handles 403 invalid key error', function () {
    config(['services.indexnow.key' => 'invalid-key']);

    Http::fake([
        'https://www.bing.com/indexnow' => Http::response(null, 403),
    ]);

    $this->artisan('indexnow:submit')
        ->expectsOutput('✗ Invalid API key (403)')
        ->expectsOutput('Please generate a new key with: php artisan indexnow:submit --generate-key')
        ->assertFailed();
});

it('handles 422 URL mismatch error', function () {
    config(['services.indexnow.key' => Str::random(32)]);
    config(['app.url' => 'https://example.com']);

    Http::fake([
        'https://www.bing.com/indexnow' => Http::response(null, 422),
    ]);

    $this->artisan('indexnow:submit', ['url' => 'https://different-domain.com'])
        ->expectsOutput('✗ URL domain mismatch (422)')
        ->expectsOutput('The URL domain must match your application domain.')
        ->assertFailed();
});

it('handles 429 rate limit error', function () {
    config(['services.indexnow.key' => Str::random(32)]);

    Http::fake([
        'https://www.bing.com/indexnow' => Http::response(null, 429),
    ]);

    $this->artisan('indexnow:submit')
        ->expectsOutput('✗ Rate limit exceeded (429)')
        ->expectsOutput('Please wait before submitting more URLs.')
        ->assertFailed();
});

it('requires API key to submit URLs', function () {
    config(['services.indexnow.key' => null]);

    $this->artisan('indexnow:submit')
        ->expectsOutput('✗ No IndexNow API key configured.')
        ->expectsOutput('Generate one with: php artisan indexnow:submit --generate-key')
        ->assertFailed();
});

it('validates URL format', function () {
    config(['services.indexnow.key' => Str::random(32)]);

    $this->artisan('indexnow:submit', ['url' => 'not-a-valid-url'])
        ->expectsOutput('✗ Invalid URL format.')
        ->expectsOutput('Please provide a valid URL starting with http:// or https://')
        ->assertFailed();
});

it('creates verification file in correct location with correct content', function () {
    config(['services.indexnow.key' => null]);

    $this->artisan('indexnow:submit', ['--generate-key' => true])
        ->assertSuccessful();

    $key = config('services.indexnow.key');
    $verificationFile = public_path($key.'.txt');

    expect(File::exists($verificationFile))->toBeTrue();
    expect(File::get($verificationFile))->toBe($key);
    expect(strlen(File::get($verificationFile)))->toBe(32);

    // Cleanup
    File::delete($verificationFile);
});

it('overwrites existing verification file when regenerating key', function () {
    // Create initial key and file
    $oldKey = Str::random(32);
    config(['services.indexnow.key' => $oldKey]);
    $oldFile = public_path($oldKey.'.txt');
    File::put($oldFile, $oldKey);

    // Generate new key
    $this->artisan('indexnow:submit', ['--generate-key' => true])
        ->assertSuccessful();

    $newKey = config('services.indexnow.key');
    $newFile = public_path($newKey.'.txt');

    // Old file should be gone, new file should exist
    expect(File::exists($oldFile))->toBeFalse();
    expect(File::exists($newFile))->toBeTrue();
    expect(File::get($newFile))->toBe($newKey);

    // Cleanup
    File::delete($newFile);
});
