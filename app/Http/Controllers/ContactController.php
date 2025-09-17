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
        $subject = request()->query('subject');

        // Handle subject parameter (e.g., from speaking page)
        if ($subject === 'speaking') {
            // Create a speaking service config
            $serviceConfig = [
                'id' => 'speaking',
                'icon' => 'lucide-mic',
                'name' => 'Speaking Engagement',
                'tagline' => 'Book me for your event',
                'color' => 'orange',
                'icon_color' => '#f97316',
                'text_color' => 'text-orange-600 dark:text-orange-400',
                'border_gradient' => 'from-orange-400 to-red-500',
                'hero_title' => 'Speaking Engagement',
                'hero_message' => 'I\'d love to share insights at your event or conference.',
                'form_placeholder' => 'Tell me about your event, audience, and what topics you\'d like covered...',
                'form_helper' => 'Include event details, dates, location, and audience demographics',
                'default_subject' => 'Speaking Opportunity',
            ];
        } else {
            // Validate service parameter
            $validServices = ['automation', 'audit', 'product', 'partnership'];
            if (! in_array($service, $validServices)) {
                $service = null;
            }

            // Get service configuration
            $serviceConfig = $this->getServiceConfig($service);
        }
        
        // Get all subject configurations for dynamic updates
        $subjectConfigs = $this->getAllSubjectConfigs();

        return view('contact', compact('service', 'serviceConfig', 'subjectConfigs'));
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
                'default_subject' => 'Automation Inquiry',
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
                'default_subject' => 'Code Audit Request',
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
                'default_subject' => 'Project Inquiry',
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
                'default_subject' => 'Partnership Opportunity',
            ],
        ];

        return $services[$service] ?? null;
    }
    
    private function getAllSubjectConfigs(): array
    {
        return [
            'Project Inquiry' => [
                'hero_title' => 'Build Your Product',
                'hero_message' => 'Ready to ship something real? Let\'s discuss your vision and make it happen.',
                'form_placeholder' => 'Describe your product vision and technical requirements...',
                'form_helper' => 'Share your product idea, target users, and desired features',
                'icon' => 'lucide-code-2',
                'icon_color' => '#10b981',
                'text_color' => 'text-emerald-600 dark:text-emerald-400',
                'border_gradient' => 'from-emerald-400 to-teal-500',
            ],
            'Automation Inquiry' => [
                'hero_title' => 'Automate Your Way to Profit',
                'hero_message' => 'Ready to turn repetitive tasks into revenue-generating systems? Tell me about your automation needs below.',
                'form_placeholder' => 'Tell me about the processes you want to automate...',
                'form_helper' => 'Share details about repetitive tasks, data processing needs, or workflow bottlenecks',
                'icon' => 'lucide-zap',
                'icon_color' => '#eab308',
                'text_color' => 'text-yellow-600 dark:text-yellow-400',
                'border_gradient' => 'from-yellow-400 to-amber-500',
            ],
            'Code Audit Request' => [
                'hero_title' => 'Code Audit & Strategy',
                'hero_message' => 'Let\'s review your code and create a clear technical roadmap. Share your concerns below.',
                'form_placeholder' => 'Tell me about your codebase and what concerns you have...',
                'form_helper' => 'Describe your tech stack, performance issues, or code quality concerns',
                'icon' => 'lucide-file-text',
                'icon_color' => '#a855f7',
                'text_color' => 'text-purple-600 dark:text-purple-400',
                'border_gradient' => 'from-purple-400 to-pink-500',
            ],
            'Partnership Opportunity' => [
                'hero_title' => 'Ongoing Partnership',
                'hero_message' => 'Let\'s discuss how ongoing technical leadership can help your business grow.',
                'form_placeholder' => 'Tell me about your business and technical challenges...',
                'form_helper' => 'Describe your team, current technical setup, and growth goals',
                'icon' => 'lucide-sparkles',
                'icon_color' => '#06b6d4',
                'text_color' => 'text-cyan-600 dark:text-cyan-400',
                'border_gradient' => 'from-cyan-400 to-blue-500',
            ],
            'Consultation Request' => [
                'hero_title' => 'Technical Consultation',
                'hero_message' => 'Get expert technical guidance for your specific challenges.',
                'form_placeholder' => 'Describe your technical challenges and what you need help with...',
                'form_helper' => 'Share details about your current situation and desired outcomes',
                'icon' => 'lucide-message-circle',
                'icon_color' => '#8b5cf6',
                'text_color' => 'text-violet-600 dark:text-violet-400',
                'border_gradient' => 'from-violet-400 to-purple-500',
            ],
            'Speaking Opportunity' => [
                'hero_title' => 'Speaking Engagement',
                'hero_message' => 'I\'d love to share insights at your event or conference.',
                'form_placeholder' => 'Tell me about your event, audience, and what topics you\'d like covered...',
                'form_helper' => 'Include event details, dates, location, and audience demographics',
                'icon' => 'lucide-mic',
                'icon_color' => '#f97316',
                'text_color' => 'text-orange-600 dark:text-orange-400',
                'border_gradient' => 'from-orange-400 to-red-500',
            ],
            'General Question' => [
                'hero_title' => 'Get in Touch',
                'hero_message' => 'Have a question? I\'m here to help.',
                'form_placeholder' => 'What would you like to know?',
                'form_helper' => 'Ask me anything about development, technology, or my services',
                'icon' => 'lucide-help-circle',
                'icon_color' => '#64748b',
                'text_color' => 'text-slate-600 dark:text-slate-400',
                'border_gradient' => 'from-slate-400 to-gray-500',
            ],
            'Just Saying Hi' => [
                'hero_title' => 'Hello There!',
                'hero_message' => 'Always happy to connect with fellow developers and tech enthusiasts.',
                'form_placeholder' => 'Drop me a note...',
                'form_helper' => 'Feel free to share what you\'re working on or just say hello',
                'icon' => 'lucide-smile',
                'icon_color' => '#ec4899',
                'text_color' => 'text-pink-600 dark:text-pink-400',
                'border_gradient' => 'from-pink-400 to-rose-500',
            ],
        ];
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
