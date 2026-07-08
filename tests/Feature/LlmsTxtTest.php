<?php

it('serves llms.txt at the correct route', function () {
    $response = $this->get('/llms.txt');

    $response->assertSuccessful();
});

it('returns plain text content type for llms.txt', function () {
    $response = $this->get('/llms.txt');

    $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
});

it('contains required sections in llms.txt', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    // Check for main sections
    expect($content)->toContain('Joey Kudish');
    expect($content)->toContain('## Services');
    expect($content)->toContain('## Key Features');
    expect($content)->toContain('## Contact');
});

it('contains software development services information', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    expect($content)->toContain('Build Your Product');
    expect($content)->toContain('Laravel');
});

it('contains AI automation services information', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    expect($content)->toContain('Automate Your Way to Profit');
});

it('contains contact information', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    expect($content)->toContain('Email:');
    expect($content)->toContain('Website:');
});

it('describes the newsletter with current branding and cadence', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    expect($content)
        ->toContain('Human in the Loop')
        ->toContain('Monthly-ish AI and automation newsletter')
        ->not->toContain('The Maker Notes')
        ->not->toContain('Weekly AI and automation newsletter');
});

it('keeps content size under 3KB', function () {
    $response = $this->get('/llms.txt');
    $content = $response->getContent();

    $sizeInKB = strlen($content) / 1024;
    expect($sizeInKB)->toBeLessThan(3);
});
