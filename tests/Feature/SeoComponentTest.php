<?php

it('renders basic meta tags with default values', function () {
    $view = $this->blade('<x-seo />');

    $view->assertSee('<meta name="description" content="', false)
        ->assertSee('<meta name="keywords" content="', false);
});

it('renders custom title and description', function () {
    $view = $this->blade('<x-seo 
        title="Custom Page Title" 
        description="This is a custom description for the page"
    />');

    $view->assertSee('<title>Custom Page Title - Joey Kudish</title>', false)
        ->assertSee('<meta name="description" content="This is a custom description for the page"', false);
});

it('renders Open Graph meta tags', function () {
    $view = $this->blade('<x-seo 
        title="Test Page"
        description="Test description"
        image="/img/test.jpg"
    />');

    $view->assertSee('<meta property="og:title" content="Test Page"', false)
        ->assertSee('<meta property="og:description" content="Test description"', false)
        ->assertSee('<meta property="og:image"', false)
        ->assertSee('<meta property="og:type" content="website"', false)
        ->assertSee('<meta property="og:site_name" content="Joey Kudish"', false);
});

it('renders Twitter Card meta tags', function () {
    $view = $this->blade('<x-seo 
        title="Twitter Test"
        description="Twitter test description"
        image="/img/twitter.jpg"
    />');

    $view->assertSee('<meta name="twitter:card" content="summary_large_image"', false)
        ->assertSee('<meta name="twitter:title" content="Twitter Test"', false)
        ->assertSee('<meta name="twitter:description" content="Twitter test description"', false)
        ->assertSee('<meta name="twitter:image"', false);
});

it('generates canonical URL automatically', function () {
    $view = $this->blade('<x-seo />');

    $view->assertSee('<link rel="canonical"', false);
});

it('renders structured data when provided', function () {
    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Joey Kudish',
    ];

    $view = $this->blade('<x-seo :structuredData="$structuredData" />', ['structuredData' => $structuredData]);

    $view->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type": "Person"', false)
        ->assertSee('"name": "Joey Kudish"', false);
});

it('uses default Open Graph image when none provided', function () {
    $view = $this->blade('<x-seo title="No Image Test" />');

    $view->assertSee('<meta property="og:image" content="', false)
        ->assertSee('/img/social/og-default.jpg', false);
});

it('appends site name to title by default', function () {
    $view = $this->blade('<x-seo title="Services" />');

    $view->assertSee('<title>Services - Joey Kudish</title>', false);
});

it('allows disabling site name suffix', function () {
    $view = $this->blade('<x-seo title="Joey Kudish" :appendSiteName="false" />');

    $view->assertSee('<title>Joey Kudish</title>', false)
        ->assertDontSee('<title>Joey Kudish - Joey Kudish</title>', false);
});

it('sets proper robots meta tag', function () {
    $view = $this->blade('<x-seo />');

    $view->assertSee('<meta name="robots" content="index, follow"', false);
});

it('allows custom robots directive', function () {
    $view = $this->blade('<x-seo robots="noindex, nofollow" />');

    $view->assertSee('<meta name="robots" content="noindex, nofollow"', false);
});

it('includes author meta tag', function () {
    $view = $this->blade('<x-seo author="Joey Kudish" />');

    $view->assertSee('<meta name="author" content="Joey Kudish"', false);
});
