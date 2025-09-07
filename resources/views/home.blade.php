<x-layout>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden">
                {{-- Hero Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32">
                    <x-home.hero />
                </div>

                {{-- About Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-home.about />
                </div>

                {{-- Services Preview --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-home.services-preview />
                </div>

                {{-- Current Projects --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-home.current-projects />
                </div>

                {{-- Social Proof --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 border-t border-zinc-200/50 dark:border-zinc-700/50">
                    <x-home.social-proof />
                </div>
            </div>
        </div>
    </div>
</x-layout>
