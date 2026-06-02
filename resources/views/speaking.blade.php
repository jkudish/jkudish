@php
    $conferences = [
        [
            'conference' => 'WordCamp Canada 2024',
            'location' => 'Ottawa, Canada',
            'title' => 'Mastering Web Performance',
            'slides' => url('slides/wccanada2024-performance.pdf'),
        ],
        [
            'conference' => 'Confoo 2017',
            'location' => 'Vancouver, Canada',
            'title' => 'Building quality PHP applications with Laravel',
            'slides' => url('slides/confoo2017.pdf'),
        ],
        [
            'conference' => 'PHP/Laravel Meetup May 2017',
            'location' => 'Vancouver, Canada',
            'title' => 'Simplified front-end workflow with Laravel Mix',
            'slides' => url('slides/phpmeetup-vancouver-2017.pdf'),
        ],
        [
            'conference' => 'WooCoomerce Meetup July 2016',
            'location' => 'Vancouver, Canada',
            'title' => 'Best practices with WooCommerce',
            'slides' => url('slides/woo-meetup.pdf'),
        ],
        [
            'conference' => 'WordCamp 2016',
            'location' => 'Vernon, Canada',
            'title' => 'What\'s new with Woo(Commerce)',
            'slides' => url('slides/new-with-woo.pdf'),
        ],
        [
            'conference' => 'WordPress Meetup 2015',
            'location' => 'Melbourne, Australia',
            'title' => 'Writing quality code & code reviews',
            'slides' => url('slides/wpmelbourne.pdf'),
        ],
        [
            'conference' => 'WordCamp 2014',
            'location' => 'Tokyo, Japan',
            'title' => 'WordPress as an Application Platform',
            'slides' => url('slides/wctokyo.pdf'),
        ],
        [
            'conference' => 'WordCamp 2014',
            'location' => 'Montreal, Canada',
            'title' => 'WordPress, APIs & You',
            'slides' => url('slides/wcmtl.pdf'),
        ],
        [
            'conference' => 'Developer WordPress Meetup June 2014',
            'location' => 'Vancouver, Canada',
            'title' => 'WordPress, APIs & Interacting with WordPress outside of WordPress',
            'slides' => url('slides/wcyvrdev.pdf'),
        ],
        [
            'conference' => 'WordCamp 2014',
            'location' => 'Ottawa, Canada',
            'title' => 'Interacting with WordPress outside of WordPress',
            'slides' => url('slides/wcottawa.pdf'),
        ],
        [
            'conference' => 'WordPress Meetup Dec 2013',
            'location' => 'Geneva, Switzerland',
            'title' => 'Plugin development 101',
            'slides' => url('slides/plugin-dev-101.pdf'),
        ],
        [
            'conference' => 'WordCamp 2013',
            'location' => 'Winnipeg, Canada',
            'title' => 'Plugin development 101',
            'slides' => url('slides/plugin-dev-101.pdf'),
        ],
        [
            'conference' => 'WordCamp 2013',
            'location' => 'Victoria, Canada',
            'title' => 'Plugin development 101',
            'slides' => url('slides/plugin-dev-101.pdf'),
        ],
        [
            'conference' => 'WordCamp 2012',
            'location' => 'Montreal, Canada',
            'title' => 'Becoming a better WordPress Developer',
            'slides' => url('slides/wcmtl2012.pdf'),
        ],
        [
            'conference' => 'WordPress meetup April 2012',
            'location' => 'Vancouver, Canada',
            'title' => 'Developing & Debugging with WordPress',
        ],
        [
            'conference' => 'WordCamp 2012',
            'location' => 'San Diego, CA, USA',
            'title' => 'Using git: workflow & best practices ',
        ],
        [
            'conference' => 'WordCamp 2011',
            'location' => 'Portland, OR, USA',
            'title' => 'Round table discussion on WordPress development tools',
        ],
        [
            'conference' => 'WordCamp 2011',
            'location' => 'Montreal, Canada',
            'title' => 'WordPress custom post types',
            'slides' => 'https://www.slideshare.net/slideshow/custom-post-types-in-depth-at-wordcamp-montreal/8556704',
        ],
    ];

    // Create structured data for events
    $events = array_map(function($conf) {
        return [
            '@type' => 'Event',
            'name' => $conf['conference'] . ': ' . $conf['title'],
            'location' => [
                '@type' => 'Place',
                'name' => $conf['location']
            ],
            'performer' => [
                '@type' => 'Person',
                'name' => 'Joey Kudish'
            ],
            'description' => $conf['title'],
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode'
        ];
    }, array_slice($conferences, 0, 5)); // Include first 5 events to avoid too much data

    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => $events
    ];
