<x-layout title="The Maker Notes - Joey Kudish">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-10">
        <header class="max-w-2xl">
            <x-ui.typography variant="h1">
                📬 The Maker Notes
            </x-ui.typography>
            <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                Weekly insights from building indie projects, automating with AI, and running a software business. No fluff, just practical lessons from someone doing the work.
            </p>
        </header>
        
        <div class="mt-16 grid gap-16 lg:grid-cols-3 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="rounded-2xl bg-gradient-to-br from-teal-50/30 to-cyan-50/20 p-8 dark:bg-zinc-800/50 border border-teal-100/30 dark:border-zinc-700/50 shadow-sm">
                    <x-ui.typography variant="h3">
                        What You'll Get
                    </x-ui.typography>
                    
                    <div class="mt-6 space-y-4">
                        @php
                        $benefits = [
                            [
                                'title' => 'Real Building Experiences',
                                'description' => 'I share what actually works (and what doesn\'t) from building multiple products simultaneously.',
                            ],
                            [
                                'title' => 'AI Automation Workflows',
                                'description' => 'Practical n8n workflows and AI integrations that save hours every week.',
                            ],
                            [
                                'title' => 'Technical Deep Dives',
                                'description' => 'Laravel, WordPress, and modern web development insights from 18+ years of experience.',
                            ],
                            [
                                'title' => 'Business Lessons',
                                'description' => 'The reality of running a software business, working with clients, and building products.',
                            ],
                        ];
                        @endphp
                        
                        @foreach($benefits as $benefit)
                        <div>
                            <x-ui.typography variant="h4">
                                {{ $benefit['title'] }}
                            </x-ui.typography>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                {{ $benefit['description'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-8">
                    <x-ui.typography variant="h3">
                        Recent Topics
                    </x-ui.typography>
                    
                    <ul class="mt-6 space-y-3">
                        @php
                        $topics = [
                            'Building Tether: Why I\'m creating an SMS to Telegram bridge',
                            'How I reduced Image Salon\'s processing time by 75% with AI',
                            'The real cost of technical debt (and when to pay it down)',
                            'Laravel vs WordPress: Choosing the right tool for the job',
                            'Automating invoice processing with n8n and AI vision',
                            'Lessons from 30+ countries as a digital nomad developer',
                            'Why I\'m building 3 products simultaneously (and how I manage it)',
                            'The tools and workflows that actually make me productive',
                        ];
                        @endphp
                        
                        @foreach($topics as $topic)
                        <li class="flex gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <span class="text-teal-600 dark:text-teal-400">→</span>
                            {{ $topic }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div>
                <div class="sticky top-8">
                    <div class="rounded-2xl border border-zinc-100 p-6 dark:border-zinc-700/40">
                        <x-ui.typography variant="h4">
                            Subscribe Now
                        </x-ui.typography>
                        
                        <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400">
                            Join other makers, developers, and entrepreneurs getting weekly insights.
                        </p>
                        
                        <form class="mt-6 space-y-4" action="#" method="POST">
                            @csrf
                            <div>
                                <label for="email" class="sr-only">Email address</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Your email address"
                                    class="w-full rounded-md border border-emerald-500/40 bg-white px-3 py-2 shadow-sm text-gray-900 placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-600/40 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20 sm:text-sm transition-all duration-200"
                                />
                            </div>
                            
                            <div>
                                <label for="name" class="sr-only">First name</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="First name (optional)"
                                    class="w-full rounded-md border border-emerald-500/40 bg-white px-3 py-2 shadow-sm text-gray-900 placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-600/40 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20 sm:text-sm transition-all duration-200"
                                />
                            </div>
                            
                            <x-ui.gradient-button variant="primary" type="submit" class="w-full">
                                Subscribe → It's Free
                            </x-ui.gradient-button>
                        </form>
                        
                        <p class="mt-4 text-xs text-zinc-500 dark:text-zinc-400">
                            No spam, unsubscribe anytime.
                        </p>
                    </div>
                    
                    <div class="mt-6 rounded-2xl bg-amber-50 p-4 dark:bg-amber-900/20">
                        <p class="text-sm font-medium text-amber-800 dark:text-amber-200">
                            🚀 Launching January 2025
                        </p>
                        <p class="mt-1 text-xs text-amber-700 dark:text-amber-300">
                            Be among the first subscribers and get exclusive early content.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>