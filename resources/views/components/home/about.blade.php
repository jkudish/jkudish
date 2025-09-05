@php
$achievements = [
    ['icon' => '✅', 'text' => '<strong>15+ years</strong> building production software'],
    ['icon' => '✅', 'text' => '<strong>WordPress Core Contributor</strong> at Automattic (2012-2016)'],
    ['icon' => '✅', 'text' => '<strong>Current CTO</strong> at Image Salon (6,000+ clients worldwide)'],
    ['icon' => '✅', 'text' => '<strong>30+ countries</strong> worked from as a digital nomad'],
];

$expertise = [
    ['name' => 'Laravel', 'description' => 'My go-to for building scalable applications'],
    ['name' => 'WordPress', 'description' => 'Contributed to core, built plugins, know it inside out'],
    ['name' => 'AI Automation', 'description' => 'Using n8n to save businesses hours every week'],
    ['name' => 'Product Development', 'description' => 'From idea to production to profitable'],
];
@endphp

<div>
    <div class="space-y-16">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
                Quick Background
            </h2>
            
            <ul class="mt-6 space-y-4">
                @foreach($achievements as $achievement)
                <li class="flex gap-3 text-base text-zinc-600 dark:text-zinc-400">
                    <span class="text-xl">{{ $achievement['icon'] }}</span>
                    <span>{!! $achievement['text'] !!}</span>
                </li>
                @endforeach
            </ul>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
                My Expertise
            </h2>
            
            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                @foreach($expertise as $skill)
                <div class="rounded-2xl border border-zinc-200/50 bg-white/60 backdrop-blur-sm p-6 dark:border-zinc-700/50 dark:bg-zinc-800/60 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $skill['name'] }}
                    </h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $skill['description'] }}
                    </p>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 rounded-2xl bg-gradient-to-br from-teal-50 to-zinc-50 p-6 dark:from-teal-950/20 dark:to-zinc-800/50 border border-teal-200/30 dark:border-teal-700/30">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                    Recent Achievement
                </h3>
                <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                    Built PHAiTO—an AI-powered Lightroom editor that processes entire photo catalogs in minutes.
                </p>
            </div>
        </div>
    </div>
</div>