<div class="relative">
    {{-- Subtle gradient overlay --}}
    <div class="absolute inset-0 -z-10 opacity-30">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-emerald-100 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gradient-to-tr from-purple-100 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="grid gap-12 lg:grid-cols-2 lg:gap-8 items-center">
        {{-- Left column - Text content --}}
        <div class="order-2 lg:order-1">
            <x-ui.typography variant="h1">
                Hey, I'm Joey 👋
                <span class="block text-gradient-primary mt-2">I Build Software That Works</span>
            </x-ui.typography>

            <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400 leading-relaxed">
                I help businesses transform their technology challenges into competitive advantages through
                custom software development and intelligent automation solutions that deliver real results.
            </p>

            <div class="mt-8 flex flex-wrap gap-6 text-sm text-zinc-600 dark:text-zinc-400">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span>Available for Projects</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>18+ Years Experience</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>100+ Projects Delivered</span>
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <x-ui.gradient-button variant="primary" href="{{ route('contact') }}" icon="true">
                    Let's Talk About Your Project
                </x-ui.gradient-button>
                <x-ui.gradient-button variant="outline" href="{{ route('services') }}">
                    View Services
                </x-ui.gradient-button>
            </div>
        </div>

        {{-- Right column - Image --}}
        <div class="order-1 lg:order-2 flex justify-center lg:justify-end">
            <div class="relative">
                <picture class="relative">
                    <source srcset="{{ asset('img/joey.webp') }}" type="image/webp">
                    <source srcset="{{ asset('img/joey.jpeg') }}" type="image/jpeg">
                    <img
                        src="{{ asset('img/joey.jpeg') }}"
                        class="relative w-64 h-64 lg:w-80 lg:h-80 rounded-full object-cover border-4 border-white dark:border-zinc-800 shadow-2xl"
                        loading="eager"
                        fetchpriority="high"
                        width="320"
                        height="320"
                        alt="Joey Kudish - Senior Software Engineer">
                </picture>
            </div>
        </div>
    </div>
</div>
