<x-layout
    title="404 - Page Not Found"
    description="Oops! The page you're looking for seems to have wandered off into the digital wilderness."
    :appendSiteName="false"
>
    @push('head')
        <meta name="robots" content="noindex, nofollow">
        <style>
            .text-gradient-primary {
                background: linear-gradient(135deg, #047857 0%, #065f46 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
        </style>
    @endpush

    <div class="min-h-[70vh] flex items-center justify-center px-6 py-12 relative">
        {{-- Background decoration --}}
        <div class="absolute inset-0 bg-mesh-gradient opacity-30"></div>
        
        <div class="relative z-10 text-center max-w-3xl mx-auto">
            {{-- 404 Display with gradient --}}
            <div class="mb-8 animate-fade-in">
                <h1 class="text-[8rem] sm:text-[10rem] md:text-[12rem] lg:text-[14rem] font-title font-bold leading-none text-gradient-primary">
                    404
                </h1>
            </div>

            {{-- Error Message --}}
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards;">
                <x-ui.typography variant="h2" class="mb-4">
                    Oops! This page got lost in the digital void
                </x-ui.typography>
                
                <x-ui.typography variant="lead" class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    The page you're looking for might have been moved, deleted, or perhaps it never existed in this timeline.
                </x-ui.typography>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8 animate-fade-in" style="animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards;">
                <x-ui.gradient-button 
                    href="/"
                    variant="primary"
                    class="px-8 py-3"
                >
                    Take Me Home
                </x-ui.gradient-button>

                <x-ui.gradient-button 
                    href="/services"
                    variant="secondary"
                    class="px-8 py-3"
                >
                    View Services
                </x-ui.gradient-button>

                <x-ui.gradient-button 
                    href="/speaking"
                    variant="secondary"
                    class="px-8 py-3"
                >
                    Speaking
                </x-ui.gradient-button>
            </div>

            {{-- Helper Text --}}
            <div class="animate-fade-in" style="animation-delay: 0.6s; opacity: 0; animation-fill-mode: forwards;">
                <x-ui.typography variant="small" class="text-gray-500 dark:text-gray-500">
                    Lost? Try starting from the <a href="/" class="text-teal-600 dark:text-teal-400 hover:underline">homepage</a> or check that the URL is correct.
                </x-ui.typography>
            </div>

            {{-- Fun Monster Illustration --}}
            <div class="mt-12 animate-float" style="animation-delay: 0.8s;">
                <div class="w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64 lg:w-72 lg:h-72 mx-auto">
                    <img 
                        src="{{ asset('img/404-monster.svg') }}" 
                        alt="Friendly 404 monster holding a sign, looking confused"
                        class="w-full h-full opacity-90 dark:opacity-80"
                        aria-label="A friendly purple and pink monster holding a 404 sign, with question marks floating above its head"
                    />
                </div>
            </div>
        </div>
    </div>

    {{-- Fathom Analytics 404 Tracking --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof window.fathom !== 'undefined') {
                    window.fathom.trackEvent('404_page_view', {
                        path: window.location.pathname
                    });
                }
            });
        </script>
    @endpush
</x-layout>