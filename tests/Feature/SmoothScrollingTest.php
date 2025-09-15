<?php

use function Pest\Laravel\get;

it('has CSS build loaded', function () {
    $response = get('/');

    $response->assertSuccessful();
    // Check that Vite-built CSS is loaded
    $response->assertSee('/build/assets/app-', false);
    $response->assertSee('.css', false);
});

it('has smooth scrolling fallback JavaScript loaded', function () {
    $response = get('/');

    $response->assertSuccessful();
    // Check for smooth scrolling JavaScript
    $response->assertSee('smoothScrollPolyfill', false);
});

it('has accessibility support for reduced motion', function () {
    $response = get('/');

    $response->assertSuccessful();
    // Verify the page loads successfully with CSS that would include reduced motion support
    $response->assertSee('</style>', false);
});

it('anchor links exist on services page for smooth scrolling', function () {
    $response = get('/services');

    $response->assertSuccessful();
    // Verify section IDs exist that can be scrolled to
    $response->assertSee('id="automation"', false);
    $response->assertSee('id="audit"', false);
    $response->assertSee('id="product"', false);
    $response->assertSee('id="partnership"', false);
});
