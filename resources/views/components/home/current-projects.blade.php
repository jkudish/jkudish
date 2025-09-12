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
    <div class="flex items-center gap-4 mb-8">
        <x-ui.typography variant="h2">
            What I'm Building Right Now
        </x-ui.typography>
        <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
    </div>
    
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
        <div class="group relative rounded-2xl border border-zinc-100 p-6 hover:border-zinc-200 dark:border-zinc-700/40 dark:hover:border-zinc-600 transition-colors">
            @if(isset($project['logo']))
                <div class="w-12 h-12 mb-4">
                    <img src="{{ $project['logo'] }}" alt="{{ $project['name'] }}" class="w-full h-full object-contain">
                </div>
            @else
                <div class="text-2xl mb-4">{{ $project['icon'] }}</div>
            @endif
            
            <x-ui.typography variant="h4">
                {{ $project['name'] }}
            </x-ui.typography>
            
            <p class="mt-2 text-sm font-sans text-zinc-600 dark:text-zinc-400">
                {{ $project['tagline'] }}
                @if($project['description'])
                    <br>{{ $project['description'] }}
                @endif
            </p>
            
            <p class="mt-4 text-xs font-sans font-medium text-zinc-500 dark:text-zinc-500">
                Status: <span class="text-emerald-700 dark:text-emerald-300">{{ $project['status'] }}</span>
            </p>
        </div>
        @endforeach
    </div>
</div>