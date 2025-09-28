<?php

it('home newsletter signup component has updated Human in the Loop content', function () {
    // The component exists but isn't currently included on the home page
    // Testing the component file directly to ensure it's updated
    $view = view('components.home.newsletter-signup');
    $html = $view->render();
    
    expect($html)->toContain('🤖 Human in the Loop');
    expect($html)->toContain('Stay human while coding at AI speed');
    expect($html)->toContain('Real workflows that work');
    expect($html)->toContain('developers mastering AI augmentation');
});

it('home newsletter signup component has updated benefits', function () {
    $view = view('components.home.newsletter-signup');
    $html = $view->render();
    
    expect($html)->toContain('Practical AI coding workflows with Claude &amp; Cursor');
    expect($html)->toContain('Prompt engineering patterns that ship production code');
    expect($html)->toContain('Human-AI collaboration strategies that 10x productivity');
    expect($html)->toContain('Real examples from my daily AI-augmented development');
});
