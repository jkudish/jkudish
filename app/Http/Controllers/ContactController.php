<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\ProcessContactFormSubmission;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function show()
    {
        $service = request()->query('service');

        // Validate service parameter
        $validServices = ['automation', 'audit', 'product', 'partnership'];
        if (! in_array($service, $validServices)) {
            $service = null;
        }

        // Get service configuration
        $serviceConfig = $this->getServiceConfig($service);

        return view('contact', compact('service', 'serviceConfig'));
    }

    private function getServiceConfig(?string $service): ?array
    {
        if (! $service) {
            return null;
        }

        $services = [
            'automation' => [
                'id' => 'automation',
                'icon' => 'lucide-zap',
                'name' => 'Automate Your Way to Profit',
                'tagline' => 'Turn repetitive tasks into revenue-generating systems',
                'color' => 'yellow',
                'icon_color' => '#eab308',
                'text_color' => 'text-yellow-600 dark:text-yellow-400',
                'border_gradient' => 'from-yellow-400 to-amber-500',
                'hero_message' => 'Ready to turn repetitive tasks into revenue-generating systems? Tell me about your automation needs below.',
                'form_placeholder' => 'Tell me about the processes you want to automate...',
                'form_helper' => 'Share details about repetitive tasks, data processing needs, or workflow bottlenecks',
            ],
            'audit' => [
                'id' => 'audit',
                'icon' => 'lucide-file-text',
                'name' => 'Code Audit & Strategy',
                'tagline' => 'Get an Experienced Engineer\'s Perspective',
                'color' => 'purple',
                'icon_color' => '#a855f7',
                'text_color' => 'text-purple-600 dark:text-purple-400',
                'border_gradient' => 'from-purple-400 to-pink-500',
                'hero_message' => 'Let\'s review your code and create a clear technical roadmap. Share your concerns below.',
                'form_placeholder' => 'Tell me about your codebase and what concerns you have...',
                'form_helper' => 'Describe your tech stack, performance issues, or code quality concerns',
            ],
            'product' => [
                'id' => 'product',
                'icon' => 'lucide-code-2',
                'name' => 'Build Your Product',
                'tagline' => 'Ship Something Real',
                'color' => 'emerald',
                'icon_color' => '#10b981',
                'text_color' => 'text-emerald-600 dark:text-emerald-400',
                'border_gradient' => 'from-emerald-400 to-teal-500',
                'hero_message' => 'Ready to ship something real? Let\'s discuss your vision and make it happen.',
                'form_placeholder' => 'Describe your product vision and technical requirements...',
                'form_helper' => 'Share your product idea, target users, and desired features',
            ],
            'partnership' => [
                'id' => 'partnership',
                'icon' => 'lucide-sparkles',
                'name' => 'Ongoing Partnership',
                'tagline' => 'Fractional CTO-Level Guidance',
                'color' => 'cyan',
                'icon_color' => '#06b6d4',
                'text_color' => 'text-cyan-600 dark:text-cyan-400',
                'border_gradient' => 'from-cyan-400 to-blue-500',
                'hero_message' => 'Let\'s discuss how ongoing technical leadership can help your business grow.',
                'form_placeholder' => 'Tell me about your business and technical challenges...',
                'form_helper' => 'Describe your team, current technical setup, and growth goals',
            ],
        ];

        return $services[$service] ?? null;
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
