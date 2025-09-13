<?php

use Illuminate\Support\Facades\File;

describe('Font Loading Optimization Tests', function () {
    it('has font-display swap for all custom fonts', function () {
        $cssFile = public_path('build/assets/app-OD3mY3nb.css');
        
        if (File::exists($cssFile)) {
            $cssContent = File::get($cssFile);
            
            // Check all @font-face declarations have font-display: swap
            if (str_contains($cssContent, '@font-face')) {
                preg_match_all('/@font-face\s*{[^}]+}/s', $cssContent, $fontFaces);
                
                foreach ($fontFaces[0] as $fontFace) {
                    $hasSwap = str_contains($fontFace, 'font-display:swap') || 
                              str_contains($fontFace, 'font-display: swap');
                    expect($hasSwap)->toBeTrue("Font face should have font-display: swap");
                }
            }
        } else {
            // Check in the source CSS if build doesn't exist
            $sourceCss = resource_path('css/app.css');
            if (File::exists($sourceCss)) {
                $cssContent = File::get($sourceCss);
                
                if (str_contains($cssContent, '@font-face')) {
                    expect($cssContent)->toContain('font-display');
                }
            }
        }
    });

    it('preloads critical fonts in the document head', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check for font preloading
        expect($content)->toContain('rel="preload"');
        expect($content)->toContain('as="font"');
        expect($content)->toContain('type="font/woff');
        
        // Verify critical fonts are preloaded
        $hasTelegraf = str_contains($content, 'Telegraf') || str_contains($content, 'telegraf');
        expect($hasTelegraf)->toBeTrue("Should preload Telegraf font");
        expect($content)->toContain('muli-regular');
        
        // Verify crossorigin attribute for fonts
        expect($content)->toContain('crossorigin="anonymous"');
    });

    it('uses appropriate font formats for browser support', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Modern formats should be prioritized
        if (str_contains($content, 'font')) {
            // WOFF2 for modern browsers
            expect($content)->toContain('.woff2');
            // WOFF as fallback
            expect($content)->toContain('.woff');
        }
    });

    it('has system font fallbacks defined', function () {
        $cssFile = public_path('build/assets/app-OD3mY3nb.css');
        
        if (!File::exists($cssFile)) {
            // Try to find any CSS file in build directory
            $buildFiles = File::glob(public_path('build/assets/*.css'));
            if (!empty($buildFiles)) {
                $cssFile = $buildFiles[0];
            }
        }
        
        if (File::exists($cssFile)) {
            $cssContent = File::get($cssFile);
            
            // Check for system font stack fallbacks
            $systemFonts = [
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                'Segoe UI',
                'sans-serif'
            ];
            
            $hasSystemFallback = false;
            foreach ($systemFonts as $font) {
                if (str_contains($cssContent, $font)) {
                    $hasSystemFallback = true;
                    break;
                }
            }
            
            expect($hasSystemFallback)->toBeTrue();
        }
    });

    it('loads fonts from local server for performance', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Fonts should be loaded from local assets, not external CDNs
        if (str_contains($content, 'fonts/')) {
            $hasLocalFonts = str_contains($content, '/fonts/') || 
                            str_contains($content, 'asset(\'fonts/');
            expect($hasLocalFonts)->toBeTrue("Should load fonts locally");
            
            // Should NOT load from Google Fonts or other CDNs
            expect($content)->not->toContain('fonts.googleapis.com');
            expect($content)->not->toContain('fonts.gstatic.com');
        }
    });

    it('has minimal font file sizes', function () {
        $fontsPath = public_path('fonts');
        
        if (File::exists($fontsPath)) {
            $fontFiles = File::files($fontsPath);
            
            foreach ($fontFiles as $fontFile) {
                $fileSizeKb = $fontFile->getSize() / 1024;
                
                // Font files should be reasonably sized (under 200KB each)
                expect($fileSizeKb)->toBeLessThan(200, 
                    "Font file {$fontFile->getFilename()} is too large: {$fileSizeKb}KB");
            }
        }
    });

    it('implements critical font loading strategy', function () {
        $response = $this->get('/');
        $content = $response->getContent();
        
        // Check that preload links appear before CSS
        $preloadPos = strpos($content, 'rel="preload"');
        $cssPos = strpos($content, '<link rel="stylesheet"');
        
        if ($preloadPos !== false && $cssPos !== false) {
            // Preload should come before stylesheets
            expect($preloadPos)->toBeLessThan($cssPos);
        }
        
        // Preload links should be in the head
        if ($preloadPos !== false) {
            $headEnd = strpos($content, '</head>');
            expect($preloadPos)->toBeLessThan($headEnd);
        }
    });
});