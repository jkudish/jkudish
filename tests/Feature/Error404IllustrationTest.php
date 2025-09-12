<?php

use function Pest\Laravel\get;

it('includes an illustration element on the 404 page', function () {
    get('/404-illustration-test')
        ->assertStatus(404)
        ->assertSee('svg', false);
});

it('has proper alt text for accessibility', function () {
    get('/404-accessibility-test')
        ->assertStatus(404)
        ->assertSee('aria-label', false);
});

it('illustration has animation class', function () {
    get('/404-animation-test')
        ->assertStatus(404)
        ->assertSee('animate-slide-up', false);
});

it('illustration is properly positioned', function () {
    get('/404-position-test')
        ->assertStatus(404)
        ->assertSee('mx-auto', false)
        ->assertSee('mt-12', false);
});

it('illustration scales responsively', function () {
    get('/404-responsive-illustration')
        ->assertStatus(404)
        ->assertSee('w-', false)
        ->assertSee('h-', false);
});