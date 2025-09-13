<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class IndexNowSubmitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indexnow:submit {url?} {--generate-key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit URLs to IndexNow for instant search engine indexing';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->option('generate-key')) {
            return $this->generateApiKey();
        }

        return $this->submitUrl();
    }

    /**
     * Generate a new IndexNow API key.
     */
    protected function generateApiKey(): int
    {
        $key = Str::random(32);

        // Delete old verification file if it exists (before updating config)
        $oldKey = config('services.indexnow.key');
        if ($oldKey && File::exists(public_path($oldKey.'.txt'))) {
            File::delete(public_path($oldKey.'.txt'));
        }

        // Update the config value
        config(['services.indexnow.key' => $key]);

        // Create verification file
        $verificationFile = public_path($key.'.txt');

        // Write new verification file
        File::put($verificationFile, $key);

        $this->info('IndexNow API key generated successfully!');
        $this->line('Key saved to INDEXNOW_KEY environment variable');
        $this->line('Verification file created at: public/'.$key.'.txt');
        $this->newLine();
        $this->comment('Add this to your .env file:');
        $this->line('INDEXNOW_KEY='.$key);

        return Command::SUCCESS;
    }

    /**
     * Submit a URL to IndexNow.
     */
    protected function submitUrl(): int
    {
        $key = config('services.indexnow.key');

        if (! $key) {
            $this->error('✗ No IndexNow API key configured.');
            $this->line('Generate one with: php artisan indexnow:submit --generate-key');

            return Command::FAILURE;
        }

        $url = $this->argument('url') ?? config('app.url');

        // Validate URL format
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error('✗ Invalid URL format.');
            $this->line('Please provide a valid URL starting with http:// or https://');

            return Command::FAILURE;
        }

        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];
        $keyLocation = rtrim(config('app.url'), '/').'/'.$key.'.txt';

        try {
            $response = Http::post('https://www.bing.com/indexnow', [
                'host' => $host,
                'key' => $key,
                'keyLocation' => $keyLocation,
                'urlList' => [$url],
            ]);

            switch ($response->status()) {
                case 200:
                case 202:
                    $this->info('✓ URL submitted successfully to IndexNow!');
                    $this->line('URL: '.$url);
                    $this->line('This URL will be shared with: Bing, Yandex, Seznam, and Naver');
                    $this->newLine();
                    $this->comment('To submit more URLs:');
                    $this->line('  php artisan indexnow:submit https://your-site.com/page');
                    $this->line('  php artisan indexnow:submit  # submits APP_URL');

                    return Command::SUCCESS;

                case 403:
                    $this->error('✗ Invalid API key (403)');
                    $this->line('Please generate a new key with: php artisan indexnow:submit --generate-key');

                    return Command::FAILURE;

                case 422:
                    $this->error('✗ URL domain mismatch (422)');
                    $this->line('The URL domain must match your application domain.');

                    return Command::FAILURE;

                case 429:
                    $this->error('✗ Rate limit exceeded (429)');
                    $this->line('Please wait before submitting more URLs.');

                    return Command::FAILURE;

                default:
                    $this->error('✗ Unexpected response ('.$response->status().')');

                    return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $this->error('✗ Error submitting URL: '.$e->getMessage());

            return Command::FAILURE;
        }
    }
}
