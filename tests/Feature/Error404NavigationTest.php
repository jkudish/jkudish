<?php

use function Pest\Laravel\get;

it('includes working navigation buttons', function () {
    $response = get('/404-nav-test');
    
    $response->assertStatus(404)
        ->assertSee('Back to Homepage', false)
        ->assertSee('href="/"', false)
        ->assertSee('Services', false)
        ->assertSee('href="/services"', false)
        ->assertSee('Speaking', false)
        ->assertSee('href="/speaking"', false);
});

it('has primary gradient button styling', function () {
    get('/404-button-test')
        ->assertStatus(404)
        ->assertSee('bg-gradient-to-r', false)
        ->assertSee('from-emerald-700', false);
});

it('has secondary navigation links', function () {
    get('/404-secondary-links')
        ->assertStatus(404)
        ->assertSee('Projects', false)
        ->assertSee('Contact', false);
});

it('buttons have hover effects', function () {
    get('/404-hover-test')
        ->assertStatus(404)
        ->assertSee('hover:', false)
        ->assertSee('transition', false);
});

it('includes helpful guidance text with link', function () {
    $response = get('/404-guidance-test');
    
    $response->assertStatus(404)
        ->assertSee('explore other sections', false)
        ->assertSee('Homepage', false)
        ->assertSee('href="/"', false);
});

it('buttons are responsive on mobile', function () {
    get('/404-mobile-buttons')
        ->assertStatus(404)
        ->assertSee('flex-col', false)
        ->assertSee('sm:flex-row', false);
});