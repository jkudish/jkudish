@php
$services = [
    [
        'name' => '"Fix My Code Mess" Sprint',
        'description' => 'Your codebase needs love. Your team needs direction. Let\'s clean it up.',
        'pricing' => 'Starting at $3k/week',
    ],
    [
        'name' => '"Build My MVP" Package',
        'description' => 'You have an idea. I\'ll help you ship it in 30 days.',
        'pricing' => 'Fixed-price sprints',
    ],
    [
        'name' => '"Automate Everything" Transformation',
        'description' => 'Manual processes killing your productivity? Let\'s automate with AI + n8n.',
        'pricing' => 'Custom pricing based on scope',
    ],
];
@endphp

<div>
    <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
        💼 Three Ways I Can Help
    </h2>
    
    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        @foreach($services as $service)
        <div class="rounded-2xl border border-zinc-100 p-6 hover:shadow-lg transition-shadow dark:border-zinc-700/40 dark:hover:border-zinc-600">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $service['name'] }}
            </h3>
            
            <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400">
                {{ $service['description'] }}
            </p>
            
            <p class="mt-4 text-sm font-medium text-teal-600 dark:text-teal-400">
                {{ $service['pricing'] }}
            </p>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8 text-center">
        <x-ui.button variant="primary" href="{{ route('services') }}">
            View All Services →
        </x-ui.button>
    </div>
</div>