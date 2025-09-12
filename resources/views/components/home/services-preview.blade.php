@php
$services = [
    [
        'icon' => 'lightning-bolt',
        'name' => 'Automate Your Way to Profit',
        'description' => 'Turn repetitive tasks into revenue-generating systems. Most clients see ROI within 30 days.',
        'pricing' => 'Starting at $500',
        'features' => ['Custom workflow automation', 'AI-powered systems', 'Integration with existing tools'],
        'color' => 'yellow',
        'icon_color' => '#eab308',
        'text_color' => 'text-yellow-600 dark:text-yellow-400',
        'border_gradient' => 'from-yellow-400 to-amber-500',
    ],
    [
        'icon' => 'document-report',
        'name' => 'Code Audit & Strategy',
        'description' => 'Get an experienced perspective on your code and process. Get a clear roadmap with actionable insights.',
        'pricing' => 'Starting at $2,500',
        'features' => ['Comprehensive audit report', 'Security & performance analysis', 'Prioritized roadmap'],
        'color' => 'purple',
        'icon_color' => '#a855f7',
        'text_color' => 'text-purple-600 dark:text-purple-400',
        'border_gradient' => 'from-purple-400 to-pink-500',
    ],
    [
        'icon' => 'code',
        'name' => 'Build Your Product',
        'description' => 'Ship something real. From idea to revenue in weeks, not months. Clean, production-ready code.',
        'pricing' => 'Starting at $15,000',
        'features' => ['Production-ready application', 'Scalable tech stack', '30 days post-launch support'],
        'color' => 'emerald',
        'icon_color' => '#10b981',
        'text_color' => 'text-emerald-600 dark:text-emerald-400',
        'border_gradient' => 'from-emerald-400 to-teal-500',
    ],
    [
        'icon' => 'sparkles',
        'name' => 'Ongoing Partnership',
        'description' => 'Get CTO-level guidance and on-demand engineering expertise to help your business grow sustainably.',
        'pricing' => '$3,000 - $10,000/month',
        'features' => ['Weekly strategy calls', 'Code reviews & mentoring', 'Priority support'],
        'color' => 'cyan',
        'icon_color' => '#06b6d4',
        'text_color' => 'text-cyan-600 dark:text-cyan-400',
        'border_gradient' => 'from-cyan-400 to-blue-500',
    ],
];
@endphp

<div>
    <div class="text-center">
        <x-ui.typography variant="h2">
            How I Can Help Your Business
        </x-ui.typography>
        <p class="mt-4 text-lg font-sans text-zinc-600 dark:text-zinc-400">
            Choose the service that best fits your needs
        </p>
    </div>

    <div class="mt-12 grid gap-8 md:grid-cols-2">
        @foreach($services as $index => $service)
        <div class="p-[2px] rounded-xl bg-gradient-to-r {{ $service['border_gradient'] }} hover:shadow-xl hover:shadow-{{ $service['color'] }}-500/20 transition-all duration-300 group">
            <div class="h-full w-full bg-white dark:bg-zinc-900 rounded-xl">
            <div class="p-6 h-full flex flex-col">
                <div class="flex items-center justify-between">
                    <x-ui.animated-icon icon="{{ $service['icon'] }}" size="w-8 h-8" animation="none" color="{{ $service['icon_color'] }}" />
                </div>

                <x-ui.typography variant="h4" class="mt-4">
                    {{ $service['name'] }}
                </x-ui.typography>

                <p class="mt-2 text-sm font-sans text-zinc-600 dark:text-zinc-400 flex-grow">
                    {{ $service['description'] }}
                </p>

                <ul class="mt-4 space-y-2">
                    @foreach($service['features'] as $feature)
                    <li class="flex items-center text-sm font-sans text-zinc-600 dark:text-zinc-400">
                        <svg class="w-4 h-4 mr-2 {{ $service['text_color'] }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <p class="text-sm font-sans font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $service['pricing'] }}
                    </p>
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12 text-center">
        <x-ui.gradient-button variant="primary" href="{{ route('services') }}" icon="true">
            View Full Service Details
        </x-ui.gradient-button>
    </div>
</div>
