<?php

use App\Integrations\BentoService;
use App\Models\Broadcast;

it('syncs newsletters from Bento API successfully', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([
            [
                'bento_id' => '1234',
                'name' => 'Test Newsletter 1',
                'subject' => 'Test Subject 1',
                'html_content' => '<h1>Content 1</h1>',
                'share_url' => 'https://example.com/1234',
                'sent_at' => '2024-09-12T07:21:33.102Z',
                'stats' => ['open_rate' => 42.5],
            ],
            [
                'bento_id' => '1235',
                'name' => 'Test Newsletter 2',
                'subject' => 'Test Subject 2',
                'html_content' => '<h1>Content 2</h1>',
                'share_url' => 'https://example.com/1235',
                'sent_at' => '2024-09-13T08:15:22.102Z',
                'stats' => ['open_rate' => 38.2],
            ],
        ]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('Starting newsletter sync from Bento API...')
        ->expectsOutput('Newsletter sync completed successfully!')
        ->expectsOutput('New broadcasts: 2')
        ->expectsOutput('Updated broadcasts: 0')
        ->expectsOutput('Total broadcasts: 2')
        ->assertExitCode(0);

    expect(Broadcast::count())->toBe(2);
    expect(Broadcast::where('bento_id', '1234')->exists())->toBeTrue();
    expect(Broadcast::where('bento_id', '1235')->exists())->toBeTrue();
});

it('prevents duplicate broadcasts when syncing', function () {
    // Create an existing broadcast
    Broadcast::create([
        'bento_id' => '1234',
        'name' => 'Old Name',
        'subject' => 'Old Subject',
        'html_content' => '<p>Old content</p>',
        'sent_at' => now()->subDays(7),
    ]);

    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([
            [
                'bento_id' => '1234',
                'name' => 'Updated Newsletter',
                'subject' => 'Updated Subject',
                'html_content' => '<h1>Updated Content</h1>',
                'share_url' => 'https://example.com/1234',
                'sent_at' => '2024-09-12T07:21:33.102Z',
                'stats' => ['open_rate' => 42.5],
            ],
        ]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('New broadcasts: 0')
        ->expectsOutput('Updated broadcasts: 1')
        ->assertExitCode(0);

    expect(Broadcast::count())->toBe(1);

    $broadcast = Broadcast::where('bento_id', '1234')->first();
    expect($broadcast->name)->toBe('Updated Newsletter');
    expect($broadcast->subject)->toBe('Updated Subject');
    expect($broadcast->html_content)->toBe('<h1>Updated Content</h1>');
});

it('handles empty API response gracefully', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('Starting newsletter sync from Bento API...')
        ->expectsOutput('No broadcasts found in Bento API')
        ->assertExitCode(0);

    expect(Broadcast::count())->toBe(0);
});

it('handles sync errors gracefully', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andThrow(new \Exception('API connection failed'));

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('Starting newsletter sync from Bento API...')
        ->expectsOutput('Newsletter sync failed: API connection failed')
        ->assertExitCode(1);

    expect(Broadcast::count())->toBe(0);
});
