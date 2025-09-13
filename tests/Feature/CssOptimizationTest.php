<?php

use Illuminate\Support\Facades\File;

describe('CSS Optimization Tests', function () {
    it('has CSS loaded in the document head', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Find CSS link position
        preg_match('/<link[^>]+rel="stylesheet"[^>]*>/i', $content, $matches, PREG_OFFSET_CAPTURE);
        
        if (!empty($matches)) {
            $cssPosition = $matches[0][1];
            $headEnd = strpos($content, '</head>');
            
            // CSS should be in head
            expect($cssPosition)->toBeLessThan($headEnd);
        }
    });

    it('has minified CSS in production', function () {
        $buildFiles = File::glob(public_path('build/assets/*.css'));
        
        if (!empty($buildFiles)) {
            foreach ($buildFiles as $cssFile) {
                $content = File::get($cssFile);
                
                // Check for minification indicators
                $lines = explode("\n", $content);
                $averageLineLength = strlen($content) / count($lines);
                
                // Minified CSS typically has very long lines
                expect($averageLineLength)->toBeGreaterThan(100, "CSS should be minified");
                
                // Should not have excessive whitespace
                $hasDoubleSpaces = str_contains($content, '  ');
                expect($hasDoubleSpaces)->toBeFalse("CSS should not have double spaces");
            }
        }
    });

    it('uses efficient CSS file size', function () {
        $buildFiles = File::glob(public_path('build/assets/*.css'));
        
        if (!empty($buildFiles)) {
            foreach ($buildFiles as $cssFile) {
                $fileSizeKb = filesize($cssFile) / 1024;
                
                // CSS should be reasonably sized (under 150KB)
                expect($fileSizeKb)->toBeLessThan(150, "CSS file size should be under 150KB");
            }
        }
    });

    it('has TailwindCSS properly configured', function () {
        $tailwindConfig = base_path('tailwind.config.js');
        
        if (File::exists($tailwindConfig)) {
            $config = File::get($tailwindConfig);
            
            // Check for content/purge configuration
            $hasContentConfig = str_contains($config, 'content:') || str_contains($config, 'purge:');
            expect($hasContentConfig)->toBeTrue("Tailwind should have content/purge configuration");
            
            // Should scan the right directories
            expect($config)->toContain('./resources/');
            expect($config)->toContain('.blade.php');
        }
    });

    it('removes unused CSS in production', function () {
        $buildFiles = File::glob(public_path('build/assets/*.css'));
        
        if (!empty($buildFiles)) {
            $cssFile = $buildFiles[0];
            $content = File::get($cssFile);
            
            // Check that file doesn't contain every possible Tailwind class
            // A properly purged file should be much smaller than unpurged
            $fileSizeKb = filesize($cssFile) / 1024;
            
            // Purged TailwindCSS should typically be under 150KB
            expect($fileSizeKb)->toBeLessThan(150, "CSS should be purged of unused styles");
        }
    });

    it('includes critical styles for above-fold content', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check for essential utility classes used in above-fold content
        $buildFiles = File::glob(public_path('build/assets/*.css'));
        
        if (!empty($buildFiles)) {
            $cssContent = File::get($buildFiles[0]);
            
            // Should include essential layout classes
            $essentialClasses = ['flex', 'grid', 'container', 'text-'];
            
            foreach ($essentialClasses as $class) {
                expect($cssContent)->toContain($class);
            }
        }
    });

    it('has proper CSS loading strategy', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // CSS should not block rendering unnecessarily
        preg_match_all('/<link[^>]+rel="stylesheet"[^>]*>/i', $content, $stylesheets);
        
        // Should have only necessary stylesheets (1-2 max)
        expect(count($stylesheets[0]))->toBeLessThanOrEqual(2, "Should minimize number of stylesheets");
    });

    it('uses CSS custom properties for theming', function () {
        $cssFile = resource_path('css/app.css');
        
        if (File::exists($cssFile)) {
            $content = File::get($cssFile);
            
            // Should use CSS variables for theming
            $hasCustomProperties = str_contains($content, '--color') || 
                                  str_contains($content, '--font') || 
                                  str_contains($content, '@theme');
            expect($hasCustomProperties)->toBeTrue("CSS should use custom properties for theming");
        }
    });
});