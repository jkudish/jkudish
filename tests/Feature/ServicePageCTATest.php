<?php

use function Pest\Laravel\get;

it('has automation service CTA with correct query parameter', function () {
    $response = get('/services');

    $response->assertSuccessful();
    $response->assertSee('href="'.route('contact').'?service=automation"', false);
    $response->assertSee('Automate My Business');
});

it('has audit service CTA with correct query parameter', function () {
    $response = get('/services');

    $response->assertSuccessful();
    $response->assertSee('href="'.route('contact').'?service=audit"', false);
    $response->assertSee('Start Your Audit');
});

it('has product service CTA with correct query parameter', function () {
    $response = get('/services');

    $response->assertSuccessful();
    $response->assertSee('href="'.route('contact').'?service=product"', false);
    $response->assertSee('Start Your Build');
});

it('has partnership service CTA with correct query parameter', function () {
    $response = get('/services');

    $response->assertSuccessful();
    $response->assertSee('href="'.route('contact').'?service=partnership"', false);
    $response->assertSee("Let's Partner");
});

it('clicking automation CTA navigates to contact with service parameter', function () {
    $response = get('/services');
    $response->assertSuccessful();

    // Follow the CTA link
    $contactResponse = get('/contact?service=automation');
    $contactResponse->assertSuccessful();
    $contactResponse->assertSee('Automate Your Way to Profit');
});

it('clicking audit CTA navigates to contact with service parameter', function () {
    $response = get('/services');
    $response->assertSuccessful();

    // Follow the CTA link
    $contactResponse = get('/contact?service=audit');
    $contactResponse->assertSuccessful();
    $contactResponse->assertSee('Code Audit');
});

it('clicking product CTA navigates to contact with service parameter', function () {
    $response = get('/services');
    $response->assertSuccessful();

    // Follow the CTA link
    $contactResponse = get('/contact?service=product');
    $contactResponse->assertSuccessful();
    $contactResponse->assertSee('Build Your Product');
});

it('clicking partnership CTA navigates to contact with service parameter', function () {
    $response = get('/services');
    $response->assertSuccessful();

    // Follow the CTA link
    $contactResponse = get('/contact?service=partnership');
    $contactResponse->assertSuccessful();
    $contactResponse->assertSee('Ongoing Partnership');
});
