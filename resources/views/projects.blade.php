<x-layout 
    title="Portfolio & Projects"
    description="Explore Joey Kudish's portfolio of software projects, including web applications, open-source contributions, and client work."
    keywords="software portfolio, web development projects, Laravel applications, case studies, Tether, PHAiTO, client work, open source"
>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">
                {{-- Header Section --}}
                <div class="relative px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32 bg-gradient-to-br from-white to-zinc-50/50 dark:from-zinc-900 dark:to-zinc-800">
                    <div class="absolute inset-0 bg-mesh-gradient opacity-30 dark:opacity-10"></div>
                    <div class="relative z-10">
                        <header class="max-w-3xl mx-auto text-center">
                            <x-ui.typography variant="h1">
                                Projects & Work
                            </x-ui.typography>
                            <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                                What I've built, broken, and shipped over 18 years.
                            </p>
                        </header>
                    </div>
                </div>

                {{-- Current Projects Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    @php
                    $projects = [
                        [
                            'name' => 'Tether',
                            'logo' => url('img/tether.png'),
                            'logo_size' => 'large',
                            'show_title' => false,
                            'description' => 'Stay connected without roaming fees. SMS verification codes delivered straight to your Telegram.',
                            'status' => 'building',
                            'status_label' => 'Building in public',
                            'status_icon' => 'lucide-hammer',
                            'url' => 'https://tethermobile.com',
                            'external' => true,
                        ],
                        [
                            'name' => 'The Maker Notes',
                            'icon' => 'lucide-mail',
                            'icon_size' => 'large',
                            'show_title' => true,
                            'description' => 'Weekly dispatch: AI experiments, automation workflows, indie hacking lessons, and the best links I find online.',
                            'status' => 'coming_soon',
                            'status_label' => 'First issue coming this month',
                            'status_icon' => 'lucide-rocket',
                            'url' => route('newsletter'),
                            'external' => false,
                        ],
                        [
                            'name' => 'PHAiTO',
                            'logo' => url('img/companies/phaito.png'),
                            'logo_size' => 'medium',
                            'logo_filter' => 'grayscale',
                            'show_title' => false,
                            'description' => 'Lightroom AI that actually understands photography. Edit entire catalogs in minutes, not hours.',
                            'status' => 'launched',
                            'status_label' => 'Recently Launched',
                            'status_icon' => 'lucide-check-circle',
                            'url' => 'https://phaito.com',
                            'external' => true,
                        ],
                    ];
                    @endphp

                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <x-ui.typography variant="h2">
                                What I'm Building Right Now
                            </x-ui.typography>
                            <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
                        </div>

                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($projects as $project)
                            <a
                                href="{{ $project['url'] }}"
                                @if($project['external'])
                                    target="_blank"
                                    rel="noopener noreferrer"
                                @endif
                                class="no-underline group relative flex flex-col rounded-2xl border border-zinc-200/50 p-6 hover:border-emerald-500/30 dark:border-zinc-700/40 dark:hover:border-emerald-600/30 transition-all duration-200 hover:-translate-y-1 hover:shadow-lg bg-white dark:bg-zinc-900/50 shadow-sm"
                            >
                                {{-- Logo/Icon Display --}}
                                <div class="h-20 flex items-center mb-4">
                                    @if(isset($project['logo']))
                                        @php
                                            $logoClasses = match($project['logo_size'] ?? 'medium') {
                                                'large' => 'h-14 w-auto',
                                                'medium' => 'h-11 w-auto',
                                                default => 'h-11 w-auto'
                                            };
                                            if (isset($project['logo_filter']) && $project['logo_filter'] === 'grayscale') {
                                                $logoClasses .= ' grayscale opacity-70 dark:brightness-0 dark:invert';
                                            }
                                        @endphp
                                        <img src="{{ $project['logo'] }}" alt="{{ $project['name'] }}" class="{{ $logoClasses }} object-contain">
                                    @elseif(isset($project['icon']))
                                        @php
                                            $iconSize = $project['icon_size'] ?? 'medium';
                                            $iconClasses = match($iconSize) {
                                                'large' => 'w-8 h-8',
                                                default => 'w-6 h-6'
                                            };
                                            $iconPadding = match($iconSize) {
                                                'large' => 'p-3',
                                                default => 'p-2.5'
                                            };
                                        @endphp
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-lg blur-lg opacity-[0.015]"></div>
                                                <div class="relative bg-white/10 dark:bg-zinc-800/50 backdrop-blur-sm {{ $iconPadding }} rounded-lg border border-white/20 dark:border-zinc-700/50">
                                                    <x-icon name="{{ $project['icon'] }}" class="{{ $iconClasses }} text-teal-600 dark:text-teal-400" />
                                                </div>
                                            </div>
                                            @if($project['show_title'])
                                                <x-ui.typography variant="h4">
                                                    {{ $project['name'] }}
                                                </x-ui.typography>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                {{-- Title (if not already shown) --}}
                                @if(!isset($project['icon']) && $project['show_title'])
                                    <x-ui.typography variant="h4" class="mb-2">
                                        {{ $project['name'] }}
                                    </x-ui.typography>
                                @endif

                                {{-- Description --}}
                                <p class="text-sm font-sans text-gray-600 dark:text-zinc-400 flex-grow">
                                    {{ $project['description'] }}
                                </p>

                                {{-- Status Badge --}}
                                <div class="mt-4">
                                    @php
                                        $statusClasses = match($project['status']) {
                                            'building' => 'bg-yellow-100 text-yellow-800 dark:bg-amber-900/30 dark:text-amber-300 border border-yellow-200/50 dark:border-amber-700/30',
                                            'coming_soon' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200/50 dark:border-blue-700/30',
                                            'launched' => 'bg-green-100 text-green-800 dark:bg-emerald-900/30 dark:text-emerald-300 border border-green-200/50 dark:border-emerald-700/30',
                                            default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800/30 dark:text-zinc-300 border border-zinc-200/50 dark:border-zinc-700/30'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                        <x-icon name="{{ $project['status_icon'] }}" class="w-3.5 h-3.5" />
                                        {{ $project['status_label'] }}
                                    </span>
                                </div>

                                {{-- External Link Indicator --}}
                                @if($project['external'])
                                    <x-icon name="lucide-external-link" class="absolute top-4 right-4 w-4 h-4 text-zinc-400 dark:text-zinc-500 opacity-0 group-hover:opacity-100 transition-opacity" />
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Success Stories Section --}}
                <div class="px-6 sm:px-8 lg:px-10 pt-16 lg:pt-20 xl:pt-24 pb-16 lg:pb-20 xl:pb-24 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div>
                        <div class="text-center mb-16">
                            <x-ui.typography variant="h2">
                                Selected Work
                            </x-ui.typography>
                            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-500">
                                Real products, real impact, still running in production.
                            </p>
                        </div>

                        {{-- Featured Success Stories --}}
                        <div class="grid gap-10 grid-cols-1 lg:grid-cols-2 mb-16">
                            @php
                            $featuredStories = [
                                [
                                    'company' => 'Image Salon',
                                    'tagline' => 'Post-Production Photography Studio',
                                    'logo' => asset('img/companies/image-salon.png'),
                                    'logo_webp' => asset('img/companies/image-salon.webp'),
                                    'story' => 'Scaling the platform to 6,000+ photographers since 2016. Development of bespoke software and AI automation.',
                                    'highlights' => [
                                        'PHAiTO - AI-powered app that edits entire Lightroom catalogs (2,000+ photos) in under 10 minutes',
                                        'Global scale - Platform handles thousands of orders monthly across 6,000 photographers in 60+ countries',
                                        'Complete tech stack - Laravel backend, Vue.js dashboards, custom CRM, automated billing, and workflow systems from scratch',
                                    ],
                                ],
                                [
                                    'company' => 'WordPress & WooCommerce',
                                    'tagline' => 'E-commerce at Scale',
                                    'logo' => asset('img/companies/wordpress.png'),
                                    'logo_webp' => asset('img/companies/wordpress.webp'),
                                    'story' => 'Over 18 years building for the web. WordPress Core contributor since 2011, with features and platforms used by millions across the ecosystem.',
                                    'highlights' => [
                                        'At Automattic - Worked on WooCommerce, Jetpack and WordPress.com',
                                        'At Metorik - Helped scale an analytics platform processing millions in GMV for WooCommerce/Shopify stores',
                                        'For clients - Delivered 30+ custom WordPress sites and WooCommerce stores',
                                    ],
                                ],
                            ];
                            @endphp

                            @foreach($featuredStories as $story)
                            <div class="group rounded-2xl border border-zinc-200/50 dark:border-zinc-700/40 p-8 bg-white dark:bg-zinc-900/50 shadow-sm hover:shadow-xl hover:border-zinc-300 dark:hover:border-zinc-600 transition-all duration-300">
                                <div class="flex items-start gap-6 mb-8">
                                    @if(isset($story['logo']))
                                    <div class="w-32 h-20 flex items-center justify-start flex-shrink-0">
                                        <picture>
                                            <source srcset="{{ $story['logo_webp'] }}" type="image/webp">
                                            <img src="{{ $story['logo'] }}"
                                                 alt="{{ $story['company'] }}"
                                                 class="max-h-20 max-w-32 w-auto h-auto grayscale brightness-[0.3] opacity-90 dark:brightness-0 dark:invert dark:opacity-70">
                                        </picture>
                                    </div>
                                    @else
                                    <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-500/10 to-teal-500/10 dark:from-emerald-500/20 dark:to-teal-500/20 border border-emerald-500/20">
                                        <x-icon name="{{ $story['icon'] }}" class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                    @endif
                                    <div class="pt-2">
                                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">
                                            {{ $story['company'] }}
                                        </h3>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                            {{ $story['tagline'] }}
                                        </p>
                                    </div>
                                </div>

                                <p class="text-zinc-600 dark:text-zinc-400 mb-6 leading-relaxed">
                                    {{ $story['story'] }}
                                </p>

                                <div class="space-y-3">
                                    @foreach($story['highlights'] as $highlight)
                                    <div class="flex gap-3">
                                        <x-icon name="lucide-check-circle" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5" />
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $highlight }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- How I Work Section --}}
                        <div class="relative mt-16 p-10 rounded-2xl bg-gradient-to-br from-zinc-50 to-white dark:from-zinc-800/50 dark:to-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/40">
                            <div class="grid gap-8 grid-cols-1 lg:grid-cols-3">
                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="p-2 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                            <x-icon name="lucide-lightbulb" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                        </div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                                            Product Vision
                                        </h3>
                                    </div>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                        I don't just code features. I understand business goals, user needs, and market dynamics. Every line of code serves the product strategy.
                                    </p>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="p-2 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                            <x-icon name="lucide-users" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                        </div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                                            Tech Leadership
                                        </h3>
                                    </div>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                        CTO at multiple companies. Built and led engineering teams. I know how to ship products, not just features.
                                    </p>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="p-2 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                            <x-icon name="lucide-rocket" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                        </div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                                            Founder Mindset
                                        </h3>
                                    </div>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                        Founded multiple businesses. I think like an owner because I've been one. Your success is my success.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Social Proof Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.social-proof />
                </div>

                {{-- CTA Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div class="text-center">
                        <x-ui.typography variant="h2">
                            Let's ship your next project
                        </x-ui.typography>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                            I've done this before. Let me do it for you.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                            <x-ui.gradient-button variant="primary" href="{{ route('contact') }}" icon="true">
                                Get in Touch
                            </x-ui.gradient-button>
                            <a href="{{ route('services') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-emerald-600 px-4 py-2 text-sm font-semibold text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all dark:border-emerald-700 dark:text-emerald-700 dark:hover:bg-emerald-700 dark:hover:text-white">
                                View Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
