<?php

use Illuminate\Support\Facades\File;

describe('Resource Loading Optimization Tests', function () {
    it('has preconnect hints for external domains', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Should have preconnect for analytics (Fathom)
        if (str_contains($content, 'cdn.usefathom.com')) {
            expect($content)->toContain('<link rel="preconnect"')
                ->and($content)->toContain('cdn.usefathom.com');
        }
    });

    it('implements lazy loading for below-fold images', function () {
        $pages = ['/', '/projects', '/services'];
        
        foreach ($pages as $page) {
            $response = $this->get($page);
            $content = $response->getContent();
            
            // Count images
            preg_match_all('/<img[^>]+>/i', $content, $images);
            
            if (count($images[0]) > 1) {
                // At least some images should have lazy loading
                $hasLazyLoading = false;
                foreach ($images[0] as $img) {
                    if (str_contains($img, 'loading="lazy"')) {
                        $hasLazyLoading = true;
                        break;
                    }
                }
                
                expect($hasLazyLoading)->toBeTrue("Page $page should have lazy loading on some images");
            }
        }
    });

    it('has proper image dimensions specified', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check that images have width and height attributes
        preg_match_all('/<img[^>]+>/i', $content, $images);
        
        if (count($images[0]) > 0) {
            $imagesWithDimensions = 0;
            foreach ($images[0] as $img) {
                // Check if image has dimensions or CSS classes that define dimensions
                $hasWidth = str_contains($img, 'width=');
                $hasHeight = str_contains($img, 'height=');
                $hasSizeClass = str_contains($img, 'w-') && str_contains($img, 'h-');
                
                if ($hasWidth || $hasHeight || $hasSizeClass) {
                    $imagesWithDimensions++;
                }
            }
            
            // Most images should have dimensions specified
            $percentageWithDimensions = ($imagesWithDimensions / count($images[0])) * 100;
            expect($percentageWithDimensions)->toBeGreaterThanOrEqual(50, "At least 50% of images should have dimensions");
        }
    });

    it('serves optimized image formats', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check for WebP images with fallbacks
        if (str_contains($content, '<img')) {
            // Should use WebP where possible
            $hasWebP = str_contains($content, '.webp');
            expect($hasWebP)->toBeTrue("Should use WebP images for better compression");
        }
    });

    it('has efficient asset bundling', function () {
        // Check that Vite manifest exists
        $manifestPath = public_path('build/manifest.json');
        expect(File::exists($manifestPath))->toBeTrue();
        
        if (File::exists($manifestPath)) {
            $manifest = json_decode(File::get($manifestPath), true);
            
            // Should have separate chunks for better caching
            $hasMultipleChunks = count($manifest) > 2;
            expect($hasMultipleChunks)->toBeTrue("Should split code into multiple chunks");
        }
    });

    it('implements critical CSS inline or preload', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // CSS should be loaded efficiently
        $cssInHead = preg_match('/<link[^>]+rel="stylesheet"[^>]*>/', $content, $matches, PREG_OFFSET_CAPTURE);
        
        if ($cssInHead) {
            $cssPosition = $matches[0][1];
            $headEnd = strpos($content, '</head>');
            
            // CSS should be in head
            expect($cssPosition)->toBeLessThan($headEnd);
        }
    });

    it('avoids excessive DOM size', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Count total DOM elements (rough estimate)
        preg_match_all('/<[^>]+>/', $content, $elements);
        $domSize = count($elements[0]);
        
        // Lighthouse recommends < 1500 DOM elements
        expect($domSize)->toBeLessThan(1500, "DOM size should be under 1500 elements for performance");
    });

    it('minimizes external script loading', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Count external scripts
        preg_match_all('/<script[^>]+src="[^"]+"/i', $content, $scripts);
        $externalScripts = 0;
        
        foreach ($scripts[0] as $script) {
            if (str_contains($script, 'http://') || str_contains($script, 'https://') || str_contains($script, '//')) {
                if (!str_contains($script, config('app.url'))) {
                    $externalScripts++;
                }
            }
        }
        
        // Should minimize external scripts (analytics, fonts, etc are acceptable)
        expect($externalScripts)->toBeLessThanOrEqual(5, "Should minimize external script dependencies");
    });

    it('uses resource hints effectively', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check for various resource hints
        $hasPreload = str_contains($content, 'rel="preload"');
        $hasPreconnect = str_contains($content, 'rel="preconnect"') || !str_contains($content, 'cdn.');
        
        expect($hasPreload)->toBeTrue("Should use preload for critical resources");
        expect($hasPreconnect)->toBeTrue("Should use preconnect for external domains if any");
    });
});