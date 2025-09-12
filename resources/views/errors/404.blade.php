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
        
        <div class="relative z-10 max-w-4xl mx-auto">
            {{-- Container with title and content --}}
            <x-ui.container class="bg-white/95 dark:bg-zinc-900/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 md:p-12">
                {{-- Page Title --}}
                <div class="text-center mb-8 animate-fade-in">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-title font-bold text-gray-900 dark:text-white mb-2">
                        404: Whoops, this page doesn't exist
                    </h1>
                    <div class="w-24 h-1 bg-gradient-primary mx-auto rounded-full mt-4"></div>
                </div>

                {{-- Monster Illustration --}}
                <div class="mb-8 animate-slide-up" style="animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards;">
                    <div class="w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 mx-auto">
                        <picture>
                            <source srcset="{{ asset('img/404.webp') }}" type="image/webp">
                            <img 
                                src="{{ asset('img/404.png') }}" 
                                alt="Sad monster realizing the page is missing"
                                class="w-full h-full object-contain"
                                loading="eager"
                                width="1024"
                                height="1536"
                                aria-label="A cute teal monster with horns looking sad about the missing page"
                            />
                        </picture>
                    </div>
                </div>

                {{-- Error Message --}}
                <div class="text-center mb-8 animate-fade-in" style="animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards;">
                    <x-ui.typography variant="lead" class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-6">
                        The page you're looking for seems to have wandered off. Don't worry, even the best explorers get lost sometimes!
                    </x-ui.typography>
                    
                    {{-- Back to Home Link --}}
                    <x-ui.gradient-button 
                        href="/"
                        variant="primary"
                        class="px-8 py-4 text-lg"
                    >
                        Back to Homepage
                    </x-ui.gradient-button>
                </div>

                {{-- Additional Navigation Options --}}
                <div class="border-t border-gray-200 dark:border-zinc-700 pt-6 mt-8 animate-fade-in" style="animation-delay: 0.6s; opacity: 0; animation-fill-mode: forwards;">
                    <x-ui.typography variant="small" class="text-center text-gray-500 dark:text-gray-500 mb-4">
                        Or explore other sections:
                    </x-ui.typography>
                    <div class="flex flex-wrap gap-3 justify-center">
                        <a href="/services" class="text-teal-600 dark:text-teal-400 hover:underline">Services</a>
                        <span class="text-gray-400 dark:text-gray-600">•</span>
                        <a href="/projects" class="text-teal-600 dark:text-teal-400 hover:underline">Projects</a>
                        <span class="text-gray-400 dark:text-gray-600">•</span>
                        <a href="/speaking" class="text-teal-600 dark:text-teal-400 hover:underline">Speaking</a>
                        <span class="text-gray-400 dark:text-gray-600">•</span>
                        <a href="/contact" class="text-teal-600 dark:text-teal-400 hover:underline">Contact</a>
                    </div>
                </div>
            </x-ui.container>
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