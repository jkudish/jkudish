<?php

use function Pest\Laravel\get;

it('has favicon.ico in public root', function () {
    $path = public_path('favicon.ico');
    expect($path)->toBeFile();
    expect(filesize($path))->toBeLessThan(20480); // Less than 20KB
});

it('has SVG favicon', function () {
    $path = public_path('img/favicon/favicon.svg');
    expect($path)->toBeFile();
    expect(filesize($path))->toBeLessThan(2048); // Less than 2KB
});

it('has all required PNG favicon sizes', function () {
    $sizes = [
        'favicon-16x16.png' => 16,
        'favicon-32x32.png' => 32,
        'favicon-96x96.png' => 96,
        'apple-touch-icon.png' => 180,
        'android-chrome-192x192.png' => 192,
        'android-chrome-512x512.png' => 512,
    ];

    foreach ($sizes as $filename => $expectedSize) {
        $path = public_path("img/favicon/{$filename}");
        expect($path)->toBeFile()
            ->and(filesize($path))->toBeLessThan(51200); // Less than 50KB each
    }
});

it('has all favicon files accessible', function () {
    // Test ICO file exists
    expect(public_path('favicon.ico'))->toBeFile();

    // Test SVG file exists
    expect(public_path('img/favicon/favicon.svg'))->toBeFile();

    // Test PNG files exist
    $pngFiles = [
        'favicon-16x16.png',
        'favicon-32x32.png',
        'favicon-96x96.png',
        'apple-touch-icon.png',
        'android-chrome-192x192.png',
        'android-chrome-512x512.png',
    ];

    foreach ($pngFiles as $file) {
        expect(public_path("img/favicon/{$file}"))->toBeFile();
    }
});

it('includes favicon meta tags in HTML', function () {
    $response = get('/');

    $response->assertOk()
        ->assertSee('rel="icon" type="image/svg+xml"', false)
        ->assertSee('favicon.svg', false)
        ->assertSee('rel="icon" type="image/png" sizes="32x32"', false)
        ->assertSee('favicon-32x32.png', false)
        ->assertSee('rel="icon" type="image/png" sizes="16x16"', false)
        ->assertSee('favicon-16x16.png', false)
        ->assertSee('rel="shortcut icon"', false)
        ->assertSee('favicon.ico', false)
        ->assertSee('rel="apple-touch-icon"', false)
        ->assertSee('apple-touch-icon.png', false)
        ->assertSee('android-chrome-192x192.png', false)
        ->assertSee('android-chrome-512x512.png', false)
        ->assertSee('name="theme-color" content="#000000"', false);
});

it('includes favicon meta tags on all pages', function () {
    $pages = [
        '/',
        '/speaking',
    ];

    foreach ($pages as $page) {
        $response = get($page);

        $response->assertOk()
            ->assertSee('favicon.svg', false)
            ->assertSee('favicon.ico', false)
            ->assertSee('apple-touch-icon.png', false);
    }
});

it('has correct total file size for all favicon assets', function () {
    $totalSize = 0;

    // ICO file
    $totalSize += filesize(public_path('favicon.ico'));

    // SVG file
    $totalSize += filesize(public_path('img/favicon/favicon.svg'));

    // PNG files
    $pngFiles = [
        'favicon-16x16.png',
        'favicon-32x32.png',
        'favicon-96x96.png',
        'apple-touch-icon.png',
        'android-chrome-192x192.png',
        'android-chrome-512x512.png',
    ];

    foreach ($pngFiles as $file) {
        $totalSize += filesize(public_path("img/favicon/{$file}"));
    }

    // Total should be less than 100KB for all favicon assets
    expect($totalSize)->toBeLessThan(102400);
});
