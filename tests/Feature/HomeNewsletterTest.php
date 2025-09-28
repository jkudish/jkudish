<?php

it('home newsletter signup component has updated Human in the Loop content', function () {
    // The component exists but isn't currently included on the home page
    // Testing the component file directly to ensure it's updated
    $view = view('components.home.newsletter-signup');
    $html = $view->render();
    
    expect($html)->toContain('Human in the Loop');
    expect($html)->toContain('AI');
});

it('home newsletter signup component has updated benefits', function () {
    $view = view('components.home.newsletter-signup');
    $html = $view->render();
    
    expect($html)->toContain('AI');
    expect($html)->toContain('productivity');
});
