<?php

use Illuminate\Support\Facades\File;

describe('Frontend Optimization Tests', function () {
    it('has compiled CSS assets', function () {
        $cssPath = public_path('build/assets');
        
        expect(File::exists($cssPath))->toBeTrue('Build assets directory should exist');
        
        $cssFiles = File::glob($cssPath . '/*.css');
        expect(count($cssFiles))->toBeGreaterThan(0, 'Should have compiled CSS files');
    });

    it('has compiled JavaScript assets', function () {
        $jsPath = public_path('build/assets');
        
        $jsFiles = File::glob($jsPath . '/*.js');
        expect(count($jsFiles))->toBeGreaterThan(0, 'Should have compiled JavaScript files');
    });

    it('has manifest file for Vite', function () {
        $manifestPath = public_path('build/manifest.json');
        
        expect(File::exists($manifestPath))->toBeTrue('Vite manifest should exist');
        
        $manifest = json_decode(File::get($manifestPath), true);
        expect($manifest)->toBeArray();
        expect($manifest)->not->toBeEmpty();
    });

    // Test removed - was only checking assertSuccessful() without meaningful assertions

    it('has optimized image assets', function () {
        $imgPath = public_path('img');
        
        expect(File::exists($imgPath))->toBeTrue('Images directory should exist');
        
        // Check for WebP images (optimized format)
        $webpFiles = File::glob($imgPath . '/**/*.webp');
        expect(count($webpFiles))->toBeGreaterThan(0, 'Should have WebP optimized images');
    });

    it('has proper asset versioning for cache busting', function () {
        $manifestPath = public_path('build/manifest.json');
        
        if (File::exists($manifestPath)) {
            $manifest = json_decode(File::get($manifestPath), true);
            
            foreach ($manifest as $key => $asset) {
                if (isset($asset['file'])) {
                    // Check that assets have hash in filename for cache busting
                    expect($asset['file'])->toMatch('/\-[A-Za-z0-9]{8}\.(css|js)$/');
                }
            }
        }
    });

    it('loads CSS before JavaScript for performance', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Find positions of CSS and JS includes
        $cssPosition = strpos($content, '<link');
        $jsPosition = strpos($content, '<script');
        
        if ($cssPosition !== false && $jsPosition !== false) {
            expect($cssPosition)->toBeLessThan($jsPosition, 'CSS should load before JavaScript');
        }
    });

    it('has no console errors on main pages', function () {
        $pages = ['/', '/services', '/projects', '/speaking', '/contact', '/newsletter'];
        
        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertSuccessful();
            
            // Check that pages don't have obvious JavaScript errors in the HTML
            $response->assertDontSee('console.error', false);
            $response->assertDontSee('Uncaught', false);
            $response->assertDontSee('TypeError', false);
            $response->assertDontSee('ReferenceError', false);
        }
    });
});