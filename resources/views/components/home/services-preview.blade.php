@php
$services = [
    [
        'icon' => 'code',
        'name' => 'Code Cleanup & Refactoring',
        'description' => 'Transform your legacy codebase into maintainable, scalable software. Fix bugs, improve performance, and modernize your tech stack.',
        'pricing' => 'Starting at $3,000/week',
        'features' => ['Code audit', 'Performance optimization', 'Documentation'],
    ],
    [
        'icon' => 'rocket',
        'name' => 'MVP Development',
        'description' => 'Ship your product idea in 30 days. Full-stack development from concept to deployment with modern frameworks.',
        'pricing' => 'Fixed-price from $15,000',
        'features' => ['30-day delivery', 'Full-stack development', 'Launch support'],
    ],
    [
        'icon' => 'sparkles',
        'name' => 'AI Automation',
        'description' => 'Automate repetitive tasks and workflows with custom AI solutions. Save time and reduce errors with intelligent automation.',
        'pricing' => 'Custom pricing',
        'features' => ['Process automation', 'AI integration', 'Workflow optimization'],
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
                    @if($index === 1)
                        <x-ui.status-badge status="new" pulse="true">Popular</x-ui.status-badge>
                    @endif
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