<?php

use function Pest\Laravel\get;

it('returns 404 status code for non-existent pages', function () {
    get('/this-page-does-not-exist')
        ->assertStatus(404);
});

it('displays the custom 404 page with proper layout', function () {
    get('/non-existent-page')
        ->assertStatus(404)
        ->assertSee('404', false)
        ->assertSee('Page Not Found', false)
        ->assertSee('<html lang=', false);
});

it('shows the 404 error message and content', function () {
    $response = get('/page-that-does-not-exist');
    
    $response->assertStatus(404)
        ->assertSee('404', false)
        ->assertSee('Oops!', false)
        ->assertSee('lost', false);
});

it('includes navigation buttons to help users', function () {
    $response = get('/missing-page');
    
    $response->assertStatus(404)
        ->assertSee('Back to Homepage', false)
        ->assertSee('href="/"', false)
        ->assertSee('Services', false)
        ->assertSee('Speaking', false);
});

it('includes helpful guidance text', function () {
    get('/another-404-page')
        ->assertStatus(404)
        ->assertSee('explore', false);
});

it('maintains site navigation in header', function () {
    $response = get('/404-test-page');
    
    $response->assertStatus(404)
        ->assertSee('<nav', false)
        ->assertSee('Joey Kudish', false);
});

it('maintains site footer', function () {
    get('/test-404')
        ->assertStatus(404)
        ->assertSee('<footer', false);
});

it('includes proper SEO meta tags for 404 pages', function () {
    $response = get('/seo-404-test');
    
    $response->assertStatus(404)
        ->assertSee('<meta name="robots" content="noindex', false);
});

it('supports dark mode styling', function () {
    get('/dark-mode-404')
        ->assertStatus(404)
        ->assertSee('dark:', false);
});

it('includes Fathom Analytics tracking script', function () {
    get('/analytics-404-test')
        ->assertStatus(404)
        ->assertSee('fathom', false);
});

it('handles various URL patterns correctly', function ($url) {
    get($url)->assertStatus(404);
})->with([
    '/does-not-exist',
    '/blog/missing-post',
    '/category/subcategory/missing',
    '/missing.html',
    '/missing.php',
]);

it('has responsive design classes', function () {
    get('/responsive-404')
        ->assertStatus(404)
        ->assertSee('sm:', false)
        ->assertSee('md:', false)
        ->assertSee('lg:', false);
});

it('includes gradient text styling for 404 display', function () {
    get('/gradient-404')
        ->assertStatus(404)
        ->assertSee('gradient', false);
});

it('includes animation classes for visual effects', function () {
    get('/animated-404')
        ->assertStatus(404)
        ->assertSeeInOrder(['fade-in', 'slide-up'], false);
});