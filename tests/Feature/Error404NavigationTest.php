<?php

use function Pest\Laravel\get;

it('includes working navigation buttons', function () {
    $response = get('/404-nav-test');
    
    $response->assertStatus(404)
        ->assertSee('Take Me Home', false)
        ->assertSee('href="/"', false)
        ->assertSee('View Services', false)
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

it('has secondary button variants', function () {
    get('/404-secondary-buttons')
        ->assertStatus(404)
        ->assertSee('from-purple-500', false)
        ->assertSee('to-pink-500', false);
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
        ->assertSee('Lost?', false)
        ->assertSee('homepage', false)
        ->assertSee('check that the URL is correct', false)
        ->assertSee('href="/"', false);
});

it('buttons are responsive on mobile', function () {
    get('/404-mobile-buttons')
        ->assertStatus(404)
        ->assertSee('flex-col', false)
        ->assertSee('sm:flex-row', false);
});