<?php

use function Pest\Laravel\get;

it('includes Person schema on home page', function () {
    get('/')
        ->assertOk()
        ->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type": "Person"', false)
        ->assertSee('"name": "Joey Kudish"', false)
        ->assertSee('"jobTitle":', false)
        ->assertSee('"url":', false);
});

it('includes Person schema on contact page', function () {
    get('/contact')
        ->assertOk()
        ->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type": "Person"', false)
        ->assertSee('"email": "joey@jkudish.com"', false);
});

it('includes Event schema on speaking page', function () {
    get('/speaking')
        ->assertOk()
        ->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type": "Event"', false)
        ->assertSee('WordCamp Canada 2024', false)
        ->assertSee('Ottawa, Canada', false);
});

it('includes Service schema on services page', function () {
    get('/services')
        ->assertOk()
        ->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type": "Service"', false)
        ->assertSee('Software Development', false);
});

it('validates JSON-LD structure', function () {
    $response = get('/');

    // Extract JSON-LD content
    $html = $response->getContent();
    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

    if (! empty($matches[1])) {
        $json = json_decode($matches[1], true);
        expect($json)->toBeArray();
        expect($json)->toHaveKey('@context');
        expect($json)->toHaveKey('@type');
    }
});
