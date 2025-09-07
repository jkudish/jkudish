<x-layout title="Services - Joey Kudish">
    <x-ui.section background="white" spacing="large">
        <header class="max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                Services
            </h1>
            <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                I offer focused, results-driven services to help you build better software and automate your operations.
            </p>
        </header>
        
        <div class="mt-16 space-y-16">
            @php
            $services = [
                [
                    'name' => '"Fix My Code Mess" Sprint',
                    'description' => 'Your codebase has become a tangled mess. Your team is struggling. Technical debt is slowing everything down. I\'ll dive in, clean it up, establish best practices, and get your team back on track.',
                    'details' => [
                        'Code audit and refactoring',
                        'Performance optimization',
                        'Documentation and knowledge transfer',
                        'Team mentoring and best practices',
                    ],
                    'pricing' => 'Starting at $3k/week',
                    'duration' => '1-4 weeks typical',
                ],
                [
                    'name' => '"Build My MVP" Package',
                    'description' => 'You have a validated idea and need to get to market fast. I\'ll help you build and ship a working MVP in 30 days using Laravel and modern best practices.',
                    'details' => [
                        'Full-stack development',
                        'Database design and implementation',
                        'Core feature implementation',
                        'Deployment and launch support',
                    ],
                    'pricing' => 'Fixed-price sprints',
                    'duration' => '30-day sprints',
                ],
                [
                    'name' => '"Automate Everything" Transformation',
                    'description' => 'Stop wasting hours on repetitive tasks. Using AI and n8n, I\'ll build custom automation workflows that save your team time and generate new revenue opportunities.',
                    'details' => [
                        'Process analysis and optimization',
                        'Custom n8n workflow development',
                        'AI integration (GPT, Claude, etc.)',
                        'Training and documentation',
                    ],
                    'pricing' => 'Custom pricing based on scope',
                    'duration' => 'Varies by project',
                ],
            ];
            @endphp
            
            @foreach($services as $service)
            <div class="rounded-2xl border border-zinc-100 bg-white dark:bg-zinc-900 p-8 dark:border-zinc-700/40 shadow-sm hover:shadow-lg transition-shadow" id="{{ Str::slug($service['name']) }}">
                <h2 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
                    {{ $service['name'] }}
                </h2>
                
                <p class="mt-4 text-zinc-600 dark:text-zinc-400">
                    {{ $service['description'] }}
                </p>
                
                <div class="mt-6">
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                        What's Included:
                    </h3>
                    <ul class="mt-3 space-y-2">
                        @foreach($service['details'] as $detail)
                        <li class="flex gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <span class="text-teal-600 dark:text-teal-400">✓</span>
                            {{ $detail }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="mt-6 flex flex-col gap-2 sm:flex-row sm:gap-8">
                    <div>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Pricing:</span>
                        <span class="ml-2 text-sm text-teal-600 dark:text-teal-400">{{ $service['pricing'] }}</span>
                    </div>
                    <div>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Duration:</span>
                        <span class="ml-2 text-sm text-zinc-600 dark:text-zinc-400">{{ $service['duration'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-16 rounded-2xl bg-zinc-50 p-8 text-center dark:bg-zinc-800/50">
            <h2 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
                Ready to Get Started?
            </h2>
            <p class="mt-4 text-zinc-600 dark:text-zinc-400">
                Let's discuss your project and find the right solution for your needs.
            </p>
            <div class="mt-6">
                <x-ui.gradient-button variant="primary" href="mailto:joey@jkudish.com" icon="true">
                    Schedule a Consultation
                </x-ui.gradient-button>
            </div>
        </div>
    </x-ui.section>
</x-layout>