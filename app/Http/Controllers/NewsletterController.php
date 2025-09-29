<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Integrations\BentoService;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function __construct(
        private BentoService $bentoService
    ) {}

    /**
     * Store a new newsletter subscription
     */
    public function store(NewsletterRequest $request)
    {
        $email = $request->validated('email');

        $success = $this->bentoService->createOrUpdateSubscriber(
            email: $email,
            firstName: null,
            lastName: null,
            tags: ['Maker Notes'],
            fields: [
                'source' => 'newsletter_form',
                'subscribed_at' => now()->toDateTimeString(),
            ]
        );

        if ($success) {
            // Store email in session for pageview tracking
            session(['visitor_email' => $email]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Welcome to Human in the Loop! You\'ll receive my next newsletter soon.',
                    'track_event' => true, // Signal frontend to track event
                ]);
            }

            return redirect()->route('newsletter')
                ->with('success', 'Welcome to Human in the Loop! You\'ll receive my next newsletter soon.')
                ->with('track_event', 'newsletter_signup');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again or email joey@jkudish.com directly.',
            ], 500);
        }

        return redirect()->route('newsletter')
            ->with('error', 'Something went wrong. Please try again or email joey@jkudish.com directly.');
    }
}
