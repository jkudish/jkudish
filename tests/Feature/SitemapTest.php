<?php

use function Pest\Laravel\get;

it('has accessible sitemap.xml route', function () {
    get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
});

it('contains all main pages in sitemap', function () {
    $response = get('/sitemap.xml');

    $response->assertOk()
        ->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"', false)
        ->assertSee('jkudish.test</loc>', false)
        ->assertSee('jkudish.test/speaking</loc>', false)
        ->assertSee('jkudish.test/services</loc>', false)
        ->assertSee('jkudish.test/projects</loc>', false)
        ->assertSee('jkudish.test/newsletter</loc>', false)
        ->assertSee('jkudish.test/contact</loc>', false);
});

it('includes priority tags for pages', function () {
    $response = get('/sitemap.xml');

    $response->assertOk()
        ->assertSee('<priority>1.0</priority>', false) // Home page
        ->assertSee('<priority>0.9</priority>', false) // Services
        ->assertSee('<priority>0.8</priority>', false) // Projects/Speaking
        ->assertSee('<priority>0.7</priority>', false) // Contact
        ->assertSee('<priority>0.6</priority>', false); // Newsletter
});

it('includes changefreq tags', function () {
    $response = get('/sitemap.xml');

    $response->assertOk()
        ->assertSee('<changefreq>weekly</changefreq>', false)
        ->assertSee('<changefreq>monthly</changefreq>', false)
        ->assertSee('<changefreq>yearly</changefreq>', false);
});

it('generates valid XML', function () {
    $response = get('/sitemap.xml');

    $xml = simplexml_load_string($response->getContent());

    expect($xml)->not->toBeFalse();
    expect($xml->getName())->toBe('urlset');
    expect(count($xml->url))->toBeGreaterThanOrEqual(6);
});
