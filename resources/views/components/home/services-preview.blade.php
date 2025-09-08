@php
$services = [
    [
        'icon' => 'code',
        'name' => 'Code Audit & Strategy',
        'description' => 'Get an experienced engineer\'s perspective on your code. Transform uncertainty into a clear technical roadmap with actionable insights.',
        'pricing' => 'Starting at $1,500',
        'features' => ['Comprehensive audit report', 'Security & performance analysis', 'Prioritized roadmap'],
    ],
    [
        'icon' => 'rocket',
        'name' => 'Build Your Product',
        'description' => 'Ship something real. From idea to revenue in weeks, not months. Clean code from an experienced engineer.',
        'pricing' => 'Starting at $15,000',
        'features' => ['Production-ready application', 'Scalable tech stack', '30 days post-launch support'],
    ],
    [
        'icon' => 'sparkles',
        'name' => 'Ongoing Partnership',
        'description' => 'Your technical co-founder without the equity. Get CTO-level guidance on an ongoing basis.',
        'pricing' => '$3,000 - $10,000/month',
        'features' => ['Weekly strategy calls', 'Code reviews & mentoring', 'Priority support'],
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

    <div class="mt-12 grid gap-8 lg:grid-cols-3">
        @foreach($services as $index => $service)
        <x-ui.gradient-border variant="{{ $index === 1 ? 'primary' : 'primary' }}" hover="true">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <x-ui.animated-icon icon="{{ $service['icon'] }}" size="w-8 h-8" animation="none" color="#06b6d4" />
                </div>

                <x-ui.typography variant="h4" class="mt-4">
                    {{ $service['name'] }}
                </x-ui.typography>

                <p class="mt-2 text-sm font-sans text-zinc-600 dark:text-zinc-400">
                    {{ $service['description'] }}
                </p>

                <ul class="mt-4 space-y-2">
                    @foreach($service['features'] as $feature)
                    <li class="flex items-center text-sm font-sans text-zinc-600 dark:text-zinc-400">
                        <svg class="w-4 h-4 mr-2 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
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
        </x-ui.gradient-border>
        @endforeach
    </div>

    <div class="mt-12 text-center">
        <x-ui.gradient-button variant="primary" href="{{ route('services') }}" icon="true">
            View Full Service Details
        </x-ui.gradient-button>
    </div>
</div>
