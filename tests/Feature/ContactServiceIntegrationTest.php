<?php

use function Pest\Laravel\get;

it('displays default contact hero when no service parameter is provided', function () {
    $response = get('/contact');

    $response->assertSuccessful();
    $response->assertSee('Get in Touch');
    $response->assertSee('Have a project in mind?');
});

it('displays automation service hero when service=automation', function () {
    $response = get('/contact?service=automation');

    $response->assertSuccessful();
    $response->assertSee('Automate Your Way to Profit');
    $response->assertSee('Ready to turn repetitive tasks into revenue-generating systems?');
    $response->assertSee('#eab308', false); // Yellow color for automation
});

it('displays audit service hero when service=audit', function () {
    $response = get('/contact?service=audit');

    $response->assertSuccessful();
    $response->assertSee('Code Audit & Strategy');
    $response->assertSee('Let\'s review your code and create a clear technical roadmap');
    $response->assertSee('#a855f7', false); // Purple color for audit
});

it('displays product service hero when service=product', function () {
    $response = get('/contact?service=product');

    $response->assertSuccessful();
    $response->assertSee('Build Your Product');
    $response->assertSee('Ready to ship something real? Let\'s discuss your vision');
    $response->assertSee('#10b981', false); // Emerald color for product
});

it('displays partnership service hero when service=partnership', function () {
    $response = get('/contact?service=partnership');

    $response->assertSuccessful();
    $response->assertSee('Ongoing Partnership');
    $response->assertSee('Let\'s discuss how ongoing technical leadership can help your business grow');
    $response->assertSee('#06b6d4', false); // Cyan color for partnership
});

it('displays default hero for invalid service parameter', function () {
    $response = get('/contact?service=invalid');

    $response->assertSuccessful();
    $response->assertSee('Get in Touch');
    $response->assertSee('Have a project in mind?');
});

it('passes service context to contact view', function () {
    $response = get('/contact?service=automation');

    $response->assertSuccessful();
    $response->assertViewHas('service', 'automation');
});

it('customizes form placeholders based on service context', function () {
    $response = get('/contact?service=automation');

    $response->assertSuccessful();
    $response->assertSee('Tell me about the processes you want to automate', false);
});

it('customizes form helper text based on service context', function () {
    $response = get('/contact?service=product');

    $response->assertSuccessful();
    $response->assertSee('Describe your product vision and technical requirements', false);
});

it('maintains form validation with service context', function () {
    $response = get('/contact?service=automation');

    $response->assertSuccessful();
    // Ensure all required form fields are still present
    $response->assertSee('name="first_name"', false);
    $response->assertSee('name="last_name"', false);
    $response->assertSee('name="email"', false);
    $response->assertSee('name="subject"', false);
    $response->assertSee('name="message"', false);
    $response->assertSee('required', false);
});
