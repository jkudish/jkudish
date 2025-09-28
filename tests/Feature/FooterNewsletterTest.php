<?php

it('shows updated Human in the Loop branding in footer on pages with newsletter', function () {
    // Test on home page (has newsletter in footer)
    $response = $this->get('/');
    
    $response->assertStatus(200);
    $response->assertSee('Human in the Loop', false);
    $response->assertSee('Receive tips in your inbox', false);
    $response->assertSee('write better code', false);
});

it('shows correct success message after newsletter signup in footer', function () {
    // The success message is handled by Alpine.js, so we're checking it exists in the JS
    $response = $this->get('/');
    
    $response->assertStatus(200);
    $response->assertSee("Welcome to Human in the Loop! You\\'ll receive my next AI development insights soon.", false);
});
