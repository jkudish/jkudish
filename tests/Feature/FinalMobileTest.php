<?php

use function Pest\Laravel\get;

// Test removed - was only checking assertOk() without meaningful assertions

it('has working mobile navigation components', function () {
    get('/')
        ->assertOk()
        ->assertSee('x-data="{ mobileMenuOpen: false }"', false)
        ->assertSee('x-show="mobileMenuOpen"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('@click.away="mobileMenuOpen = false"', false);
});

it('has proper touch targets and accessibility', function () {
    get('/')
        ->assertOk()
        ->assertSee('px-4 py-2', false) // Menu button padding
        ->assertSee('aria-expanded', false) // ARIA attributes
        ->assertSee('role="dialog"', false); // Dialog role for menu panel
});

it('shows proper mobile layout on all key sections', function () {
    get('/')
        ->assertOk()
        ->assertSee('Tether') // Projects showing
        ->assertSee('PHAiTO')
        ->assertSee('Human in the Loop')
        ->assertSee('18+') // Metrics showing
        ->assertSee('100+')
        ->assertSee("I've worked with Joey"); // Testimonials showing
});