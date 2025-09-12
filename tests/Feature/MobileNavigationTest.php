<?php

use function Pest\Laravel\get;

it('has mobile menu button with proper attributes', function () {
    get('/')
        ->assertOk()
        ->assertSee('button', false)
        ->assertSee('Menu')
        ->assertSee('aria-expanded', false)
        ->assertSee('type="button"', false);
});

it('has mobile menu button only visible on mobile', function () {
    get('/')
        ->assertOk()
        ->assertSee('md:hidden', false); // Mobile menu should be hidden on desktop
});

it('has desktop navigation hidden on mobile', function () {
    get('/')
        ->assertOk()
        ->assertSee('hidden md:block', false); // Desktop nav should be hidden on mobile
});

it('has all navigation links in desktop menu', function () {
    get('/')
        ->assertOk()
        ->assertSee('href="'.route('home').'"', false)
        ->assertSee('href="'.route('services').'"', false)
        ->assertSee('href="'.route('projects').'"', false)
        ->assertSee('href="'.route('speaking').'"', false)
        ->assertSee('href="'.route('newsletter').'"', false)
        ->assertSee('href="'.route('contact').'"', false);
});

it('has mobile menu with x-show directive for Alpine.js', function () {
    get('/')
        ->assertOk()
        ->assertSee('x-show', false)
        ->assertSee('x-data', false);
});

it('has proper aria attributes for accessibility', function () {
    get('/')
        ->assertOk()
        ->assertSee('aria-expanded', false)
        ->assertSee('role="dialog"', false);
});