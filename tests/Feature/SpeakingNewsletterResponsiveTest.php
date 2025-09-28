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
        ->assertSee('Human in the Loop')
        ->assertSee("Topics I Cover", false)
        ->assertSee('AI as Your Coding Partner')
        ->assertSee('Human-AI Collaboration')
        ->assertSee('AI-Enhanced Development')
        ->assertSee('Obsidian for AI Development');
});