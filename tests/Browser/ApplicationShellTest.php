<?php

use App\Models\Broadcast;
use Illuminate\Support\Str;

test('each public page renders without browser errors', function (string $path, string $content): void {
    visit($path.'?without-third-party=1')
        ->assertSee($content)
        ->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
})->with([
    'home' => ['/', 'I build software that works.'],
    'speaking' => ['/speaking', 'Sometimes, I give conference talks.'],
    'services' => ['/services', "Let's Build Yours."],
    'projects' => ['/projects', "What I've built, broken, and shipped over 20 years."],
    'newsletter' => ['/newsletter', 'AI as Your Coding Partner'],
    'contact' => ['/contact', 'Send Me a Message'],
]);

test('a sent newsletter broadcast renders without browser errors', function (): void {
    $identifier = Str::uuid()->toString();
    $uniqueContent = "Browser smoke broadcast {$identifier}";
    $broadcast = Broadcast::create([
        'bento_id' => "browser-smoke-{$identifier}",
        'issue_number' => "browser-smoke-{$identifier}",
        'name' => "Browser Smoke {$identifier}",
        'subject' => 'Browser smoke subject',
        'html_content' => "<p>Browser smoke introduction</p><p>{$uniqueContent}</p>",
        'sent_at' => now(),
    ]);

    try {
        visit("/newsletter/{$broadcast->getRouteKey()}?without-third-party=1")
            ->assertSee($uniqueContent)
            ->assertNoJavaScriptErrors()
            ->assertNoConsoleLogs();
    } finally {
        $broadcast->delete();
    }
});

test('the shared mobile shell opens and closes the menu and toggles the theme', function (): void {
    $page = visit('/?without-third-party=1')
        ->on()->mobile()
        ->assertAttributeContains('button[aria-expanded]', 'aria-expanded', 'false')
        ->assertMissing('[role="dialog"]')
        ->click('Menu')
        ->assertAttributeContains('button[aria-expanded]', 'aria-expanded', 'true')
        ->assertVisible('[role="dialog"]')
        ->click('Menu')
        ->assertAttributeContains('button[aria-expanded]', 'aria-expanded', 'false')
        ->assertMissing('[role="dialog"]');

    $startedInDarkMode = $page->script('document.documentElement.classList.contains("dark")');

    $page->click('button[aria-label="Switch to dark theme"]');

    expect($page->script('document.documentElement.classList.contains("dark")'))
        ->toBe(! $startedInDarkMode);

    $page->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
});

test('the homepage testimonial carousel changes the visible testimonials', function (): void {
    visit('/?without-third-party=1')
        ->assertSee('Bryce Adams')
        ->assertDontSee('Justin Evans')
        ->click('button[aria-label="Next testimonials"]')
        ->assertDontSee('Bryce Adams')
        ->assertSee('Justin Evans')
        ->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
});

test('the contact subject selector updates the Alpine-rendered copy', function (): void {
    visit('/contact?without-third-party=1')
        ->assertSee('Get in Touch')
        ->assertDontSee('Automate Your Way to Profit')
        ->select('subject', 'Automation Inquiry')
        ->assertSee('Automate Your Way to Profit')
        ->assertSee('Ready to turn repetitive tasks into revenue-generating systems?')
        ->assertAttributeContains('textarea[name="message"]', 'placeholder', 'processes you want to automate')
        ->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
});
