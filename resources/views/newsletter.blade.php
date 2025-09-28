<x-layout 
    title="Human in the Loop Newsletter"
    description="Subscribe to Human in the Loop for practical insights on AI-augmented coding, productivity hacks, and how to use AI as your development partner, not replacement."
    keywords="AI coding newsletter, AI development workflow, human in the loop, AI productivity, AI-assisted programming, Claude Code, Cursor, AI automation"
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
                                Human in the Loop
                            </x-ui.typography>
                            
                            <p class="mt-6 text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                                Master AI-augmented development: Real workflows for coding with Claude, Cursor, and AI tools that amplify your skills, not replace them.
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
                                            Join Human in the Loop
                                        </x-ui.gradient-button>
                                    </div>
                                    
                                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400 mt-4">
                                        I'll never spam you, promise.
                                    </p>
                                </form>
                            </div>
                        </div>

                        {{-- Topics I Cover --}}
                        <div class="mt-16">
                            <h2 class="text-center text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-8">
                                Topics I Cover
                            </h2>
                            
                            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                                            <x-icon name="lucide-cpu" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">AI as Your Coding Partner</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                Real-world workflows using Claude Code and Cursor. Prompt engineering techniques that actually work in production.
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
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Human-AI Collaboration</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                How I build faster with AI assistance. The balance between automation and human creativity. Real metrics and outcomes.
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
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">AI-Enhanced Development</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                Using AI for code review, testing, refactoring. AI patterns for Laravel, React, and modern frameworks.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-2 rounded-lg bg-indigo-100 dark:bg-indigo-900/30">
                                            <x-icon name="lucide-brain" class="w-5 h-5 text-indigo-600 dark:text-indigo-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Obsidian for AI Development</h3>
                                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                                Using Obsidian as your second brain for coding. Building prompt libraries, managing context, and documenting AI workflows.
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
                                    First Issue Coming In a Few Days
                                </span>
                            </div>
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