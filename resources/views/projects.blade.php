<x-layout title="Projects - Joey Kudish">
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
                        
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
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
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div>
                        <div class="text-center mb-16">
                            <x-ui.typography variant="h2">
                                What I've Shipped That Actually Works
                            </x-ui.typography>
                            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-500">
                                Not case studies. Real products, real impact, still running in production.
                            </p>
                        </div>
                        
                        {{-- Featured Success Stories --}}
                        <div class="grid gap-10 lg:grid-cols-2 mb-16">
                            @php
                            $featuredStories = [
                                [
                                    'company' => 'Image Salon',
                                    'tagline' => 'Photography Automation Platform',
                                    'logo' => asset('img/companies/image-salon.png'),
                                    'logo_webp' => asset('img/companies/image-salon.webp'),
                                    'impact' => '75% Faster',
                                    'story' => 'Built their entire tech stack from scratch. 6,000+ photographers worldwide, 75% faster order processing. My code from 2016 still processing hundreds of orders daily.',
                                    'highlights' => [
                                        'PHAiTO - AI that edits entire photo catalogs in minutes',
                                        'Multi-language dashboard serving photographers in 12 countries',
                                        'Automation that eliminated 30+ hours of manual work weekly',
                                    ],
                                    'tech' => ['Laravel', 'AI/ML', 'Vue.js', 'Automation'],
                                ],
                                [
                                    'company' => 'WordPress & WooCommerce',
                                    'tagline' => 'E-commerce at Scale',
                                    'logo' => asset('img/companies/wordpress.png'),
                                    'logo_webp' => asset('img/companies/wordpress.webp'),
                                    'impact' => 'Millions Served',
                                    'story' => 'Built stores, payment gateways, shipping integrations. Contributed to WordPress core. Worked on Metorik serving thousands of merchants daily.',
                                    'highlights' => [
                                        'WooCommerce Connect - shipping for thousands of stores',
                                        'Jetpack features used by millions of WordPress sites',
                                        'Analytics platform processing millions in GMV monthly',
                                    ],
                                    'tech' => ['WordPress', 'React', 'PHP', 'REST APIs'],
                                ],
                            ];
                            @endphp
                            
                            @foreach($featuredStories as $story)
                            <div class="group rounded-2xl border border-zinc-200/50 dark:border-zinc-700/40 p-8 bg-white dark:bg-zinc-900/50 shadow-sm hover:shadow-xl hover:border-zinc-300 dark:hover:border-zinc-600 transition-all duration-300">
                                <div class="flex items-start justify-between mb-8">
                                    <div class="flex items-start gap-6">
                                        @if(isset($story['logo']))
                                        <div class="w-32 h-20 flex items-center justify-start flex-shrink-0">
                                            <picture>
                                                <source srcset="{{ $story['logo_webp'] }}" type="image/webp">
                                                <img src="{{ $story['logo'] }}" 
                                                     alt="{{ $story['company'] }}" 
                                                     class="max-h-20 max-w-32 w-auto h-auto grayscale opacity-80 dark:brightness-0 dark:invert">
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
                                    <div class="text-right flex-shrink-0">
                                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-700">
                                            {{ $story['impact'] }}
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-zinc-600 dark:text-zinc-400 mb-6 leading-relaxed">
                                    {{ $story['story'] }}
                                </p>
                                
                                <div class="space-y-3 mb-6">
                                    @foreach($story['highlights'] as $highlight)
                                    <div class="flex gap-3">
                                        <x-icon name="lucide-check" class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" />
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $highlight }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="flex flex-wrap gap-2">
                                    @foreach($story['tech'] as $tech)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700">
                                        {{ $tech }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Client Types Section --}}
                        <div class="relative mt-16">
                            <div class="text-center mb-10">
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                                    Industries I've Worked In
                                </h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-500">
                                    Your industry probably isn't special. I've seen most of them.
                                </p>
                            </div>
                            
                            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                                @php
                                $clientTypes = [
                                    [
                                        'type' => 'SaaS Companies',
                                        'icon' => 'lucide-cloud',
                                        'description' => 'Analytics platforms, automation tools, and subscription services',
                                    ],
                                    [
                                        'type' => 'E-commerce',
                                        'icon' => 'lucide-shopping-cart',
                                        'description' => 'WooCommerce stores, payment integrations, inventory systems',
                                    ],
                                    [
                                        'type' => 'Creative Agencies',
                                        'icon' => 'lucide-palette',
                                        'description' => 'Photography, design studios, and content creators',
                                    ],
                                    [
                                        'type' => 'Enterprise',
                                        'icon' => 'lucide-building',
                                        'description' => 'WordPress migrations, performance optimization, scaling',
                                    ],
                                ];
                                @endphp
                                
                                @foreach($clientTypes as $client)
                                <div class="group p-6 rounded-xl border border-zinc-200/50 dark:border-zinc-700/40 bg-zinc-50/50 dark:bg-zinc-800/30 hover:shadow-md transition-all duration-200">
                                    <div class="mb-4">
                                        <div class="w-12 h-12 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 flex items-center justify-center">
                                            <x-icon name="{{ $client['icon'] }}" class="w-6 h-6 text-zinc-600 dark:text-zinc-400" />
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-zinc-900 dark:text-white mb-2">
                                        {{ $client['type'] }}
                                    </h4>
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400">
                                        {{ $client['description'] }}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Tech Stack Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div>
                        <div class="text-center mb-16">
                            <x-ui.typography variant="h2">
                                Tech Stack
                            </x-ui.typography>
                            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-500">
                                What I work with daily. And what I can figure out quickly.
                            </p>
                        </div>

                        <div class="grid gap-8 md:grid-cols-3">
                            @php
                            $techStacks = [
                                [
                                    'category' => 'Backend Excellence',
                                    'icon' => 'lucide-server',
                                    'description' => 'Scalable, secure, and maintainable server-side solutions',
                                    'technologies' => [
                                        'Laravel' => 'primary',
                                        'PHP 8+' => 'primary', 
                                        'WordPress' => 'primary',
                                        'MySQL' => 'secondary',
                                        'PostgreSQL' => 'secondary',
                                        'REST APIs' => 'secondary',
                                        'Python' => 'tertiary',
                                        'Ruby on Rails' => 'tertiary',
                                    ],
                                ],
                                [
                                    'category' => 'Frontend Craftsmanship',
                                    'icon' => 'lucide-layout',
                                    'description' => 'Pixel-perfect interfaces that users love',
                                    'technologies' => [
                                        'Vue.js' => 'primary',
                                        'React' => 'primary',
                                        'Alpine.js' => 'secondary',
                                        'TailwindCSS' => 'primary',
                                        'TypeScript' => 'secondary',
                                        'Livewire' => 'secondary',
                                        'Electron' => 'tertiary',
                                        'React Native' => 'tertiary',
                                    ],
                                ],
                                [
                                    'category' => 'AI & Automation',
                                    'icon' => 'lucide-cpu',
                                    'description' => 'Smart solutions that work while you sleep',
                                    'technologies' => [
                                        'AI Integrations' => 'primary',
                                        'n8n Workflows' => 'primary',
                                        'API Automation' => 'primary',
                                        'Claude/GPT APIs' => 'secondary',
                                        'Zapier' => 'secondary',
                                        'AWS Services' => 'secondary',
                                        'CI/CD Pipelines' => 'tertiary',
                                        'Docker' => 'tertiary',
                                    ],
                                ],
                            ];
                            @endphp

                            @foreach($techStacks as $stack)
                            <div class="rounded-2xl border border-zinc-200/50 dark:border-zinc-700/40 p-6 bg-white dark:bg-zinc-900/50 shadow-sm">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="p-2.5 rounded-lg bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                        <x-icon name="{{ $stack['icon'] }}" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                                            {{ $stack['category'] }}
                                        </h3>
                                        <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                            {{ $stack['description'] }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-2">
                                    @foreach($stack['technologies'] as $tech => $level)
                                        @php
                                        $classes = match($level) {
                                            'primary' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border-zinc-900 dark:border-white',
                                            'secondary' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border-zinc-200 dark:border-zinc-700',
                                            'tertiary' => 'bg-white text-zinc-500 dark:bg-zinc-900 dark:text-zinc-500 border-zinc-200 dark:border-zinc-700/50',
                                            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300'
                                        };
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $classes }}">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-8 p-6 rounded-xl bg-gradient-to-r from-zinc-50 to-zinc-100/50 dark:from-zinc-800 dark:to-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-white">
                                        Don't see your tech stack?
                                    </p>
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                        I'm a fast learner and love new challenges. Let's discuss your needs.
                                    </p>
                                </div>
                                <x-ui.gradient-button variant="secondary" href="{{ route('contact') }}" icon="true" class="whitespace-nowrap">
                                    Let's Talk Tech
                                </x-ui.gradient-button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Proof Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.social-proof />
                </div>

                {{-- CTA Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-20 xl:py-24 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div class="text-center">
                        <x-ui.typography variant="h2">
                            Ready to Build Something Great?
                        </x-ui.typography>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                            Let's discuss how I can help accelerate your project
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                            <x-ui.gradient-button variant="primary" href="{{ route('services') }}" icon="true">
                                Explore Services
                            </x-ui.gradient-button>
                            <x-ui.gradient-button variant="secondary" href="{{ route('contact') }}" icon="true">
                                Get in Touch
                            </x-ui.gradient-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>