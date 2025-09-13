<?php

use function Pest\Laravel\get;

it('includes Fathom Analytics script on all pages', function () {
    $pages = ['/', '/speaking', '/services', '/projects', '/newsletter', '/contact'];

    foreach ($pages as $page) {
        get($page)
            ->assertOk()
            ->assertSee('https://cdn.usefathom.com/script.js', false)
            ->assertSee('data-site="OLWGPIDF"', false)
            ->assertSee('defer', false);
    }
});

it('includes Fathom Analytics in layout component', function () {
    get('/')
        ->assertOk()
        ->assertSee('<!-- Fathom - beautiful, simple website analytics -->', false)
        ->assertSee('<script src="https://cdn.usefathom.com/script.js" data-site="OLWGPIDF" defer></script>', false)
        ->assertSee('<!-- / Fathom -->', false);
});

it('has correct Fathom site code', function () {
    get('/')
        ->assertOk()
        ->assertSee('OLWGPIDF'); // Verify the specific site code
});
