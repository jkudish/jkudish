<?php

use function Pest\Laravel\get;

it('has single column layout for current projects on projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2 lg:grid-cols-3', false);
});

it('has single column layout for selected work section', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('grid-cols-1 lg:grid-cols-2 mb-16', false);
});

it('has single column layout for how i work section', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('grid-cols-1 lg:grid-cols-3', false);
});

it('shows projects page sections', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('Projects', false);
});

it('has projects content', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('Tether')
        ->assertSee('PHAiTO')
        ->assertSee('Human in the Loop')
        ->assertSee('Image Salon')
        ->assertSee('WordPress & WooCommerce');
});