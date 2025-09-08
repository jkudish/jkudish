<x-layout title="Services - Joey Kudish">
    <x-ui.section background="gradient-mesh" spacing="large">
        <header class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h1">
                How I Can Help Your Business
            </x-ui.typography>
            <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                Focused, results-driven services to transform your technology challenges into competitive advantages.
            </p>
        </header>
    </x-ui.section>

    <x-ui.section background="white" spacing="normal">
        <div class="space-y-20">
            @php
            $services = [
                [
                    'id' => 'code-audit-strategy',
                    'icon' => 'code',
                    'name' => 'Code Audit & Strategy',
                    'tagline' => 'Get an Experienced Engineer\'s Perspective',
                    'description' => 'Transform uncertainty into a clear technical roadmap. Your code needs a second opinion. Whether you built with AI tools, have a legacy Laravel app, or need to automate manual processes, I\'ll review everything and deliver actionable insights. Get confidence to move forward with a prioritized plan from someone who\'s shipped code to millions of users and built software that\'s been running in production for over a decade.',
                    'ideal_for' => [
                        'Founders who built with ChatGPT, v0, Lovable, Replit, Bolt, etc.',
                        'Teams with performance or security concerns',
                        'Businesses drowning in manual processes',
                        'Websites needing modernization',
                        'Development teams wanting AI workflow optimization',
                    ],
                    'deliverables' => [
                        'Comprehensive code/process audit report',
                        'Security and performance analysis',
                        'Prioritized roadmap with effort estimates',
                        'Cost-benefit analysis for improvements',
                        '30-minute strategy call to discuss findings',
                    ],
                    'process' => [
                        'Initial consultation and access setup',
                        'Deep dive analysis',
                        'Report preparation and recommendations',
                        'Strategy call and Q&A session',
                        'Optional follow-up implementation support',
                    ],
                    'pricing' => 'Starting at $2,500',
                    'duration' => '7-14 business days',
                    'cta' => 'Book Your Audit',
                ],
                [
                    'id' => 'build-product',
                    'icon' => 'rocket',
                    'name' => 'Build Your Product',
                    'tagline' => 'Ship Something Real',
                    'description' => 'From idea to revenue in weeks, not months. Stop overthinking, start shipping. I\'ll build your MVP, transform your AI prototype into production software, or create the technical foundation for your business. Using Laravel, JavaScript, and proven patterns, I build software that scales. No agencies, no junior devs, no excuses; just production ready code from an experienced engineer.',
                    'ideal_for' => [
                        'Businesses requiring custom software solutions',
                        'Founders ready to launch their first product',
                        'Vibe coders needing help getting their code production-ready',
                        'Companies testing new product ideas',
                    ],
                    'deliverables' => [
                        'Fully functional, production-ready application',
                        'Tech stack built for growth (Laravel/React/Vue)',
                        'Database design and API architecture',
                        'Deployment and infrastructure setup',
                        '30 days of post-launch support (convertible to monthly retainer)',
                    ],
                    'process' => [
                        'Requirements workshop and scoping',
                        'Technical architecture design',
                        '2-4 week development sprints',
                        'Regular progress updates and demos',
                        'Launch preparation and handover',
                    ],
                    'pricing' => 'Starting at $15,000',
                    'duration' => '4-12 weeks',
                    'cta' => 'Start Building',
                ],
                [
                    'id' => 'ongoing-partnership',
                    'icon' => 'sparkles',
                    'name' => 'Ongoing Partnership',
                    'tagline' => 'Fractional CTO-Level Guidance',
                    'description' => 'Technical leadership without the equity or salary. Get the CTO experience your business needs at a fraction of the cost. From weekly code reviews to strategic technical decisions, I\'ll be your on-demand engineer. Perfect for growing startups, businesses running on automation, or any company that needs consistent technical guidance. Scale up or down as your needs change.',
                    'ideal_for' => [
                        'Startups needing technical guidance',
                        'Businesses with AI/automation workflows',
                        'Companies without full-time technical leadership',
                        'Teams wanting to level up their development',
                    ],
                    'deliverables' => [
                        'Weekly strategy calls and code reviews',
                        'Architecture and technology decisions',
                        'Team mentoring and AI tool training',
                        'Automation monitoring and optimization',
                        'Priority support and emergency assistance',
                    ],
                    'process' => [
                        'Initial assessment and goal setting',
                        'Weekly/bi-weekly scheduled sessions',
                        'Async support via Slack/email',
                        'Monthly progress reviews',
                        'Quarterly strategy planning',
                    ],
                    'pricing' => '$3,000-$10,000/month',
                    'duration' => 'Month-to-month',
                    'cta' => 'Let\'s Partner',
                ],
            ];
            @endphp

            @foreach($services as $index => $service)
            <div id="{{ $service['id'] }}" class="scroll-mt-20">
                <div class="grid gap-12 lg:grid-cols-5">
                    <div class="lg:col-span-3">
                        <div class="flex items-start gap-4">
                            <x-ui.animated-icon
                                icon="{{ $service['icon'] }}"
                                size="w-10 h-10"
                                animation="none"
                                color="#06b6d4"
                            />
                            <div>
                                <x-ui.typography variant="h2">
                                    {{ $service['name'] }}
                                </x-ui.typography>
                                <p class="mt-2 text-lg text-teal-600 dark:text-teal-400 font-medium">
                                    {{ $service['tagline'] }}
                                </p>
                            </div>
                        </div>

                        <p class="mt-6 text-zinc-600 dark:text-zinc-400 leading-relaxed">
                            {{ $service['description'] }}
                        </p>

                        <div class="mt-8">
                            <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                Ideal For
                            </x-ui.typography>
                            <ul class="mt-4 space-y-2">
                                @foreach($service['ideal_for'] as $item)
                                <li class="flex gap-3 text-zinc-600 dark:text-zinc-400">
                                    <svg class="w-5 h-5 flex-shrink-0 text-teal-600 dark:text-teal-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $item }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <x-ui.gradient-border variant="primary" hover="false">
                            <div class="p-6 space-y-6">
                                <div>
                                    <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                        What You Get
                                    </x-ui.typography>
                                    <ul class="mt-3 space-y-2">
                                        @foreach($service['deliverables'] as $deliverable)
                                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                                            <span class="text-teal-600 dark:text-teal-400">→</span>
                                            {{ $deliverable }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div>
                                    <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                        Process
                                    </x-ui.typography>
                                    <ol class="mt-3 space-y-2">
                                        @foreach($service['process'] as $step => $process)
                                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                                            <span class="text-teal-600 dark:text-teal-400 font-semibold">{{ $step + 1 }}.</span>
                                            {{ $process }}
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>

                                <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400">Investment</div>
                                            <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $service['pricing'] }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400">Timeline</div>
                                            <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $service['duration'] }}</div>
                                        </div>
                                    </div>

                                    <x-ui.gradient-button
                                        variant="primary"
                                        href="{{ route('contact') }}"
                                        icon="true"
                                        class="w-full justify-center"
                                    >
                                        {{ $service['cta'] }}
                                    </x-ui.gradient-button>
                                </div>
                            </div>
                        </x-ui.gradient-border>
                    </div>
                </div>

                @if(!$loop->last)
                <div class="mt-20 border-b border-zinc-200 dark:border-zinc-800"></div>
                @endif
            </div>
            @endforeach
        </div>
    </x-ui.section>

    <x-ui.section background="gradient" spacing="normal">
        <div class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h2">
                Not Sure Which Service You Need?
            </x-ui.typography>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                Let's have a conversation about your challenges and goals. I'll help you identify the best path forward.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <x-ui.gradient-button variant="primary" href="{{ route('contact') }}" icon="true">
                    Schedule a Free Consultation
                </x-ui.gradient-button>
                <x-ui.gradient-button variant="outline" href="mailto:joey@jkudish.com">
                    Email Me Directly
                </x-ui.gradient-button>
            </div>

            <p class="mt-6 text-sm text-zinc-500 dark:text-zinc-400">
                Response within 24 hours • No obligation • NDA available
            </p>
        </div>
    </x-ui.section>

    <x-ui.section background="white" spacing="normal">
        <div class="grid gap-8 lg:grid-cols-3">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Fast Response</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    Initial consultation within 24-48 hours
                </p>
            </div>

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Guaranteed Quality</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    15+ years of proven expertise
                </p>
            </div>

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Results Focused</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    Measurable impact on your business
                </p>
            </div>
        </div>
    </x-ui.section>

    {{-- Payment Terms --}}
    <x-ui.section background="gray" spacing="normal">
        <div class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h2">
                Payment Terms & Process
            </x-ui.typography>
            <x-ui.typography variant="lead" color="muted" class="mt-4">
                Simple, transparent pricing with flexible payment options
            </x-ui.typography>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">💳</span>
                    </div>
                    <x-ui.typography variant="h4">Payment Methods</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        Bank transfer, credit card, or your company's preferred payment method
                    </x-ui.typography>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">📊</span>
                    </div>
                    <x-ui.typography variant="h4">Payment Schedule</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        50% upfront, 50% on completion. Larger projects can use milestone payments
                    </x-ui.typography>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">🤝</span>
                    </div>
                    <x-ui.typography variant="h4">Contracts</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        Simple service agreement with clear deliverables and timelines
                    </x-ui.typography>
                </div>
            </div>

            <div class="mt-12 p-6 rounded-2xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                <x-ui.typography variant="body" weight="semibold">
                    Money-Back Guarantee
                </x-ui.typography>
                <x-ui.typography variant="body" color="muted" class="mt-2">
                    If you're not satisfied with the work within the first week, I'll refund your deposit in full. No questions asked.
                </x-ui.typography>
            </div>
        </div>
    </x-ui.section>

    {{-- FAQ Section --}}
    <x-ui.section background="white" spacing="normal">
        <x-services.faq />
    </x-ui.section>
</x-layout>
