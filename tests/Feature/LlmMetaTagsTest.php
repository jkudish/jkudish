<?php

it('includes llm-description meta tag on homepage', function () {
    $response = $this->get('/');

    $response->assertSee('<meta name="llm-description"', false);
    $response->assertSee('Joey Kudish: Expert Laravel developer and AI automation specialist', false);
});

it('includes llm-instructions link on homepage', function () {
    $response = $this->get('/');

    $response->assertSee('<link rel="llm-instructions" href="/llms.txt">', false);
});

it('includes llm meta tags on all pages', function () {
    $pages = ['/', '/speaking', '/services', '/projects'];

    foreach ($pages as $page) {
        $response = $this->get($page);

        $response->assertSee('<meta name="llm-description"', false);
        $response->assertSee('<link rel="llm-instructions" href="/llms.txt">', false);
    }
});
