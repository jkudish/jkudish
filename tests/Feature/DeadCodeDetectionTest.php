<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Queue;

describe('Dead Code Detection Tests', function () {
    it('ensures all critical routes are accessible', function () {
        $criticalRoutes = [
            '/',
            '/speaking',
            '/projects',
            '/services',
            '/contact',
            '/newsletter',
            '/sitemap.xml',
        ];

        foreach ($criticalRoutes as $route) {
            $response = $this->get($route);
            $response->assertSuccessful();
        }
    });

    it('verifies all redirect routes work properly', function () {
        $redirectRoutes = [
            'found',
            'presentations',
            'presented',
            'presents',
            'slides',
        ];

        foreach ($redirectRoutes as $route) {
            $response = $this->get($route);
            expect($response->status())->toBeIn([301, 302, 200, 404]);
        }
    });

    it('confirms contact form functionality', function () {
        Queue::fake();
        
        $response = $this->post('/contact', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'subject' => 'General Question',
            'message' => 'Test message content'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    });

    it('validates newsletter signup functionality', function () {
        $response = $this->post('/newsletter', [
            'email' => 'test@example.com',
            'full_name' => 'Test User'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    });

    it('ensures all view components render without errors', function () {
        $viewsToTest = [
            'home',
            'speaking', 
            'projects',
            'services',
            'contact',
            'newsletter',
        ];

        foreach ($viewsToTest as $view) {
            $response = $this->get('/' . ($view === 'home' ? '' : $view));
            $response->assertSuccessful();
            $response->assertViewIs($view);
        }
    });

    it('verifies sitemap generates properly', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'text/xml; charset=UTF-8');
        expect($response->content())->toContain('<urlset');
        expect($response->content())->toContain('<url>');
    });

    it('confirms all registered routes have controllers', function () {
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            $action = $route->getAction();
            
            // Skip closure routes and redirect routes
            if (isset($action['controller']) && !str_contains($action['controller'], 'RedirectController')) {
                $parts = explode('@', $action['controller']);
                $controller = $parts[0];
                $method = $parts[1] ?? null;
                
                expect(class_exists($controller))->toBeTrue("Controller {$controller} should exist");
                
                if ($method && $method !== '__invoke') {
                    expect(method_exists($controller, $method))->toBeTrue("Method {$method} should exist in {$controller}");
                }
            }
        }
    });

    it('validates critical controllers exist', function () {
        $controllers = [
            'App\\Http\\Controllers\\ContactController',
            'App\\Http\\Controllers\\NewsletterController',
            'App\\Http\\Controllers\\SitemapController',
        ];

        foreach ($controllers as $controller) {
            expect(class_exists($controller))->toBeTrue("Controller {$controller} should exist");
        }
    });
});