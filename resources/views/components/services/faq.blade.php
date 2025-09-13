@php
    $faqs = [
        [
            'question' => 'How do I know which service is right for me?',
            'answer' => 'Book a free 15-minute call. We\'ll figure out what you need and whether we\'re a good fit. If not, I\'ll point you in the right direction.'
        ],
        [
            'question' => 'What\'s your typical timeline?',
            'answer' => 'Audits: 7-14 days. MVP builds: 4-12 weeks. Automation setups: 1-4 weeks. Monthly partnerships start immediately if you\'re ready. I\'ll give you a realistic timeline upfront; no surprises.'
        ],
        [
            'question' => 'I built my app with ChatGPT/Cursor/v0/Bolt/Rocket/Lovable/Replit, etc. Can you make it production-ready?',
            'answer' => 'Yes, this is one of my specialties. I\'ll audit your AI-generated code, fix the security issues, add proper error handling, take care of performance, setup a deployment workflow, and get it ready for real users. Most vibe-coded apps need 2-6 weeks to become production-ready.'
        ],
        [
            'question' => 'Do you offer ongoing support?',
            'answer' => 'All projects include 30 days of support. After that, you can convert to a monthly partnership or pay as needed. Most clients stay on retainer as it\'s cheaper than hiring internally.'
        ],
        [
            'question' => 'What tech stack do you use?',
            'answer' => 'Laravel, PHP, Livewire, JavaScript (Alpine/Vue/React), MySQL/PostgreSQL is my preferred and most productive stack but I\'m flexible based on my clients\' needs. For automation I tend to reach for n8n and OpenRouter. I\'ve also contributed to WordPress core and WooCommerce and am very comfortable working in that ecosystem. I\'ll work with your existing stack too.'
        ],
        [
            'question' => 'How does payment work?',
            'answer' => '50% upfront, 50% on completion for projects. Monthly partnerships bill at the start of each month. I accept wire transfers, ACH, and credit cards. No surprises, no hidden fees.'
        ],
        [
            'question' => 'Can you work with my existing team?',
            'answer' => 'Yes. I work with in-house teams all the time. I can lead, collaborate, or just fill gaps. Async communication is my default mode and is perfect for distributed teams.'
        ],
        [
            'question' => 'Do you sign NDAs?',
            'answer' => 'Yes. Your code and business details are confidential regardless, but happy to sign your NDA for peace of mind.'
        ],
        [
            'question' => 'What if I\'m not satisfied?',
            'answer' => 'I want you to be thrilled with the results. If you\'re unhappy with the work delivered, please communicate and I\'ll work with you to make it right.'
        ],
        [
            'question' => 'Who shouldn\'t hire me?',
            'answer' => 'Companies that need 40 hours of butts-in-seats time. Teams that love meetings. Projects with unclear goals. If you want someone to blindly follow specs without thinking, I\'m not your guy.'
        ]
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
                        <x-icon name="lucide-chevron-down" class="h-5 w-5 text-zinc-400 group-open:rotate-180 transition-transform" />
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

        <div class="mt-12 relative">
            {{-- Glass container --}}
            <div class="relative text-center p-8">
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
</div>
