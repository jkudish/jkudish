<x-layout title="Projects - Joey Kudish">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-10">
        <header class="max-w-2xl">
            <x-ui.typography variant="h1">
                Projects
            </x-ui.typography>
            <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                A collection of indie projects I'm building and products I've shipped. Each one solves a real problem I've encountered.
            </p>
        </header>
        
        <div class="mt-16">
            <x-ui.typography variant="h3">
                🚀 Currently Building
            </x-ui.typography>
            
            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                @php
                $currentProjects = [
                    [
                        'name' => 'Tether',
                        'icon' => '📱',
                        'description' => 'SMS to Telegram bridge that keeps you connected without the bloat of WhatsApp or the limitations of SMS.',
                        'status' => 'In active development',
                        'tech' => ['Laravel', 'Telegram API', 'Twilio'],
                    ],
                    [
                        'name' => 'Invoice → Xero Automation',
                        'icon' => '💰',
                        'description' => 'Automatically extract invoice data and push it to Xero. Stop manually entering invoices like it\'s 1999.',
                        'status' => 'Beta testing',
                        'tech' => ['n8n', 'AI Vision', 'Xero API'],
                    ],
                    [
                        'name' => 'PHAiTO',
                        'icon' => '📸',
                        'description' => 'AI-powered Lightroom editor that processes entire photo catalogs in minutes instead of hours.',
                        'status' => 'Recently launched',
                        'tech' => ['Python', 'AI/ML', 'Lightroom SDK'],
                    ],
                    [
                        'name' => 'The Maker Notes',
                        'icon' => '📬',
                        'description' => 'Weekly newsletter sharing real insights from building indie projects and running a software business.',
                        'status' => 'Launching soon',
                        'tech' => ['ConvertKit', 'Laravel'],
                    ],
                ];
                @endphp
                
                @foreach($currentProjects as $project)
                <div class="rounded-2xl border border-zinc-100 p-6 hover:shadow-lg transition-shadow dark:border-zinc-700/40">
                    <div class="flex items-start gap-4">
                        <span class="text-3xl">{{ $project['icon'] }}</span>
                        <div class="flex-1">
                            <x-ui.typography variant="h4">
                                {{ $project['name'] }}
                            </x-ui.typography>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                                {{ $project['description'] }}
                            </p>
                            <div class="mt-4">
                                <p class="text-xs font-medium text-teal-600 dark:text-teal-400">
                                    {{ $project['status'] }}
                                </p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($project['tech'] as $tech)
                                    <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                        {{ $tech }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="mt-16">
            <x-ui.typography variant="h3">
                ✅ Past Work
            </x-ui.typography>
            
            <div class="mt-8 space-y-8">
                @php
                $pastWork = [
                    [
                        'category' => 'At Automattic (WordPress.com)',
                        'items' => [
                            'WordPress.com features serving millions of users',
                            'WooCommerce Connect shipping integrations',
                            'Analytics dashboard for thousands of e-commerce stores',
                            'Core contributions to WordPress open-source project',
                        ],
                    ],
                    [
                        'category' => 'At Image Salon',
                        'items' => [
                            'Reduced photo processing time by 75% through automation',
                            'Built multilingual dashboard serving 6,000+ photographers globally',
                            'Implemented AI-powered photo editing workflows',
                            'Created complete business automation system',
                        ],
                    ],
                    [
                        'category' => 'Indie Products',
                        'items' => [
                            'Multiple profitable SaaS products',
                            'WordPress plugins with thousands of active installations',
                            'Custom automation solutions for various businesses',
                            'Open-source contributions and tools',
                        ],
                    ],
                ];
                @endphp
                
                @foreach($pastWork as $category)
                <div>
                    <x-ui.typography variant="h4">
                        {{ $category['category'] }}
                    </x-ui.typography>
                    <ul class="mt-4 space-y-2">
                        @foreach($category['items'] as $item)
                        <li class="flex gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <span class="text-teal-600 dark:text-teal-400">→</span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="mt-16 text-center">
            <p class="text-zinc-600 dark:text-zinc-400">
                Want to work together on your next project?
            </p>
            <div class="mt-4">
                <x-ui.gradient-button variant="primary" href="{{ route('services') }}" icon="true">
                    View My Services
                </x-ui.gradient-button>
            </div>
        </div>
    </div>
</x-layout>