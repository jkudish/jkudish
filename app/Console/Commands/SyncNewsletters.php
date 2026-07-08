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

            $broadcasts = $this->assignIssueNumbers($broadcasts);

            $newCount = 0;
            $updatedCount = 0;

            foreach ($broadcasts as $broadcastData) {
                // Extract issue number from name (e.g., "Issue #001: Title" -> "001")
                $issueNumber = $broadcastData['issue_number']
                    ?? $this->extractIssueNumber($broadcastData['name'], $broadcastData['subject']);

                // Normalize name to consistent format: "#001 - Title"
                $normalizedName = $this->normalizeName($broadcastData['name'], $issueNumber, $broadcastData['subject']);

                // Clean up content - remove accidental double chat emoji
                $cleanedContent = str_replace('💬💬', '', $broadcastData['html_content']);

                $broadcast = Broadcast::updateOrCreate(
                    ['bento_id' => $broadcastData['bento_id']],
                    [
                        'issue_number' => $issueNumber,
                        'name' => $normalizedName,
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

            $this->info('Newsletter sync completed successfully!');
            $this->info("New broadcasts: {$newCount}");
            $this->info("Updated broadcasts: {$updatedCount}");
            $this->info('Total broadcasts: '.count($broadcasts));

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
    private function extractIssueNumber(string $name, ?string $subject = null): ?string
    {
        foreach (array_filter([$name, $subject]) as $value) {
            // Match patterns like "Issue #001:", "#001 -", "Issue #1:", or "004 -" (leading digits)
            if (preg_match('/(?:Issue\s*)?#(\d+)/i', $value, $matches)) {
                // Pad to 3 digits for consistency (001, 002, etc.)
                return str_pad($matches[1], 3, '0', STR_PAD_LEFT);
            }

            // Match patterns like "Issue 001:" or "Issue 1 - Title"
            if (preg_match('/Issue\s+(\d+)/i', $value, $matches)) {
                return str_pad($matches[1], 3, '0', STR_PAD_LEFT);
            }

            // Match leading digits at start of value (e.g., "004 - Title")
            if (preg_match('/^(\d+)\s*-/', $value, $matches)) {
                return str_pad($matches[1], 3, '0', STR_PAD_LEFT);
            }

            // Match bare numeric names from Bento, e.g. "08"
            if (preg_match('/^(\d+)$/', trim($value), $matches)) {
                return str_pad($matches[1], 3, '0', STR_PAD_LEFT);
            }
        }

        return null;
    }

    /**
     * Infer issue numbers for older Bento broadcasts whose names/subjects omitted them.
     *
     * @param  array<int, array<string, mixed>>  $broadcasts
     * @return array<int, array<string, mixed>>
     */
    private function assignIssueNumbers(array $broadcasts): array
    {
        usort($broadcasts, fn (array $first, array $second): int => strcmp($first['sent_at'], $second['sent_at']));

        $lastIssueNumber = null;

        return array_map(function (array $broadcast) use (&$lastIssueNumber): array {
            $issueNumber = $this->extractIssueNumber($broadcast['name'], $broadcast['subject']);

            if ($issueNumber !== null) {
                $lastIssueNumber = (int) $issueNumber;
                $broadcast['issue_number'] = $issueNumber;

                return $broadcast;
            }

            if ($lastIssueNumber !== null) {
                $lastIssueNumber++;
                $broadcast['issue_number'] = str_pad((string) $lastIssueNumber, 3, '0', STR_PAD_LEFT);
            }

            return $broadcast;
        }, $broadcasts);
    }

    /**
     * Normalize broadcast name to consistent format: "#001 - Title"
     */
    private function normalizeName(string $name, ?string $issueNumber, ?string $subject = null): string
    {
        if ($issueNumber === null) {
            return $name;
        }

        $source = $this->extractIssueNumber($name) !== null ? $name : ($subject ?: $name);

        // Extract the title portion by removing issue number prefixes
        // Handles: "Issue #001: Title", "Issue #001 - Title", "#001 - Title", "001 - Title", "Issue 001"
        $title = trim(preg_replace('/^(?:Issue\s*)?#?\d+\s*(?:[-:]\s*)?/i', '', $source));

        if ($title === '') {
            $title = trim((string) preg_replace('/^(?:Issue\s*)?#?\d+\s*(?:[-:]\s*)?/i', '', (string) $subject));
        }

        if ($title === '') {
            $title = $name;
        }

        return "#{$issueNumber} - {$title}";
    }
}
