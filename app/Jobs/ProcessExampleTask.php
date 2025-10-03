<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessExampleTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public int $timeout = 60;

    /**
     * The data to process.
     */
    public string $data;

    /**
     * Create a new job instance.
     */
    public function __construct(string $data = 'Example Task')
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Processing example task', [
            'data' => $this->data,
            'job_id' => $this->job->getJobId(),
            'queue' => $this->job->getQueue(),
            'attempts' => $this->attempts(),
        ]);

        // Simulate some work
        sleep(2);

        // Example of different outcomes for testing
        if (str_contains($this->data, 'fail')) {
            throw new \Exception('Job failed as requested for testing');
        }

        Log::info('Example task completed successfully', [
            'data' => $this->data,
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?\Throwable $exception): void
    {
        Log::error('Example task failed', [
            'data' => $this->data,
            'error' => $exception->getMessage(),
        ]);
    }

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryUntil(): \DateTime
    {
        return now()->addMinutes(10);
    }
}
