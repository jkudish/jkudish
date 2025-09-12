<?php

use function Pest\Laravel\get;

it('includes Fathom Analytics script', function () {
    get('/404-analytics-test')
        ->assertStatus(404)
        ->assertSee('fathom', false)
        ->assertSee('OLWGPIDF', false);
});

it('has custom 404 event tracking code', function () {
    get('/404-event-test')
        ->assertStatus(404)
        ->assertSee('404_page_view', false)
        ->assertSee('window.fathom', false);
});

it('includes pathname in event tracking', function () {
    get('/404-pathname-test')
        ->assertStatus(404)
        ->assertSee('window.location.pathname', false);
});

it('tracks event on page load', function () {
    get('/404-onload-test')
        ->assertStatus(404)
        ->assertSee('addEventListener', false)
        ->assertSee('DOMContentLoaded', false);
});

it('checks for fathom existence before tracking', function () {
    get('/404-safety-test')
        ->assertStatus(404)
        ->assertSee('typeof window.fathom', false)
        ->assertSee('undefined', false);
});