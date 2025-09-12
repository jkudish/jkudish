<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessTestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $message = 'Test job executed successfully'
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ProcessTestJob started', [
            'message' => $this->message,
            'timestamp' => now()->toDateTimeString(),
        ]);

        // Simulate some processing
        sleep(2);

        Log::info('ProcessTestJob completed', [
            'message' => $this->message,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
