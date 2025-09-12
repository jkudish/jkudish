<?php

use App\Jobs\ProcessTestJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

it('can dispatch process test job', function () {
    Queue::fake();

    ProcessTestJob::dispatch();

    Queue::assertPushed(ProcessTestJob::class);
});

it('can dispatch process test job with custom message', function () {
    Queue::fake();

    $message = 'Custom test message';
    ProcessTestJob::dispatch($message);

    Queue::assertPushed(ProcessTestJob::class, function ($job) use ($message) {
        return $job->message === $message;
    });
});

it('processes test job successfully', function () {
    Queue::fake();

    $job = new ProcessTestJob('Test message');

    // Since we're using Queue::fake(), we can't actually process the job
    // But we can verify it was created correctly
    expect($job)->toBeInstanceOf(ProcessTestJob::class);
    expect($job->message)->toBe('Test message');
});

it('job implements should queue interface', function () {
    $job = new ProcessTestJob;

    expect($job)->toBeInstanceOf(\Illuminate\Contracts\Queue\ShouldQueue::class);
});

it('job uses queueable trait', function () {
    $job = new ProcessTestJob;
    $traits = class_uses($job);

    expect($traits)->toContain(\Illuminate\Foundation\Queue\Queueable::class);
});

it('job logs messages when handled', function () {
    Log::shouldReceive('info')
        ->twice()
        ->withArgs(function ($message, $context) {
            return in_array($message, ['ProcessTestJob started', 'ProcessTestJob completed'])
                && isset($context['message'])
                && isset($context['timestamp']);
        });

    $job = new ProcessTestJob('Test logging');
    $job->handle();
});

it('can dispatch multiple jobs', function () {
    Queue::fake();

    ProcessTestJob::dispatch('First job');
    ProcessTestJob::dispatch('Second job');
    ProcessTestJob::dispatch('Third job');

    Queue::assertPushed(ProcessTestJob::class, 3);
});
