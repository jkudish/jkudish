<?php

use App\Models\Broadcast;

it('can create a broadcast with required fields', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'test-broadcast-123',
        'name' => 'Test Broadcast',
        'subject' => 'Test Subject',
        'html_content' => '<h1>Test Content</h1>',
    ]);

    expect($broadcast)->toBeInstanceOf(Broadcast::class);
    expect($broadcast->bento_id)->toBe('test-broadcast-123');
    expect($broadcast->name)->toBe('Test Broadcast');
    expect($broadcast->subject)->toBe('Test Subject');
    expect($broadcast->html_content)->toBe('<h1>Test Content</h1>');
});

it('can create a broadcast with all fields', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'test-broadcast-456',
        'name' => 'Full Test Broadcast',
        'subject' => 'Full Test Subject',
        'html_content' => '<h1>Full Test Content</h1>',
        'share_url' => 'https://example.com/broadcast/456',
        'sent_at' => now(),
        'stats' => ['open_rate' => 42.5],
    ]);

    expect($broadcast->bento_id)->toBe('test-broadcast-456');
    expect($broadcast->share_url)->toBe('https://example.com/broadcast/456');
    expect($broadcast->sent_at)->toBeInstanceOf(Carbon\Carbon::class);
    expect($broadcast->stats)->toBeArray();
    expect($broadcast->stats['open_rate'])->toBe(42.5);
});

it('enforces unique bento_id constraint', function () {
    Broadcast::create([
        'bento_id' => 'duplicate-id',
        'name' => 'First Broadcast',
        'subject' => 'First Subject',
        'html_content' => '<p>First content</p>',
    ]);

    // Attempting to create another broadcast with the same bento_id should fail
    expect(fn() => Broadcast::create([
        'bento_id' => 'duplicate-id',
        'name' => 'Second Broadcast',
        'subject' => 'Second Subject',
        'html_content' => '<p>Second content</p>',
    ]))->toThrow(Illuminate\Database\QueryException::class);
});

it('casts sent_at to Carbon instance', function () {
    $broadcast = Broadcast::create([
        'bento_id' => 'test-carbon-cast',
        'name' => 'Carbon Test',
        'subject' => 'Carbon Subject',
        'html_content' => '<p>Carbon content</p>',
        'sent_at' => '2024-09-12T07:21:33.102Z',
    ]);

    expect($broadcast->sent_at)->toBeInstanceOf(Carbon\Carbon::class);
});

it('casts stats to array', function () {
    $stats = ['open_rate' => 35.5, 'click_rate' => 12.3];

    $broadcast = Broadcast::create([
        'bento_id' => 'test-stats-cast',
        'name' => 'Stats Test',
        'subject' => 'Stats Subject',
        'html_content' => '<p>Stats content</p>',
        'stats' => $stats,
    ]);

    expect($broadcast->stats)->toBeArray();
    expect($broadcast->stats)->toBe($stats);
});

it('orders broadcasts by sent_at in descending order with latest scope', function () {
    $old = Broadcast::create([
        'bento_id' => 'old-broadcast',
        'name' => 'Old Broadcast',
        'subject' => 'Old Subject',
        'html_content' => '<p>Old content</p>',
        'sent_at' => now()->subDays(7),
    ]);

    $recent = Broadcast::create([
        'bento_id' => 'recent-broadcast',
        'name' => 'Recent Broadcast',
        'subject' => 'Recent Subject',
        'html_content' => '<p>Recent content</p>',
        'sent_at' => now()->subDays(1),
    ]);

    $broadcasts = Broadcast::latest('sent_at')->get();

    expect($broadcasts->first()->bento_id)->toBe('recent-broadcast');
    expect($broadcasts->last()->bento_id)->toBe('old-broadcast');
});

it('filters only sent broadcasts with sent scope', function () {
    Broadcast::create([
        'bento_id' => 'sent-broadcast',
        'name' => 'Sent Broadcast',
        'subject' => 'Sent Subject',
        'html_content' => '<p>Sent content</p>',
        'sent_at' => now()->subDays(3),
    ]);

    Broadcast::create([
        'bento_id' => 'unsent-broadcast',
        'name' => 'Unsent Broadcast',
        'subject' => 'Unsent Subject',
        'html_content' => '<p>Unsent content</p>',
        'sent_at' => null,
    ]);

    $sentBroadcasts = Broadcast::sent()->get();

    expect($sentBroadcasts)->toHaveCount(1);
    expect($sentBroadcasts->first()->bento_id)->toBe('sent-broadcast');
});
