<?php

use App\Models\Broadcast;
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
        ->assertSee('https://jkudish.com/</loc>', false)
        ->assertSee('https://jkudish.com/speaking</loc>', false)
        ->assertSee('https://jkudish.com/services</loc>', false)
        ->assertSee('https://jkudish.com/projects</loc>', false)
        ->assertSee('https://jkudish.com/newsletter</loc>', false)
        ->assertSee('https://jkudish.com/contact</loc>', false);
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

it('includes sent newsletter issues in sitemap', function () {
    Broadcast::create([
        'bento_id' => 'test-1',
        'issue_number' => '001',
        'name' => 'Test Newsletter 1',
        'subject' => 'Test Subject 1',
        'html_content' => '<p>Test content 1</p>',
        'sent_at' => now()->subDays(7),
    ]);

    Broadcast::create([
        'bento_id' => 'test-2',
        'issue_number' => '002',
        'name' => 'Test Newsletter 2',
        'subject' => 'Test Subject 2',
        'html_content' => '<p>Test content 2</p>',
        'sent_at' => now()->subDays(3),
    ]);

    $response = get('/sitemap.xml');

    $response->assertOk()
        ->assertSee('https://jkudish.com/newsletter/001</loc>', false)
        ->assertSee('https://jkudish.com/newsletter/002</loc>', false);
});

it('excludes unsent newsletter issues from sitemap', function () {
    Broadcast::create([
        'bento_id' => 'sent-1',
        'issue_number' => '003',
        'name' => 'Sent Newsletter',
        'subject' => 'Sent Subject',
        'html_content' => '<p>Sent content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    Broadcast::create([
        'bento_id' => 'unsent-1',
        'issue_number' => '004',
        'name' => 'Unsent Newsletter',
        'subject' => 'Unsent Subject',
        'html_content' => '<p>Unsent content</p>',
        'sent_at' => null,
    ]);

    $response = get('/sitemap.xml');

    $response->assertOk()
        ->assertSee('https://jkudish.com/newsletter/003</loc>', false)
        ->assertDontSee('https://jkudish.com/newsletter/004</loc>', false);
});
