<?php

namespace App\Console\Commands;

use App\Integrations\BentoService;
use App\Models\Broadcast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-newsletters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync newsletter broadcasts from Bento API to local database';

    /**
     * Execute the console command.
     */
    public function handle(BentoService $bentoService): int
    {
        $this->info('Starting newsletter sync from Bento API...');

        try {
            $broadcasts = $bentoService->getBroadcasts();

            if (empty($broadcasts)) {
                $this->warn('No broadcasts found in Bento API');
                Log::info('Newsletter sync completed: No broadcasts found');
                return self::SUCCESS;
            }

            $newCount = 0;
            $updatedCount = 0;

            foreach ($broadcasts as $broadcastData) {
                // Extract issue number from name (e.g., "Issue #001: Title" -> "001")
                $issueNumber = $this->extractIssueNumber($broadcastData['name']);

                // Clean up content - remove accidental double chat emoji
                $cleanedContent = str_replace('💬💬', '', $broadcastData['html_content']);

                $broadcast = Broadcast::updateOrCreate(
                    ['bento_id' => $broadcastData['bento_id']],
                    [
                        'issue_number' => $issueNumber,
                        'name' => $broadcastData['name'],
                        'subject' => $broadcastData['subject'],
                        'html_content' => $cleanedContent,
                        'share_url' => $broadcastData['share_url'],
                        'sent_at' => $broadcastData['sent_at'],
                        'stats' => $broadcastData['stats'],
                    ]
                );

                if ($broadcast->wasRecentlyCreated) {
                    $newCount++;
                } else {
                    $updatedCount++;
                }
            }

            $this->info("Newsletter sync completed successfully!");
            $this->info("New broadcasts: {$newCount}");
            $this->info("Updated broadcasts: {$updatedCount}");
            $this->info("Total broadcasts: ".count($broadcasts));

            Log::info('Newsletter sync completed', [
                'new_count' => $newCount,
                'updated_count' => $updatedCount,
                'total_count' => count($broadcasts),
            ]);

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Newsletter sync failed: '.$e->getMessage());
            Log::error('Newsletter sync failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return self::FAILURE;
        }
    }

    /**
     * Extract issue number from broadcast name
     */
    private function extractIssueNumber(string $name): ?string
    {
        // Match patterns like "Issue #001:" or "Issue #1:" etc.
        if (preg_match('/Issue\s*#(\d+)/i', $name, $matches)) {
            // Pad to 3 digits for consistency (001, 002, etc.)
            return str_pad($matches[1], 3, '0', STR_PAD_LEFT);
        }

        return null;
    }
}
