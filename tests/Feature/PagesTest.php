<?php

use function Pest\Laravel\get;

it('can access the home page', function () {
    get('/')
        ->assertOk()
        ->assertSee("Senior Software Engineer", false)
        ->assertSee("Who Ships Results")
        ->assertSee("Let's Talk About Your Project", false);
});

it('can access the services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('How I Can Help Your Business')
        ->assertSee('Code Cleanup')
        ->assertSee('MVP Development')
        ->assertSee('AI Automation');
});

it('can access the projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('Projects')
        ->assertSee('Currently Building')
        ->assertSee('Tether')
        ->assertSee('PHAiTO');
});

it('can access the newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee('Weekly insights from building indie projects')
        ->assertSee('Subscribe Now');
});

it('can access the contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('Get in Touch')
        ->assertSee('Send Me a Message')
        ->assertSee('joey@jkudish.com');
});

it('can access the speaking page', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('Speaking');
});

it('has working navigation links', function () {
    get('/')
        ->assertOk()
        ->assertSee('href="' . route('services') . '"', false)
        ->assertSee('href="' . route('projects') . '"', false)
        ->assertSee('href="' . route('newsletter') . '"', false)
        ->assertSee('href="' . route('contact') . '"', false);
});

it('shows all home page sections', function () {
    get('/')
        ->assertOk()
        ->assertSee('Professional Journey')
        ->assertSee('Technical Expertise')
        ->assertSee("What I'm Building Right Now", false)
        ->assertSee('How I Can Help Your Business')
        ->assertSee('Proven Track Record')
        ->assertSee('The Maker Notes');
});

it('has proper meta title on services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('<title>Services - Joey Kudish</title>', false);
});

it('has proper meta title on projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('<title>Projects - Joey Kudish</title>', false);
});

it('has proper meta title on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('<title>The Maker Notes - Joey Kudish</title>', false);
});

it('has proper meta title on contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('<title>Contact - Joey Kudish</title>', false);
});