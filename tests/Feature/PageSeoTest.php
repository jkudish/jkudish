<?php

use function Pest\Laravel\get;

it('has proper SEO tags on home page', function () {
    get('/')
        ->assertOk()
        ->assertSee('<title>Joey Kudish - Software Developer &amp; AI Automation Consultant</title>', false)
        ->assertSee('<meta name="description" content="Expert Laravel developer and AI automation consultant helping businesses build scalable web applications and automate workflows.', false)
        ->assertSee('<meta property="og:title" content="Joey Kudish - Software Developer &amp; AI Automation Consultant"', false);
});

it('has proper SEO tags on speaking page', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('<title>Speaking &amp; Presentations - Joey Kudish</title>', false)
        ->assertSee('<meta name="description" content="Conference talks, presentations, and workshops by Joey Kudish on software development, Laravel, WordPress, and AI automation."', false)
        ->assertSee('<meta property="og:title" content="Speaking &amp; Presentations"', false);
});

it('has proper SEO tags on services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('<title>Software Development &amp; AI Automation Services - Joey Kudish</title>', false)
        ->assertSee('<meta name="description" content="Professional software development and AI automation services. Specializing in Laravel applications, custom integrations, and workflow automation."', false)
        ->assertSee('<meta property="og:title" content="Software Development &amp; AI Automation Services"', false);
});

it('has proper SEO tags on projects page', function () {
    get('/projects')
        ->assertOk()
        ->assertSee('<title>Portfolio &amp; Projects - Joey Kudish</title>', false)
        ->assertSee('Explore Joey Kudish', false)
        ->assertSee('portfolio of software projects', false)
        ->assertSee('<meta property="og:title" content="Portfolio &amp; Projects"', false);
});

it('has proper SEO tags on newsletter page', function () {
    get('/newsletter')
        ->assertOk()
        ->assertSee('<title>The Maker Notes Newsletter - Joey Kudish</title>', false)
        ->assertSee('<meta name="description" content="Subscribe to The Maker Notes for insights on software development, AI automation, and building digital products."', false)
        ->assertSee('<meta property="og:title" content="The Maker Notes Newsletter"', false);
});

it('has proper SEO tags on contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('<title>Contact Joey Kudish - Joey Kudish</title>', false)
        ->assertSee('<meta name="description" content="Contact Joey Kudish for software development projects, AI automation consulting, or speaking engagements."', false)
        ->assertSee('<meta property="og:title" content="Contact Joey Kudish"', false);
});

it('includes canonical URLs on all pages', function () {
    $pages = ['/', '/speaking', '/services', '/projects', '/newsletter', '/contact'];

    foreach ($pages as $page) {
        get($page)
            ->assertOk()
            ->assertSee('<link rel="canonical" href="', false);
    }
});

it('includes Twitter Card tags on all pages', function () {
    $pages = ['/', '/speaking', '/services', '/projects', '/newsletter', '/contact'];

    foreach ($pages as $page) {
        get($page)
            ->assertOk()
            ->assertSee('<meta name="twitter:card" content="summary_large_image"', false)
            ->assertSee('<meta name="twitter:title"', false)
            ->assertSee('<meta name="twitter:description"', false);
    }
});

it('includes Open Graph image on all pages', function () {
    $pages = ['/', '/speaking', '/services', '/projects', '/newsletter', '/contact'];

    foreach ($pages as $page) {
        get($page)
            ->assertOk()
            ->assertSee('<meta property="og:image"', false)
            ->assertSee('/img/social/og-default.jpg', false);
    }
});
