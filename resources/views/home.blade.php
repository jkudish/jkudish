<x-layout>
    <div class="space-y-20 sm:space-y-32 lg:space-y-40">
        <x-home.hero />
        
        <x-home.about />
        
        <x-home.current-projects />
        
        <x-home.services-preview />
        
        <x-home.social-proof />
        
        <x-home.newsletter-signup />
        
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="rounded-2xl border border-zinc-100 p-8 dark:border-zinc-700/40">
                <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl text-center">
                    Let's Connect
                </h2>
                
                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="text-center">
                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                            Need Something Built?
                        </h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            I'm available for projects and consultations.
                        </p>
                        <div class="mt-4">
                            <x-ui.button variant="outline" href="mailto:joey@jkudish.com">
                                Email → joey@jkudish.com
                            </x-ui.button>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                            Want Weekly Insights?
                        </h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            Subscribe to The Maker Notes for real building experiences.
                        </p>
                        <div class="mt-4">
                            <x-ui.button variant="outline" href="{{ route('newsletter') }}">
                                Subscribe Here →
                            </x-ui.button>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                            Find Me Online
                        </h3>
                        <div class="mt-4 flex justify-center gap-4 text-zinc-600 dark:text-zinc-400">
                            <a href="https://linkedin.com/in/jkudish" class="hover:text-teal-500 dark:hover:text-teal-400 transition">
                                LinkedIn
                            </a>
                            <span>|</span>
                            <a href="https://github.com/jkudish" class="hover:text-teal-500 dark:hover:text-teal-400 transition">
                                GitHub
                            </a>
                            <span>|</span>
                            <a href="https://twitter.com/jkudish" class="hover:text-teal-500 dark:hover:text-teal-400 transition">
                                X
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>