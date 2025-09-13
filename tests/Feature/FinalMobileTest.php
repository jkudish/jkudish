<?php

use function Pest\Laravel\get;

it('has comprehensive mobile improvements across all pages', function () {
    // Test homepage mobile improvements
    get('/')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2 lg:grid-cols-3', false) // Current projects
        ->assertSee('grid-cols-1 sm:grid-cols-2 lg:grid-cols-4', false) // Metrics
        ->assertSee('window.innerWidth < 768', false); // Responsive testimonials

    // Test projects page mobile improvements  
    get('/projects')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2 lg:grid-cols-3', false) // Projects
        ->assertSee('grid-cols-1 lg:grid-cols-2 mb-16', false) // Selected work
        ->assertSee('grid-cols-1 lg:grid-cols-3', false); // How I work

    // Test speaking page mobile improvements
    get('/speaking')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2', false) // Presentations
        ->assertSee('grid-cols-1 sm:grid-cols-3', false); // Topics

    // Test newsletter page mobile improvements
    get('/newsletter')
        ->assertOk()
        ->assertSee('grid-cols-1 sm:grid-cols-2', false); // Topics
});

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
        ->assertSee('The Maker Notes')
        ->assertSee('18+') // Metrics showing
        ->assertSee('100+')
        ->assertSee("I've worked with Joey"); // Testimonials showing
});