<x-layout 
    title="The Maker Notes Newsletter"
    description="Subscribe to The Maker Notes for insights on software development, AI automation, and building digital products."
    keywords="tech newsletter, software development newsletter, The Maker Notes, AI automation insights, coding with AI, digital products"
    :hideNewsletter="true"
>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">
                
                {{-- Main Content --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32">
                    <div class="mx-auto max-w-3xl">
                        {{-- Header with Icon --}}
                        <div class="text-center">
                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-xl blur-2xl opacity-20"></div>
                                    <div class="relative bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 p-4 rounded-xl border border-teal-200/50 dark:border-teal-700/50">
                                        <x-icon name="lucide-mail" class="w-12 h-12 text-teal-600 dark:text-teal-400" />
                                    </div>
                                </div>
                            </div>
                            
                            <x-ui.typography variant="h1" class="text-center">
                                The Maker Notes
                            </x-ui.typography>
                            
                            <p class="mt-6 text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                                Insights on coding with AI, building products in public, and running indie software businesses. 
                                Real lessons from shipping Laravel, WordPress, and Shopify projects.
                            </p>
                        </div>

                        {{-- Newsletter Signup Form --}}
                        <div class="mt-12 max-w-lg mx-auto">
                            @if(session('success'))
                                <div class="mb-6 rounded-lg bg-teal-50 p-4 text-teal-800 dark:bg-teal-900/20 dark:text-teal-200">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-800 dark:bg-red-900/20 dark:text-red-200">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            <div class="bg-gradient-to-br from-teal-50/50 to-emerald-50/50 dark:from-zinc-800/50 dark:to-zinc-800/30 rounded-2xl p-8 border border-teal-100/50 dark:border-zinc-700/50">
                                <form class="space-y-4" action="{{ route('newsletter.store') }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                            Email address
                                        </label>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            placeholder="you@example.com"
                                            required
                                            class="w-full rounded-lg border border-teal-200/50 dark:border-emerald-700/50 bg-white dark:bg-zinc-900/50 px-4 py-3 text-zinc-900 dark:text-zinc-100 placeholder:text-zinc-500 dark:placeholder:text-zinc-500 focus:border-emerald-500 dark:focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:focus:ring-emerald-400/20 transition-all duration-200"
                                        />
                                    </div>
                                    
                                    <div class="pt-2">
                                        <x-ui.gradient-button variant="primary" type="submit" icon="true" class="w-full">
                                            Join The Maker Notes
                                        </x-ui.gradient-button>
                                    </div>
                                    
                                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400 mt-4">
                                        Zero spam. Unsubscribe anytime.
                                    </p>
                                </form>
                            </div>
                        </div>

                        {{-- Topics I'll Cover --}}
                        <div class="mt-16">
                            <h2 class="text-center text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-8">
                                Topics I'll Cover
                            </h2>
                            
                            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                                            <x-icon name="lucide-cpu" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Coding with AI</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                How I use AI to ship faster. Real workflows, actual prompts, and lessons from building production apps with AI assistance.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                            <x-icon name="lucide-rocket" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Building in Public</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                Follow my journey building Tether, PHAiTO, and new products. Revenue numbers, growth tactics, and honest failures.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-red-100 dark:bg-red-900/30">
                                            <x-icon name="lucide-code-2" class="w-5 h-5 text-red-600 dark:text-red-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Laravel, WordPress & Shopify</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                Deep technical insights from 18+ years shipping code. Architecture decisions, performance optimization, and battle-tested patterns.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-yellow-100 dark:bg-yellow-900/30">
                                            <x-icon name="lucide-zap" class="w-5 h-5 text-yellow-600 dark:text-yellow-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Smart Automation</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                n8n workflows that save hours every week. From content generation to development workflows, I'll share automations that multiply your productivity.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Launch Notice --}}
                        <div class="mt-16 text-center">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50">
                                <x-icon name="lucide-sparkles" class="w-4 h-4 text-amber-600 dark:text-amber-400" />
                                <span class="text-sm font-medium text-amber-800 dark:text-amber-200">
                                    Launching September 2025
                                </span>
                            </div>
                            <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400">
                                Be among the first to get exclusive early content
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    {{-- Track newsletter signup event --}}
    @if(session('track_event') === 'newsletter_signup')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.fathom) {
                window.fathom.trackEvent('newsletter_signup');
            }
        });
    </script>
    @endif
</x-layout>