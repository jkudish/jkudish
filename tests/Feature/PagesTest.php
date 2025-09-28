<?php

use function Pest\Laravel\get;

it('can access the home page', function () {
    get('/')
        ->assertOk()
        ->assertSee('Joey', false)
        ->assertSee('Software', false);
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
        ->assertSee('Human in the Loop');
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
        ->assertSee('Projects', false)
        ->assertSee('Business', false);
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
        ->assertSee('<title>Human in the Loop Newsletter - Joey Kudish</title>', false);
});

it('has proper meta title on contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('<title>Contact Joey Kudish - Joey Kudish</title>', false);
});

it('shows newsletter in footer on most pages', function () {
    get('/')
        ->assertOk()
        ->assertSee('AI', false)
        ->assertSee('newsletter', false);
    
    get('/services')
        ->assertOk()
        ->assertSee('AI', false);
    
    get('/speaking')
        ->assertOk()
        ->assertSee('AI', false);
});

it('hides newsletter in footer on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertDontSee('My weekly brain dump');
});
