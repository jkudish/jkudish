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
            'title' => 'What’s new with Woo(Commerce)',
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
    ]
@endphp

<x-layout>

    <div class="mt-12 px-8">
        <div class="flex flex-col md:flex-row">
            <picture class="flex-none mr-6">
                <source srcset="{{ url('img/joey.webp') }}" type="image/webp">
                <source srcset="{{ url('img/joey.png') }}" type="image/png">
                <img
                    src="data:image/png;base64,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"
                    class="mx-auto h-48 w-48 rounded-full"
                    loading="lazy"
                    alt="Joey Kudish">
            </picture>
            <h1 class="mt-4 shrink mx-auto max-w-xl text-xl font-title tracking-tight leading-6 sm:leading-8 text-zinc-800 sm:text-2xl dark:text-zinc-100">
                Hey, I'm Joey 👋 <br/> Over the years I've given a handful of presentations
                at
                various conferences. Below you can find slides and videos from some of them.
            </h1>
        </div>

        <div class="mt-12 space-y-8">
            @foreach($conferences as $conference)
                <article class="group relative flex flex-col items-start">
                    <h3 class="text-base font-semibold tracking-tight text-zinc-800 dark:text-zinc-100">
                        <div
                            class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl dark:bg-zinc-800/50"></div>
                        @if(data_get($conference, 'slides', data_get($conference, 'teaser')))
                            <a target="_blank" href="{{ data_get($conference, 'slides', data_get($conference, 'teaser')) }}">@endif<span
                                    class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span><span
                                    class="relative z-10">{{ data_get($conference, 'title') }}</span>@if(data_get($conference, 'slides', data_get($conference, 'teaser')))
                            </a>
                        @endif
                    </h3>
                    <p class="relative z-10 order-first mb-2 flex items-center text-sm text-zinc-400 dark:text-zinc-500 pl-3.5">
                <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true"><span
                        class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span></span>{{ data_get($conference, 'conference') }} &mdash; {{ data_get($conference, 'location') }}
                    </p>
                    @if(data_get($conference, 'slides'))
                        <div aria-hidden="true"
                             class="relative z-10 mt-2 flex items-center text-sm font-medium text-teal-500">Download
                            Slides
                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"
                                 class="ml-1 h-4 w-4 stroke-current transition-transform group-hover:translate-x-1">
                                <path d="M6.75 5.75 9.25 8l-2.5 2.25" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    @endif
                    @if(data_get($conference, 'teaser'))
                        <div aria-hidden="true"
                             class="relative z-10 mt-2 flex items-center text-sm font-medium text-indigo-500">View Upcoming Talk
                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"
                                 class="ml-1 h-4 w-4 stroke-current transition-transform group-hover:translate-x-1">
                                <path d="M6.75 5.75 9.25 8l-2.5 2.25" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>

    </div>
</x-layout>
