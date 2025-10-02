<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Integrations\BentoService;
use App\Models\Broadcast;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function __construct(
        private BentoService $bentoService
    ) {}

    /**
     * Display the newsletter archive page
     */
    public function index(): View
    {
        $broadcasts = Broadcast::sent()
            ->latest('sent_at')
            ->get();

        return view('newsletter', compact('broadcasts'));
    }

    /**
     * Display an individual newsletter
     */
    public function show(Broadcast $broadcast)
    {
        // Redirect to archive if newsletter hasn't been sent yet
        if (! $broadcast->sent_at) {
            return redirect()->route('newsletter');
        }

        return view('newsletter.show', compact('broadcast'));
    }

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
                    'message' => 'Welcome to Human in the Loop! You\'ll receive the first issue right away.',
                    'track_event' => true, // Signal frontend to track event
                ]);
            }

            return redirect()->route('newsletter')
                ->with('success', 'Welcome to Human in the Loop! You\'ll receive the first issue right away.')
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
