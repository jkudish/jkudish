<?php

it('robots.txt file exists in public directory', function () {
    expect(file_exists(public_path('robots.txt')))->toBeTrue();
});

it('robots.txt contains proper content', function () {
    $content = file_get_contents(public_path('robots.txt'));

    expect($content)->toContain('User-agent: *');
    expect($content)->toContain('Allow: /');
    expect($content)->not->toContain('Disallow:');
    expect($content)->toContain('Sitemap:');
    expect($content)->toContain('jkudish.com/sitemap.xml');
});
