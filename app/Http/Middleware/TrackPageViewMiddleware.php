<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Track pageview after response for GET requests only (not AJAX)
        if ($request->isMethod('GET') && ! $request->ajax()) {
            $email = session('visitor_email');
            if ($email) {
                // Use dispatch()->afterResponse() to avoid blocking the response
                dispatch(function () use ($request, $email) {
                    app(\App\Integrations\BentoService::class)->trackPageView(
                        $request->fullUrl(),
                        $email
                    );
                })->afterResponse();
            }
        }

        return $response;
    }
}
