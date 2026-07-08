<?php

use App\Integrations\BentoService;
use App\Models\Broadcast;
use Illuminate\Support\Facades\Http;

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

it('extracts issue numbers from newsletter subjects when names omit them', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([
            [
                'bento_id' => '1238',
                'name' => 'New Broadcast - 2026-07-07',
                'subject' => 'Issue #008: The Missing Issue',
                'html_content' => '<h1>Content 8</h1>',
                'share_url' => 'https://example.com/1238',
                'sent_at' => '2024-09-18T08:15:22.102Z',
                'stats' => ['open_rate' => 38.2],
            ],
        ]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('New broadcasts: 1')
        ->expectsOutput('Updated broadcasts: 0')
        ->assertExitCode(0);

    $broadcast = Broadcast::where('bento_id', '1238')->first();

    expect($broadcast->issue_number)->toBe('008');
    expect($broadcast->name)->toBe('#008 - The Missing Issue');
});

it('extracts issue numbers from bare numeric Bento names', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([
            [
                'bento_id' => '1239',
                'name' => '08',
                'subject' => 'From Doing to Directing',
                'html_content' => '<h1>Content 8</h1>',
                'share_url' => 'https://example.com/1239',
                'sent_at' => '2024-09-18T08:15:22.102Z',
                'stats' => ['open_rate' => 38.2],
            ],
        ]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('New broadcasts: 1')
        ->expectsOutput('Updated broadcasts: 0')
        ->assertExitCode(0);

    $broadcast = Broadcast::where('bento_id', '1239')->first();

    expect($broadcast->issue_number)->toBe('008');
    expect($broadcast->name)->toBe('#008 - From Doing to Directing');
});

it('infers missing issue numbers from chronological broadcast order', function () {
    $bentoService = Mockery::mock(BentoService::class);
    $bentoService->shouldReceive('getBroadcasts')
        ->once()
        ->andReturn([
            [
                'bento_id' => '14',
                'name' => 'Issue #014: Your Failed Experiments Have Expired',
                'subject' => 'Issue #014: Your Failed Experiments Have Expired',
                'html_content' => '<h1>Issue 14</h1>',
                'share_url' => 'https://example.com/14',
                'sent_at' => '2024-10-04T08:15:22.102Z',
                'stats' => ['open_rate' => 42.5],
            ],
            [
                'bento_id' => '10',
                'name' => 'Issue #010: Thirty-Five Hours',
                'subject' => 'Thirty-Five Hours',
                'html_content' => '<h1>Issue 10</h1>',
                'share_url' => 'https://example.com/10',
                'sent_at' => '2024-09-06T08:15:22.102Z',
                'stats' => ['open_rate' => 42.5],
            ],
            [
                'bento_id' => '11',
                'name' => 'New Broadcast - 2024-09-13',
                'subject' => 'Context as Infrastructure',
                'html_content' => '<h1>Issue 11</h1>',
                'share_url' => 'https://example.com/11',
                'sent_at' => '2024-09-13T08:15:22.102Z',
                'stats' => ['open_rate' => 38.2],
            ],
            [
                'bento_id' => '12',
                'name' => 'New Broadcast - 2024-09-20',
                'subject' => 'Introducing Agentsy',
                'html_content' => '<h1>Issue 12</h1>',
                'share_url' => 'https://example.com/12',
                'sent_at' => '2024-09-20T08:15:22.102Z',
                'stats' => ['open_rate' => 41.5],
            ],
            [
                'bento_id' => '13',
                'name' => 'Plan Once, Then Get Out of the Way',
                'subject' => 'Plan Once, Then Get Out of the Way',
                'html_content' => '<h1>Issue 13</h1>',
                'share_url' => 'https://example.com/13',
                'sent_at' => '2024-09-27T08:15:22.102Z',
                'stats' => ['open_rate' => 40.1],
            ],
        ]);

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('New broadcasts: 5')
        ->expectsOutput('Updated broadcasts: 0')
        ->assertExitCode(0);

    expect(Broadcast::where('bento_id', '11')->first()->issue_number)->toBe('011');
    expect(Broadcast::where('bento_id', '12')->first()->issue_number)->toBe('012');
    expect(Broadcast::where('bento_id', '13')->first()->issue_number)->toBe('013');
    expect(Broadcast::where('bento_id', '13')->first()->name)->toBe('#013 - Plan Once, Then Get Out of the Way');
});