@endphp

<x-layout
    title="Speaking & Presentations"
    description="Conference talks, presentations, and workshops by Joey Kudish on software development, Laravel, WordPress, and AI automation."
    keywords="tech speaker, conference presentations, Laravel talks, WordPress presentations, software development talks, AI automation, WordCamp, PHP conferences"
    :structuredData="$structuredData"
>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">

                {{-- Hero Section matching homepage --}}
                <div class="relative px-6 sm:px-8 lg:px-10 py-16 lg:py-24 xl:py-32 bg-gradient-to-br from-white to-zinc-50/50 dark:from-zinc-900 dark:to-zinc-800">
                    <div class="absolute inset-0 bg-mesh-gradient opacity-30 dark:opacity-10"></div>
                    <div class="relative z-10">
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
                                    <span class="block text-gradient-primary mt-2">Sometimes, I give conference talks.</span>
                                </x-ui.typography>

                                <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    Over the years I've given a handful of presentations at various conferences.
                                    Below you can find slides and videos from some of them.
                                </p>

                                <div class="mt-8 flex flex-wrap gap-6 text-sm text-zinc-600 dark:text-zinc-400">
                                    <div class="flex items-center gap-2">
                                        <x-icon name="lucide-presentation" class="w-4 h-4 text-teal-600" />
                                        <span>{{ count($conferences) }} Presentations</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-icon name="lucide-globe" class="w-4 h-4 text-teal-600" />
                                        <span>5 Countries</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-icon name="lucide-calendar" class="w-4 h-4 text-teal-600" />
                                        <span>Since 2011</span>
                                    </div>
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
                                            alt="Joey Kudish - Speaker">
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Speaking Topics Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div class="max-w-3xl mx-auto text-center">
                        <x-ui.typography variant="h2">
                            Topics I Speak About
                        </x-ui.typography>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                            I enjoy sharing knowledge about software development, automation,<br class="hidden sm:inline">
                            and building products that scale.
                        </p>

                        <div class="mt-10 grid gap-6 grid-cols-1 sm:grid-cols-3">
                            <div class="p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                <x-icon name="lucide-code-2" class="w-8 h-8 text-emerald-600 dark:text-emerald-400 mx-auto mb-3" />
                                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Web Development</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Laravel, WordPress, modern PHP, and building scalable applications
                                </p>
                            </div>
                            <div class="p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                <x-icon name="lucide-zap" class="w-8 h-8 text-yellow-600 dark:text-yellow-400 mx-auto mb-3" />
                                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">AI & Automation</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Workflow automation, AI integration, coding with AI, and productivity tools
                                </p>
                            </div>
                            <div class="p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50">
                                <x-icon name="lucide-git-branch" class="w-8 h-8 text-purple-600 dark:text-purple-400 mx-auto mb-3" />
                                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Best Practices</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Code quality, development workflows, and team collaboration
                                </p>
                            </div>
                        </div>

                        <div class="mt-12">
                            <p class="text-zinc-600 dark:text-zinc-400 mb-6">
                                Interested in having me speak at your event?
                            </p>
                            <x-ui.gradient-button variant="primary" href="{{ route('contact', ['subject' => 'speaking']) }}" icon="true">
                                Get in Touch
                            </x-ui.gradient-button>
                        </div>
                    </div>
                </div>

                {{-- Conference Presentations Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-white dark:bg-zinc-900 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div>
                        <div class="flex items-center gap-4 mb-12">
                            <x-ui.typography variant="h2">
                                Conference Presentations
                            </x-ui.typography>
                            <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
                        </div>

                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            @foreach($conferences as $conference)
                                <div class="group relative rounded-xl border border-zinc-200/50 dark:border-zinc-700/40 p-6 bg-white dark:bg-zinc-900/50 hover:border-emerald-500/30 dark:hover:border-emerald-600/30 transition-all duration-200 hover:shadow-lg">
                                    {{-- Conference Title --}}
                                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-2">
                                        {{ data_get($conference, 'title') }}
                                    </h3>

                                    {{-- Conference Info --}}
                                    <div class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                                        <x-icon name="lucide-map-pin" class="w-4 h-4 text-zinc-400 dark:text-zinc-500" />
                                        <span>{{ data_get($conference, 'conference') }}</span>
                                        <span class="text-zinc-400 dark:text-zinc-500">•</span>
                                        <span>{{ data_get($conference, 'location') }}</span>
                                    </div>

                                    {{-- Download Link --}}
                                    @if(data_get($conference, 'slides'))
                                        <a
                                            href="{{ data_get($conference, 'slides') }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-2 text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors"
                                        >
                                            <x-icon name="lucide-download" class="w-4 h-4" />
                                            <span>Download Slides</span>
                                            <x-icon name="lucide-external-link" class="w-3 h-3 opacity-60" />
                                        </a>
                                    @else
                                        <span class="text-sm text-zinc-400 dark:text-zinc-500 italic">
                                            Slides not available
                                        </span>
                                    @endif

                                    {{-- Hover effect --}}
                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- About Me Section --}}
                <div class="px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20 bg-zinc-50/50 dark:bg-zinc-800/50 border-t border-zinc-200/30 dark:border-zinc-700/50">
                    <div class="max-w-4xl mx-auto">
                        <div class="text-center mb-10">
                            <x-ui.typography variant="h2">
                                Beyond the Stage
                            </x-ui.typography>
                        </div>
                        
                        <div class="grid gap-8 lg:grid-cols-2 items-center">
                            <div>
                                <p class="text-lg text-zinc-600 dark:text-zinc-400 leading-relaxed mb-6">
                                    When I'm not speaking at conferences, I'm a software developer and AI automation consultant 
                                    with 20+ years of experience building scalable web applications.
                                </p>
                                <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed mb-8">
                                    I specialize in Laravel, WordPress, and modern PHP development. I help businesses 
                                    automate their workflows, integrate AI into their products, and build software that scales.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <x-ui.gradient-button variant="primary" href="{{ route('services') }}" icon="true">
                                        Explore My Services
                                    </x-ui.gradient-button>
                                    <a href="{{ route('projects') }}"
                                       class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-emerald-600 px-4 py-2 text-sm font-semibold text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all dark:border-emerald-700 dark:text-emerald-700 dark:hover:bg-emerald-700 dark:hover:text-white">
                                        View My Work
                                    </a>
                                </div>
                            </div>
                            
                            <div class="lg:pl-12">
                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('services') }}#automation" class="group text-center p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50 hover:border-yellow-500/30 dark:hover:border-yellow-600/30 transition-all duration-200 hover:shadow-lg">
                                        <x-icon name="lucide-zap" class="w-8 h-8 mx-auto mb-3 text-yellow-600 dark:text-yellow-400 group-hover:scale-110 transition-transform" />
                                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Automation</h3>
                                    </a>
                                    
                                    <a href="{{ route('services') }}#audit" class="group text-center p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50 hover:border-purple-500/30 dark:hover:border-purple-600/30 transition-all duration-200 hover:shadow-lg">
                                        <x-icon name="lucide-file-text" class="w-8 h-8 mx-auto mb-3 text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform" />
                                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Code Audit</h3>
                                    </a>
                                    
                                    <a href="{{ route('services') }}#product" class="group text-center p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50 hover:border-emerald-500/30 dark:hover:border-emerald-600/30 transition-all duration-200 hover:shadow-lg">
                                        <x-icon name="lucide-code-2" class="w-8 h-8 mx-auto mb-3 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" />
                                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Product Build</h3>
                                    </a>
                                    
                                    <a href="{{ route('services') }}#partnership" class="group text-center p-6 rounded-xl bg-white dark:bg-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50 hover:border-cyan-500/30 dark:hover:border-cyan-600/30 transition-all duration-200 hover:shadow-lg">
                                        <x-icon name="lucide-sparkles" class="w-8 h-8 mx-auto mb-3 text-cyan-600 dark:text-cyan-400 group-hover:scale-110 transition-transform" />
                                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Partnership</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
