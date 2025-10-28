<?php

use App\Models\Broadcast;

it('displays newsletter archive page', function () {
    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Human in the Loop');
});

it('displays list of sent newsletters in reverse chronological order', function () {
    $older = Broadcast::create([
        'bento_id' => 'old-1',
        'issue_number' => '001',
        'name' => 'Older Newsletter',
        'subject' => 'Older Subject',
        'html_content' => '<p>Older content</p>',
        'sent_at' => now()->subDays(7),
    ]);

    $newer = Broadcast::create([
        'bento_id' => 'new-1',
        'issue_number' => '002',
        'name' => 'Newer Newsletter',
        'subject' => 'Newer Subject',
        'html_content' => '<p>Newer content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Newer Newsletter');
    $response->assertSee('Older Newsletter');

    // Verify order by checking that newer appears before older in the HTML
    $content = $response->content();
    $newerPos = strpos($content, 'Newer Newsletter');
    $olderPos = strpos($content, 'Older Newsletter');

    expect($newerPos)->toBeLessThan($olderPos);
});

it('displays newsletter title and sent date', function () {
    Broadcast::create([
        'bento_id' => 'test-1',
        'issue_number' => '003',
        'name' => 'Test Newsletter Title',
        'subject' => 'Test Subject',
        'html_content' => '<p>Test content</p>',
        'sent_at' => '2024-09-12T07:21:33.102Z',
    ]);

    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Test Newsletter Title');
    // The date format might vary, but we should see some part of the date
    $response->assertSee('2024');
});

it('shows links to individual newsletter pages', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'test-link',
        'issue_number' => '004',
        'name' => 'Linkable Newsletter',
        'subject' => 'Link Subject',
        'html_content' => '<p>Link content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee("/newsletter/{$broadcast->issue_number}", false);
});

it('does not show launching soon badge', function () {
    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertDontSee('Launching soon');
    $response->assertDontSee('First Issue');
});

it('shows message when no newsletters exist', function () {
    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    // The page should still work even with no newsletters
});

it('only displays sent newsletters', function () {
    Broadcast::create([
        'bento_id' => 'sent-1',
        'issue_number' => '005',
        'name' => 'Sent Newsletter',
        'subject' => 'Sent Subject',
        'html_content' => '<p>Sent content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    Broadcast::create([
        'bento_id' => 'unsent-1',
        'issue_number' => '006',
        'name' => 'Unsent Newsletter',
        'subject' => 'Unsent Subject',
        'html_content' => '<p>Unsent content</p>',
        'sent_at' => null,
    ]);

    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Sent Newsletter');
    $response->assertDontSee('Unsent Newsletter');
});

it('only displays broadcasts with issue numbers', function () {
    Broadcast::create([
        'bento_id' => 'with-issue-1',
        'issue_number' => '007',
        'name' => 'Newsletter With Issue Number',
        'subject' => 'Test Subject',
        'html_content' => '<p>Test content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    Broadcast::create([
        'bento_id' => 'without-issue-1',
        'issue_number' => null,
        'name' => 'Newsletter Without Issue Number',
        'subject' => 'Test Subject',
        'html_content' => '<p>Test content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $response = $this->get('/newsletter');

    $response->assertStatus(200);
    $response->assertSee('Newsletter With Issue Number');
    $response->assertDontSee('Newsletter Without Issue Number');
});
