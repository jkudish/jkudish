@php
$projects = [
    [
        'name' => 'Tether',
        'icon' => '📱→💬',
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
        'name' => 'n8n Automations',
        'icon' => '🤖',
        'tagline' => 'AI workflows to save your business hours every week and generate new revenue.',
        'description' => null,
        'status' => 'Several businesses have benefited',
    ],
];
@endphp

<div class="mx-auto max-w-2xl lg:max-w-5xl">
    <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
        🚀 What I'm Building Right Now
    </h2>
    
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
        <div class="group relative rounded-2xl border border-zinc-100 p-6 hover:border-zinc-200 dark:border-zinc-700/40 dark:hover:border-zinc-600 transition-colors">
            <div class="text-2xl mb-4">{{ $project['icon'] }}</div>
            
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
                Status: <span class="text-teal-600 dark:text-teal-400">{{ $project['status'] }}</span>
            </p>
        </div>
        @endforeach
    </div>
</div>