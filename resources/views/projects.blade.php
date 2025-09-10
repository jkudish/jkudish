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
                                From indie experiments to enterprise solutions — building software that ships and scales.
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

                {{-- Past Work Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <x-ui.typography variant="h2">
                                Past Work & Experience
                            </x-ui.typography>
                            <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
                        </div>
                        
                        <div class="grid gap-6 lg:grid-cols-3">
                            @php
                            $pastWork = [
                                [
                                    'category' => 'At Automattic',
                                    'company' => 'WordPress.com',
                                    'icon' => 'lucide-globe',
                                    'items' => [
                                        'WordPress.com features serving millions of users',
                                        'WooCommerce Connect shipping integrations',
                                        'Analytics dashboard for thousands of e-commerce stores',
                                        'Core contributions to WordPress open-source project',
                                    ],
                                ],
                                [
                                    'category' => 'At Image Salon',
                                    'company' => 'Photo Automation',
                                    'icon' => 'lucide-camera',
                                    'items' => [
                                        'Reduced photo processing time by 75% through automation',
                                        'Built multilingual dashboard serving 6,000+ photographers globally',
                                        'Implemented AI-powered photo editing workflows',
                                        'Created complete business automation system',
                                    ],
                                ],
                                [
                                    'category' => 'Indie Products',
                                    'company' => 'Self-Published',
                                    'icon' => 'lucide-package',
                                    'items' => [
                                        'Multiple profitable SaaS products',
                                        'WordPress plugins with thousands of active installations',
                                        'Custom automation solutions for various businesses',
                                        'Open-source contributions and tools',
                                    ],
                                ],
                            ];
                            @endphp
                            
                            @foreach($pastWork as $work)
                            <div class="rounded-2xl border border-zinc-200/50 dark:border-zinc-700/40 p-6 bg-zinc-50/50 dark:bg-zinc-800/30">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="p-2 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                        <x-icon name="{{ $work['icon'] }}" class="w-5 h-5 text-teal-600 dark:text-teal-400" />
                                    </div>
                                    <div>
                                        <x-ui.typography variant="h4">
                                            {{ $work['category'] }}
                                        </x-ui.typography>
                                        <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                            {{ $work['company'] }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="space-y-3">
                                    @foreach($work['items'] as $item)
                                    <li class="flex gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                                        <span class="text-emerald-600 dark:text-emerald-400 mt-1">•</span>
                                        <span>{{ $item }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Social Proof Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.social-proof />
                </div>

                {{-- CTA Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
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