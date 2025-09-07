@php
$projects = [
    [
        'name' => 'Tether',
        'logo' => url('img/tether.png'),
        'tagline' => 'SMS to Telegram bridge',
        'description' => 'Because WhatsApp is bloated and SMS is ancient.',
        'status' => 'In development',
    ],
    [
        'name' => 'Invoice → Xero Automation',
        'icon' => '💰',
        'tagline' => 'Stop manually entering invoices like it\'s 1999.',
        'description' => null,
        'status' => 'In development',
    ],
    [
        'name' => 'PHAiTO',
        'logo' => url('img/companies/phaito.png'),
        'tagline' => 'AI-powered photo editing automation for photographers.',
        'description' => 'Process entire Lightroom catalogs in minutes instead of hours.',
        'status' => 'In development',
    ],
];
@endphp

<div>
    <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
        🚀 What I'm Building Right Now
    </h2>
    
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
        <div class="group relative rounded-2xl border border-zinc-100 p-6 hover:border-zinc-200 dark:border-zinc-700/40 dark:hover:border-zinc-600 transition-colors">
            @if(isset($project['logo']))
                <div class="w-12 h-12 mb-4">
                    <img src="{{ $project['logo'] }}" alt="{{ $project['name'] }}" class="w-full h-full object-contain">
                </div>
            @else
                <div class="text-2xl mb-4">{{ $project['icon'] }}</div>
            @endif
            
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $project['name'] }}
            </h3>
            
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                {{ $project['tagline'] }}
                @if($project['description'])
                    <br>{{ $project['description'] }}
                @endif
            </p>
            
            <p class="mt-4 text-xs font-medium text-zinc-500 dark:text-zinc-500">
                Status: <span class="text-emerald-600 dark:text-emerald-400">{{ $project['status'] }}</span>
            </p>
        </div>
        @endforeach
    </div>
</div>