it('fetches all sent newsletter broadcasts from paginated Bento API', function () {
    config([
        'bentonow.publishable_key' => 'publishable-test-key',
        'bentonow.secret_key' => 'secret-test-key',
        'bentonow.site_uuid' => 'site-test-uuid',
    ]);

    Http::fake([
        'https://app.bentonow.com/api/v1/fetch/broadcasts*' => Http::sequence()
            ->push([
                'data' => [
                    [
                        'id' => 'page-1',
                        'attributes' => [
                            'name' => 'Issue #011: Page One',
                            'template' => [
                                'subject' => 'Issue #011: Page One',
                                'html' => '<h1>Page One</h1>',
                            ],
                            'share_url' => 'https://example.com/page-1',
                            'sent_final_batch_at' => '2024-09-21T08:15:22.102Z',
                            'stats' => ['open_rate' => 38.2],
                        ],
                    ],
                ],
            ])
            ->push([
                'data' => [
                    [
                        'id' => 'page-2',
                        'attributes' => [
                            'name' => 'Issue #012: Page Two',
                            'template' => [
                                'subject' => 'Issue #012: Page Two',
                                'html' => '<h1>Page Two</h1>',
                            ],
                            'share_url' => 'https://example.com/page-2',
                            'sent_final_batch_at' => '2024-09-28T08:15:22.102Z',
                            'stats' => ['open_rate' => 41.5],
                        ],
                    ],
                ],
            ])
            ->push(['data' => []]),
    ]);

    $broadcasts = app(BentoService::class)->getBroadcasts();

    expect($broadcasts)->toHaveCount(2);
    expect($broadcasts[0]['bento_id'])->toBe('page-1');
    expect($broadcasts[1]['bento_id'])->toBe('page-2');

    Http::assertSentCount(3);
    Http::assertSent(fn ($request) => str_contains($request->url(), 'page=2')
        && str_contains($request->url(), 'status=sent'));
});

it('stops fetching newsletter broadcasts at configured page limit', function () {
    config([
        'bentonow.publishable_key' => 'publishable-test-key',
        'bentonow.secret_key' => 'secret-test-key',
        'bentonow.site_uuid' => 'site-test-uuid',
        'bentonow.broadcasts_max_pages' => 2,
    ]);

    Http::fake([
        'https://app.bentonow.com/api/v1/fetch/broadcasts*' => Http::sequence()
            ->push([
                'data' => [
                    [
                        'id' => 'page-1',
                        'attributes' => [
                            'name' => 'Issue #011: Page One',
                            'template' => [
                                'subject' => 'Issue #011: Page One',
                                'html' => '<h1>Page One</h1>',
                            ],
                            'sent_final_batch_at' => '2024-09-21T08:15:22.102Z',
                        ],
                    ],
                ],
            ])
            ->push([
                'data' => [
                    [
                        'id' => 'page-2',
                        'attributes' => [
                            'name' => 'Issue #012: Page Two',
                            'template' => [
                                'subject' => 'Issue #012: Page Two',
                                'html' => '<h1>Page Two</h1>',
                            ],
                            'sent_final_batch_at' => '2024-09-28T08:15:22.102Z',
                        ],
                    ],
                ],
            ])
            ->push([
                'data' => [
                    [
                        'id' => 'page-3',
                        'attributes' => [
                            'name' => 'Issue #013: Page Three',
                            'template' => [
                                'subject' => 'Issue #013: Page Three',
                                'html' => '<h1>Page Three</h1>',
                            ],
                            'sent_final_batch_at' => '2024-10-05T08:15:22.102Z',
                        ],
                    ],
                ],
            ]),
    ]);

    $broadcasts = app(BentoService::class)->getBroadcasts();

    expect($broadcasts)->toHaveCount(2);
    expect($broadcasts[0]['bento_id'])->toBe('page-1');
    expect($broadcasts[1]['bento_id'])->toBe('page-2');

    Http::assertSentCount(2);
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
        ->andThrow(new Exception('API connection failed'));

    $this->app->instance(BentoService::class, $bentoService);

    $this->artisan('app:sync-newsletters')
        ->expectsOutput('Starting newsletter sync from Bento API...')
        ->expectsOutput('Newsletter sync failed: API connection failed')
        ->assertExitCode(1);

    expect(Broadcast::count())->toBe(0);
});
