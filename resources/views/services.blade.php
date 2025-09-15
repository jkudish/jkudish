@php
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => 'Software Development & AI Automation Services',
    'provider' => [
        '@type' => 'Person',
        'name' => 'Joey Kudish'
    ],
    'serviceType' => [
        'Software Development',
        'AI Automation',
        'Laravel Development',
        'Code Audit',
        'Technical Consulting'
    ],
    'description' => 'Professional software development and AI automation services. Specializing in Laravel applications, custom integrations, and workflow automation.',
    'areaServed' => 'Worldwide',
    'availableChannel' => [
        '@type' => 'ServiceChannel',
        'serviceUrl' => url('/services'),
        'servicePhone' => '',
        'serviceEmail' => 'joey@jkudish.com'
    ]
];
@endphp

<x-layout 
    title="Software Development & AI Automation Services"
    description="Professional software development and AI automation services. Specializing in Laravel applications, custom integrations, and workflow automation."
    keywords="software development services, AI automation, Laravel development, custom web applications, consulting, workflow automation, code audit, MVP development"
    :structuredData="$structuredData"
>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">

                {{-- Hero Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32">
                    <x-services.hero />
                </div>

                {{-- Services Section --}}
                <div id="services" class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <div class="space-y-20">
                        @php
                        $services = [
                            [
                                'id' => 'automation',
                                'icon' => 'lucide-zap',
                                'name' => 'Automate Your Way to Profit',
                                'tagline' => 'Turn repetitive tasks into revenue-generating systems',
                                'color' => 'yellow',
                                'icon_color' => '#eab308',
                                'text_color' => 'text-yellow-600 dark:text-yellow-400',
                                'border_gradient' => 'from-yellow-400 to-amber-500',
                                'button_variant' => 'primary',
                                'description' => 'Every hour you spend on manual tasks costs you money. I\'ll build automated workflows that cut costs, generate leads, and create new revenue streams. From customer service to lead nurturing to data processing, I\'ll automate the work that\'s eating your profits. Most clients see ROI within 30 days.',
                                'ideal_for' => [
                                    'Businesses losing money to manual data entry',
                                    'Companies wanting AI-powered lead generation',
                                    'Ecommerce stores drowning in order management',
                                    'Service businesses ready to scale without hiring',
                                ],
                                'deliverables' => [
                                    'Custom workflows tailored to your business',
                                    'AI-powered customer service automation',
                                    'Automated lead capture and nurturing systems',
                                    'Integration with your existing tools (Shopify, WooCommerce, CRMs)',
                                    'Training and documentation for your team',
                                ],
                                'process' => [
                                    'Process audit to identify automation opportunities',
                                    'ROI calculation for each proposed workflow',
                                    'Build and test automation in 3-5 days',
                                    'Deploy and monitor for optimization',
                                    'Handoff with training and documentation',
                                ],
                                'pricing' => 'Starting at $500',
                                'duration' => '3-7 days',
                                'cta' => 'Automate My Business',
                            ],
                            [
                                'id' => 'audit',
                                'icon' => 'lucide-file-text',
                                'name' => 'Code Audit & Strategy',
                                'tagline' => 'Get an Experienced Engineer\'s Perspective',
                                'color' => 'purple',
                                'icon_color' => '#a855f7',
                                'text_color' => 'text-purple-600 dark:text-purple-400',
                                'border_gradient' => 'from-purple-400 to-pink-500',
                                'button_variant' => 'accent',
                                'description' => 'Transform uncertainty into a clear technical roadmap. Your code needs a second opinion. Whether you built with AI tools, have a legacy Laravel app, or need to automate manual processes, I\'ll review everything and deliver actionable insights. Get confidence to move forward with a prioritized plan from someone who\'s shipped code to millions of users and built software that\'s been running in production for over a decade.',
                                'ideal_for' => [
                                    'Founders who built with ChatGPT, v0, Lovable, Replit, Bolt, etc.',
                                    'Teams with performance or security concerns',
                                    'WooCommerce or Shopify stores with performance issues',
                                    'Businesses drowning in manual processes',
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
                                'duration' => '2-3 weeks',
                                'cta' => 'Start Your Audit',
                            ],
                            [
                                'id' => 'product',
                                'icon' => 'lucide-code-2',
                                'name' => 'Build Your Product',
                                'tagline' => 'Ship Something Real',
                                'color' => 'emerald',
                                'icon_color' => '#10b981',
                                'text_color' => 'text-emerald-600 dark:text-emerald-400',
                                'border_gradient' => 'from-emerald-400 to-teal-500',
                                'button_variant' => 'primary',
                                'description' => 'From idea to revenue in weeks, not months. Stop overthinking, start shipping. I\'ll build your MVP, transform your AI prototype into production software, or create the technical foundation for your business. Using Laravel, modern JavaScript, and ecommerce platforms like WooCommerce and Shopify, I build software that scales. No agencies, no junior devs, no excuses; just production ready code from an experienced engineer.',
                                'ideal_for' => [
                                    'Businesses requiring custom software solutions',
                                    'Ecommerce businesses needing custom integrations',
                                    'Founders ready to launch their first product',
                                    'Vibe coders needing help getting their code production-ready',
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
                                'cta' => 'Start Your Build',
                            ],
                            [
                                'id' => 'partnership',
                                'icon' => 'lucide-sparkles',
                                'name' => 'Ongoing Partnership',
                                'tagline' => 'Fractional CTO-Level Guidance',
                                'color' => 'cyan',
                                'icon_color' => '#06b6d4',
                                'text_color' => 'text-cyan-600 dark:text-cyan-400',
                                'border_gradient' => 'from-cyan-400 to-blue-500',
                                'button_variant' => 'primary',
                                'description' => 'Technical leadership without the equity or salary. Get the CTO experience your business needs at a fraction of the cost. From weekly code reviews to strategic technical decisions, I\'ll be your on-demand engineer. Perfect for growing startups, ecommerce stores, businesses running on automation, or any company that needs consistent technical guidance. Scale up or down as your needs change.',
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
                                        <x-icon name="{{ $service['icon'] }}" class="w-10 h-10" style="color: {{ $service['icon_color'] }}" />
                                        <div>
                                            <x-ui.typography variant="h2">
                                                {{ $service['name'] }}
                                            </x-ui.typography>
                                            <p class="mt-2 text-lg {{ $service['text_color'] }} font-medium">
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
                                                <x-icon name="lucide-check-circle" class="w-5 h-5 flex-shrink-0 {{ $service['text_color'] }} mt-0.5" />
                                                {{ $item }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="lg:col-span-2">
                                    <div class="p-[2px] rounded-xl bg-gradient-to-r {{ $service['border_gradient'] }}">
                                        <div class="h-full w-full bg-white dark:bg-zinc-900 rounded-xl">
                                        <div class="p-6 space-y-6">
                                            <div>
                                                <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                                    What You Get
                                                </x-ui.typography>
                                                <ul class="mt-3 space-y-2">
                                                    @foreach($service['deliverables'] as $deliverable)
                                                    <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                                                        <span class="{{ $service['text_color'] }}">→</span>
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
                                                        <span class="{{ $service['text_color'] }} font-semibold">{{ $step + 1 }}.</span>
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

                                                <a href="{{ route('contact') }}?service={{ $service['id'] }}" class="group relative inline-flex items-center gap-2 justify-center rounded-xl px-6 py-3 text-sm font-semibold transition-all duration-300 overflow-hidden w-full bg-gradient-to-r {{ $service['border_gradient'] }} text-white hover:shadow-xl hover:-translate-y-0.5">
                                                    <span class="relative z-10 flex items-center gap-2">
                                                        {{ $service['cta'] }}
                                                        <x-icon name="lucide-chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(!$loop->last)
                            <div class="mt-20 border-b border-zinc-200 dark:border-zinc-800"></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Custom Solutions Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <div class="max-w-3xl mx-auto text-center">
                        <x-ui.typography variant="h2">
                            Not Sure Which Service You Need?
                        </x-ui.typography>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                            Every business is unique, and sometimes you need something that doesn't fit neatly into a package.
                            Whether you need a hybrid approach, have specific requirements, or just want to explore possibilities,
                            let's create a custom solution that works for you.
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
                            Response within 24-48 hours • No obligation • NDA available
                        </p>
                    </div>
                </div>

                {{-- Process Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-services.process />
                </div>

                {{-- FAQ Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-services.faq />
                </div>

            </div>
        </div>
    </div>
</x-layout>
