<?php

test('each public page renders without browser errors', function (string $path, string $content): void {
    visit($path.'?without-third-party=1')
        ->assertSee($content)
        ->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
})->with([
    'home' => ['/', "Hey, I'm Joey"],
    'speaking' => ['/speaking', 'Sometimes, I give conference talks.'],
    'services' => ['/services', 'Automate Your Way to Profit'],
    'projects' => ['/projects', 'Projects & Work'],
    'newsletter' => ['/newsletter', 'Human in the Loop'],
    'contact' => ['/contact', 'Get in Touch'],
]);
