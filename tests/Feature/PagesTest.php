<?php

use function Pest\Laravel\get;

it('can access the home page', function () {
    get('/')
        ->assertOk()
        ->assertSee("Hey, I'm Joey", false)
        ->assertSee('I Build Software That Works')
        ->assertSee("Let's Talk About Your Project", false);
});

it('can access the services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('I Build Software That Works')
        ->assertSee('Automate Your Way to Profit')
        ->assertSee('Code Audit & Strategy')
        ->assertSee('Build Your Product')
        ->assertSee('Ongoing Partnership');
});

it('can access the projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('Projects')
        ->assertSee("What I'm Building Right Now", false)
        ->assertSee('Tether')
        ->assertSee('PHAiTO');
});

it('can access the newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee('Insights on coding with AI')
        ->assertSee('Join The Maker Notes');
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
        ->assertSee('href="'.route('services').'"', false)
        ->assertSee('href="'.route('projects').'"', false)
        ->assertSee('href="'.route('newsletter').'"', false)
        ->assertSee('href="'.route('contact').'"', false);
});

it('shows all home page sections', function () {
    get('/')
        ->assertOk()
        ->assertSee('Technical Expertise')
        ->assertSee("What I'm Building Right Now", false)
        ->assertSee('How I Can Help Your Business')
        ->assertSee('Proven Track Record')
        ->assertSee('The Maker Notes');
});

it('has proper meta title on services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('<title>Software Development &amp; AI Automation Services - Joey Kudish</title>', false);
});

it('has proper meta title on projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('<title>Portfolio &amp; Projects - Joey Kudish</title>', false);
});

it('has proper meta title on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('<title>The Maker Notes Newsletter - Joey Kudish</title>', false);
});

it('has proper meta title on contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('<title>Contact Joey Kudish - Joey Kudish</title>', false);
});

it('shows newsletter in footer on most pages', function () {
    get('/')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee('My weekly brain dump');
    
    get('/services')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee('My weekly brain dump');
    
    get('/speaking')
        ->assertOk()
        ->assertSee('The Maker Notes')
        ->assertSee('My weekly brain dump');
});

it('hides newsletter in footer on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertDontSee('My weekly brain dump');
});
