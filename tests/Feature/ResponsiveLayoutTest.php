<?php

use function Pest\Laravel\get;

it('has single column layout for current projects on mobile', function () {
    get('/')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2 lg:grid-cols-3', false);
});

// Test removed - was only checking assertOk() without meaningful assertions

it('has responsive testimonials with mobile detection', function () {
    get('/')
        ->assertOk()
        ->assertSee('window.innerWidth < 768', false)
        ->assertSee('isMobile ? 1 : 2', false);
});

it('shows what im building right now section', function () {
    get('/')
        ->assertOk()
        ->assertSee("What I'm Building Right Now", false);
});

it('shows proven track record section', function () {
    get('/')
        ->assertOk()
        ->assertSee('Proven Track Record');
});

it('has current projects with proper structure', function () {
    get('/')
        ->assertOk()
        ->assertSee('Tether')
        ->assertSee('PHAiTO')
        ->assertSee('Human in the Loop');
});