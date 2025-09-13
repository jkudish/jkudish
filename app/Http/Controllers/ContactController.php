<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\ProcessContactFormSubmission;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        // Check honeypot field for spam
        if ($request->filled('website')) {
            // Silently reject spam submissions
            return redirect()->route('contact');
        }

        $validated = $request->validated();

        // Store email in session for pageview tracking
        session(['visitor_email' => $validated['email']]);

        // Dispatch job to process form submission asynchronously
        ProcessContactFormSubmission::dispatch($validated);

        // Track different events based on newsletter opt-in
        $eventName = $validated['newsletter_opt_in'] ?? false 
            ? 'contact_form_with_newsletter' 
            : 'contact_form';

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! I\'ll get back to you within 24-48 hours.')
            ->with('track_event', $eventName);
    }
}
