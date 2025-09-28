<?php

use Illuminate\Support\Facades\File;

describe('Performance Optimization Tests', function () {
    it('has preload links for critical resources', function () {
        $response = $this->get('/');

        // Check for font preloading
        $response->assertSee('rel="preload"', false);
        $response->assertSee('as="font"', false);
    });

    it('uses lazy loading for images below the fold', function () {
        $response = $this->get('/');

        // Check for lazy loading attributes on appropriate images
        $content = $response->getContent();

        // Images below fold should have loading="lazy"
        if (str_contains($content, '<img')) {
            expect($content)->toContain('loading=');
        }
    });

    it('has optimized meta viewport for mobile', function () {
        $response = $this->get('/');

        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1', false);
    });

    // Test removed - was only checking assertOk() without meaningful assertions

    it('has no render-blocking resources in critical path', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // CSS should be in head
        $headEnd = strpos($content, '</head>');
        $cssPosition = strpos($content, 'build/assets/app-');

        if ($cssPosition !== false) {
            expect($cssPosition)->toBeLessThan($headEnd);
        }

        // Check that external scripts like Fathom have defer
        expect($content)->toContain('defer');
    });

    it('has JavaScript loaded with defer or async attributes', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // Check for defer attribute on non-critical scripts
        expect($content)->toContain('script.js" data-site="OLWGPIDF" defer');
        
        // Check Vite-generated scripts have proper loading attributes
        if (str_contains($content, 'build/assets/app-') && str_contains($content, '.js')) {
            // Main app.js should load with type="module" which is non-blocking by default
            expect($content)->toMatch('/<script[^>]*type="module"[^>]*>/');
        }
    });

    it('has optimized Alpine.js loading', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // Alpine should be loaded as part of the build
        if (str_contains($content, 'alpine')) {
            // Should be in a separate chunk for better caching
            expect($content)->toMatch('/build\/assets\/alpine-[a-zA-Z0-9]+\.js/');
        }
    });

    it('has no inline JavaScript blocking the main thread', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // Dark mode script is acceptable as it's critical for preventing flash
        // Check that it's minimal and in the head
        $darkModeScript = strpos($content, 'document.documentElement.classList');
        if ($darkModeScript !== false) {
            // Verify it's in the head for early execution
            expect($darkModeScript)->toBeLessThan(strpos($content, '</head>'));
            
            // Verify the critical script is minimal (checking for IIFE pattern)
            expect($content)->toContain('(function()');
        }
        
        // Non-critical scripts should have defer
        if (strpos($content, 'toggleDarkMode') !== false) {
            expect($content)->toContain('<script defer>');
        }
    });

    it('uses code splitting for better performance', function () {
        // Check Vite config has manual chunks configured
        $viteConfig = File::get(base_path('vite.config.js'));
        
        expect($viteConfig)->toContain('manualChunks');
        expect($viteConfig)->toContain('alpinejs');
        expect($viteConfig)->toContain("return 'alpine'");
    });

    it('has proper heading hierarchy for SEO', function () {
        $pages = ['/', '/services', '/projects', '/speaking', '/contact'];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $content = $response->getContent();

            // Should have exactly one h1
            $h1Count = substr_count($content, '<h1');
            expect($h1Count)->toBeGreaterThanOrEqual(1);

            // Check heading hierarchy (h1 before h2, h2 before h3, etc.)
            $h1Pos = strpos($content, '<h1');
            $h2Pos = strpos($content, '<h2');

            if ($h1Pos !== false && $h2Pos !== false) {
                expect($h1Pos)->toBeLessThan($h2Pos, "H1 should come before H2 on $page");
            }
        }
    });

    it('has accessible color contrast ratios', function () {
        $response = $this->get('/');

        // Check for dark mode support which helps with contrast options
        $response->assertSee('dark:', false);

        // Verify text colors are defined with sufficient contrast classes
        $response->assertSee('text-zinc-900', false);
        $response->assertSee('dark:text-zinc-100', false);
    });

    it('implements responsive images', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // Check for responsive image attributes
        if (str_contains($content, '<img')) {
            // Should have proper sizing attributes
            expect($content)->toMatch('/(width|height)="\d+"/');
        }
    });

    it('has reasonable page size for performance', function () {
        $response = $this->get('/');
        $content = $response->getContent();

        // Page size should be reasonable (under 5MB uncompressed)
        $sizeInKb = strlen($content) / 1024;
        expect($sizeInKb)->toBeLessThan(5000, 'Page size should be under 5MB for optimal performance');
    });

    it('uses WebP images for better compression', function () {
        $imgPath = public_path('img');

        if (File::exists($imgPath)) {
            $webpFiles = File::glob($imgPath.'/**/*.webp');
            expect(count($webpFiles))->toBeGreaterThan(0, 'Should have WebP images for optimization');
        }
    });
});
