@php
$experience = [
    [
        'company' => 'Image Salon',
        'role' => 'CTO & Lead Developer',
        'period' => '2016 - Present',
        'highlights' => [
            'Reduced processing time by 75% through optimization',
            'Built multilingual platform serving 6,000+ photographers',
            'Led complete platform modernization'
        ]
    ],
    [
        'company' => 'Automattic',
        'role' => 'WordPress Core Contributor',
        'period' => '2012 - 2016',
        'highlights' => [
            'Contributed to WordPress.com infrastructure',
            'Built WooCommerce integrations at scale',
            'Developed features used by millions'
        ]
    ],
];

$expertise = [
    [
        'icon' => 'code',
        'name' => 'Full-Stack Development',
        'skills' => ['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'MySQL', 'PostgreSQL'],
        'description' => 'Building scalable web applications from database to deployment'
    ],
    [
        'icon' => 'sparkles',
        'name' => 'AI & Automation',
        'skills' => ['GPT-4', 'Claude', 'n8n', 'Zapier', 'Python', 'LangChain'],
        'description' => 'Implementing intelligent automation that saves hours weekly'
    ],
    [
        'icon' => 'rocket',
        'name' => 'Product Development',
        'skills' => ['MVP Strategy', 'Agile', 'User Research', 'A/B Testing', 'Analytics'],
        'description' => 'Taking ideas from concept to profitable production'
    ],
    [
        'icon' => 'star',
        'name' => 'Technical Leadership',
        'skills' => ['Team Management', 'Code Reviews', 'Architecture', 'Mentoring'],
        'description' => 'Leading teams to deliver quality software on time'
    ],
];
@endphp

<div class="space-y-20">
    {{-- Experience Timeline --}}
    <div>
        <div class="flex items-center gap-4 mb-8">
            <x-ui.typography variant="h2">
                Professional Journey
            </x-ui.typography>
            <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
        </div>
        
        <div class="space-y-8">
            @foreach($experience as $job)
            <div class="relative pl-8 before:absolute before:left-0 before:top-0 before:bottom-0 before:w-px before:bg-gradient-to-b before:from-teal-500 before:to-transparent">
                <div class="absolute left-0 top-2 w-2 h-2 -translate-x-1/2 rounded-full bg-teal-500"></div>
                
                <div class="space-y-3">
                    <div class="flex flex-wrap items-baseline gap-2">
                        <x-ui.typography variant="h4">
                            {{ $job['role'] }}
                        </x-ui.typography>
                        <span class="text-teal-600 dark:text-teal-400 font-medium">
                            @ {{ $job['company'] }}
                        </span>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $job['period'] }}
                        </span>
                    </div>
                    
                    <ul class="space-y-1">
                        @foreach($job['highlights'] as $highlight)
                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                            <span class="text-teal-600 dark:text-teal-400 mt-1">•</span>
                            {{ $highlight }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
            
            {{-- Additional quick facts --}}
            <div class="pl-8 space-y-2">
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    <span class="font-medium">Also:</span> WordPress Core Contributor • Open Source Maintainer • Conference Speaker
                </p>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    <span class="font-medium">Remote:</span> Successfully worked from 30+ countries as a digital nomad
                </p>
            </div>
        </div>
    </div>
    
    {{-- Expertise Grid --}}
    <div>
        <div class="flex items-center gap-4 mb-8">
            <x-ui.typography variant="h2">
                Technical Expertise
            </x-ui.typography>
            <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
        </div>
        
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($expertise as $area)
            <x-ui.gradient-border variant="primary" hover="true" padding="p-[1px]">
                <div class="p-6 h-full">
                    <div class="flex items-start gap-4">
                        <x-ui.animated-icon 
                            icon="{{ $area['icon'] }}" 
                            size="w-8 h-8" 
                            animation="none" 
                            color="#06b6d4"
                            class="flex-shrink-0 mt-1"
                        />
                        <div class="space-y-3 flex-1">
                            <x-ui.typography variant="h4">
                                {{ $area['name'] }}
                            </x-ui.typography>
                            
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                {{ $area['description'] }}
                            </p>
                            
                            <div class="flex flex-wrap gap-2">
                                @foreach($area['skills'] as $skill)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ $skill }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.gradient-border>
            @endforeach
        </div>
        
        {{-- Current Focus --}}
        <div class="mt-8 p-6 rounded-2xl bg-gradient-to-br from-teal-50 via-white to-blue-50 dark:from-teal-950/20 dark:via-zinc-900 dark:to-blue-950/20 border border-teal-200/30 dark:border-teal-700/30">
            <div class="flex items-start gap-3">
                <span class="text-2xl">🚀</span>
                <div>
                    <x-ui.typography variant="h4">
                        Currently Building
                    </x-ui.typography>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                        <strong>PHAiTO</strong> - AI-powered photo editor that processes entire Lightroom catalogs in minutes. 
                        Plus launching multiple SaaS products focused on developer productivity and AI automation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>