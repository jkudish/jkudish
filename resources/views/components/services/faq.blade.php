@php
$faqs = [
    [
        'question' => 'How do I know which service is right for me?',
        'answer' => 'Book a free consultation and we\'ll discuss your specific challenges and goals. I\'ll recommend the best approach based on your needs, timeline, and budget. No obligation and no hard sell - just honest advice.'
    ],
    [
        'question' => 'What\'s your typical project timeline?',
        'answer' => 'Code cleanup projects typically take 2-8 weeks. MVP development is delivered in 30-day sprints. AI automation can be implemented in 1-4 weeks. We\'ll establish clear milestones and regular check-ins to keep everything on track.'
    ],
    [
        'question' => 'Do you offer ongoing support after project completion?',
        'answer' => 'Yes! I offer maintenance packages and retainer options for ongoing support. Many clients start with a project and then move to a monthly retainer for continuous improvements and support.'
    ],
    [
        'question' => 'What technologies do you work with?',
        'answer' => 'My core stack includes Laravel, PHP, JavaScript (Vue.js, React), MySQL/PostgreSQL, and various AI tools (GPT-4, Claude, n8n). I also have extensive experience with WordPress, WooCommerce, and can adapt to your existing tech stack.'
    ],
    [
        'question' => 'How do payments work?',
        'answer' => 'For most projects, I require 50% upfront and 50% on completion. Larger projects can be broken into milestone payments. I accept bank transfers, credit cards, and can work with your procurement process if needed.'
    ],
    [
        'question' => 'What if I\'m not satisfied with the work?',
        'answer' => 'I offer a satisfaction guarantee with revision rounds included in every project. We\'ll establish clear success criteria upfront, and I won\'t consider the project complete until you\'re happy with the results.'
    ],
    [
        'question' => 'Can you work with my existing team?',
        'answer' => 'Absolutely! I regularly collaborate with in-house teams, providing extra capacity, specialized expertise, or technical leadership. I\'m experienced in async communication and can adapt to your team\'s workflow.'
    ],
    [
        'question' => 'Do you sign NDAs?',
        'answer' => 'Yes, I\'m happy to sign NDAs and have worked on many confidential projects. Your business information, code, and ideas are always treated with complete confidentiality, NDA or not.'
    ],
];
@endphp

<div>
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <x-ui.typography variant="h2">
                Frequently Asked Questions
            </x-ui.typography>
            <x-ui.typography variant="lead" color="muted" class="mt-4">
                Get answers to common questions about working together
            </x-ui.typography>
        </div>
        
        <div class="space-y-4">
            @foreach($faqs as $index => $faq)
            <details class="group rounded-2xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <summary class="flex cursor-pointer items-center justify-between p-6 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                    <x-ui.typography variant="h4">
                        {{ $faq['question'] }}
                    </x-ui.typography>
                    <span class="ml-6 flex-shrink-0">
                        <svg class="h-5 w-5 text-zinc-400 group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <div class="px-6 pb-6">
                    <x-ui.typography variant="body" color="muted">
                        {{ $faq['answer'] }}
                    </x-ui.typography>
                </div>
            </details>
            @endforeach
        </div>
        
        <div class="mt-12 text-center p-8 rounded-2xl bg-gradient-to-br from-teal-50 to-blue-50 dark:from-teal-950/20 dark:to-blue-950/20">
            <x-ui.typography variant="h4">
                Still have questions?
            </x-ui.typography>
            <x-ui.typography variant="body" color="muted" class="mt-2">
                Let's have a conversation about your specific needs
            </x-ui.typography>
            <div class="mt-6">
                <x-ui.gradient-button variant="primary" href="{{ route('contact') }}" icon="true">
                    Schedule a Free Consultation
                </x-ui.gradient-button>
            </div>
        </div>
    </div>
</div>