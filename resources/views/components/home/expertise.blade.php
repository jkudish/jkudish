@php
$expertise = [
    [
        'icon' => 'lucide-terminal',
        'name' => 'Full-Stack Development',
        'skills' => ['Laravel', 'Vue.js', 'React', 'Desktop and Mobile', 'Database Design'],
        'description' => 'Building scalable web applications from database to deployment'
    ],
    [
        'icon' => 'lucide-cpu',
        'name' => 'AI & Automation',
        'skills' => ['OpenAI', 'Anthropic', 'n8n', 'Zapier', 'OpenRouter'],
        'description' => 'Implementing intelligent automation that saves hours weekly'
    ],
    [
        'icon' => 'lucide-beaker',
        'name' => 'Product Development',
        'skills' => ['MVP Strategy', 'User Research', 'Analytics', 'Monetization & Growth'],
        'description' => 'Taking ideas from concept to profitable production'
    ],
    [
        'icon' => 'lucide-users',
        'name' => 'Technical Leadership',
        'skills' => ['Team Management', 'Code Reviews', 'Architecture', 'Mentoring'],
        'description' => 'Leading teams to deliver quality software on time'
    ],
];
@endphp

<div>
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
                        <x-icon name="{{ $area['icon'] }}" class="w-8 h-8 flex-shrink-0 mt-1" style="color: #047857" />
                        <div class="space-y-3 flex-1">
                            <x-ui.typography variant="h4">
                                {{ $area['name'] }}
                            </x-ui.typography>

                            <p class="text-sm font-sans text-zinc-600 dark:text-zinc-400">
                                {{ $area['description'] }}
                            </p>

                            <div class="flex flex-wrap gap-2">
                                @foreach($area['skills'] as $skill)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-sans font-medium bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
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
    </div>
</div>
