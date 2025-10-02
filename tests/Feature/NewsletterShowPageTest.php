<?php

use App\Models\Broadcast;

it('displays individual newsletter page', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'test-show',
        'issue_number' => '001',
        'name' => 'Test Newsletter',
        'subject' => 'Test Subject',
        'html_content' => '<h1>Newsletter Content</h1><p>This is test content.</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get("/newsletter/{$broadcast->issue_number}");

    $response->assertStatus(200);
    $response->assertSee('Newsletter Content', false);
    $response->assertSee('This is test content', false);
});

it('renders newsletter HTML content', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'html-test',
        'issue_number' => '002',
        'name' => 'HTML Test Newsletter',
        'subject' => 'HTML Subject',
        'html_content' => '<div class="test-class"><h2>Rich HTML Content</h2><ul><li>Item 1</li><li>Item 2</li></ul></div>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get("/newsletter/{$broadcast->issue_number}");

    $response->assertStatus(200);
    $response->assertSee('Rich HTML Content', false);
    $response->assertSee('<li>Item 1</li>', false);
    $response->assertSee('<li>Item 2</li>', false);
});

it('includes site header and footer', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'layout-test',
        'issue_number' => '003',
        'name' => 'Layout Test',
        'subject' => 'Layout Subject',
        'html_content' => '<p>Layout content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get("/newsletter/{$broadcast->issue_number}");

    $response->assertStatus(200);
    // Should have navigation elements
    $response->assertSee('Joey Kudish');
});

it('shows newsletter signup CTA', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'cta-test',
        'issue_number' => '004',
        'name' => 'CTA Test',
        'subject' => 'CTA Subject',
        'html_content' => '<p>CTA content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get("/newsletter/{$broadcast->issue_number}");

    $response->assertStatus(200);
    // Should have newsletter signup form or CTA
    $response->assertSee('newsletter', false);
});

it('redirects to newsletter archive for non-existent newsletter', function () {
    $response = $this->get('/newsletter/999');

    $response->assertRedirect('/newsletter');
});

it('redirects to newsletter archive for unsent newsletters', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'unsent-test',
        'issue_number' => '005',
        'name' => 'Unsent Newsletter',
        'subject' => 'Unsent Subject',
        'html_content' => '<p>Unsent content</p>',
        'sent_at' => null,
    ]);

    $response = $this->get("/newsletter/{$broadcast->issue_number}");

    $response->assertRedirect('/newsletter');
});

it('uses route model binding', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'binding-test',
        'issue_number' => '006',
        'name' => 'Binding Test',
        'subject' => 'Binding Subject',
        'html_content' => '<p>Binding content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    // If route model binding works, this should succeed
    $response = $this->get("/newsletter/{$broadcast->issue_number}");
    $response->assertStatus(200);

    // And this should fail/redirect
    $response = $this->get('/newsletter/999');
    $response->assertRedirect();
});
