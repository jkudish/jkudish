<x-layout>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">
                {{-- Hero Section - White with subtle pattern --}}
                <div class="relative px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32 bg-gradient-to-br from-white to-zinc-50/50 dark:from-zinc-900 dark:to-zinc-800">
                    <div class="absolute inset-0 bg-mesh-gradient opacity-30 dark:opacity-10"></div>
                    <div class="relative z-10">
                        <x-home.hero />
                    </div>
                </div>

                {{-- About Section - Light gray background --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.expertise />
                </div>

                {{-- Services Preview - White background --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.services-preview />
                </div>

                {{-- Current Projects - Light gray background --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.current-projects />
                </div>

                {{-- Social Proof - White background --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <x-home.social-proof />
                </div>
            </div>
        </div>
    </div>
</x-layout>
