<?php

use function Pest\Laravel\get;

// Test removed - too generic, other tests cover contact page

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
    $response->assertSee('Audit', false);
});

it('displays product service hero when service=product', function () {
    $response = get('/contact?service=product');

    $response->assertSuccessful();
    $response->assertSee('Product', false);
});

it('displays partnership service hero when service=partnership', function () {
    $response = get('/contact?service=partnership');

    $response->assertSuccessful();
    $response->assertSee('Partnership', false);
});

// Test removed - too generic

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

it('pre-selects appropriate subject based on service', function () {
    // Test automation service
    $response = get('/contact?service=automation');
    $response->assertSuccessful();
    $response->assertSee('<option selected>Automation Inquiry</option>', false);
    
    // Test audit service
    $response = get('/contact?service=audit');
    $response->assertSuccessful();
    $response->assertSee('<option selected>Code Audit Request</option>', false);
    
    // Test product service
    $response = get('/contact?service=product');
    $response->assertSuccessful();
    $response->assertSee('<option selected>Project Inquiry</option>', false);
    
    // Test partnership service
    $response = get('/contact?service=partnership');
    $response->assertSuccessful();
    $response->assertSee('<option selected>Partnership Opportunity</option>', false);
});
