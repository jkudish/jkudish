<?php

use function Pest\Laravel\get;

it('has single column layout for conference presentations on speaking page', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('grid-cols-1 md:grid-cols-2', false);
});

it('has single column layout for topics on speaking page', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('grid-cols-1 sm:grid-cols-3', false);
});

it('shows speaking page sections', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('Conference Presentations')
        ->assertSee('Topics I Speak About')
        ->assertSee('Web Development')
        ->assertSee('AI & Automation', false)
        ->assertSee('Best Practices');
});

it('has single column layout for topics on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('grid-cols-1 sm:grid-cols-2', false);
});

it('shows newsletter page content', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee("Topics I'll Cover", false)
        ->assertSee('Coding with AI')
        ->assertSee('Building in Public')
        ->assertSee('Laravel, WordPress & Shopify', false)
        ->assertSee('Smart Automation');
});