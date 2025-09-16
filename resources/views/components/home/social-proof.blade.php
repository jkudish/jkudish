@php
$metrics = [
    [
        'value' => '18+',
        'label' => 'Years Experience',
        'description' => 'Building software since 2006'
    ],
    [
        'value' => '100+',
        'label' => 'Projects Shipped',
        'description' => 'From WordPress plugins to enterprise SaaS'
    ],
    [
        'value' => '2011',
        'label' => 'First WordPress Contribution',
        'description' => 'Contributing to open source for 13+ years'
    ],
];

$testimonials = [
    [
        'quote' => "I've worked with Joey for more then a decade, and he's a reliable and skilled developer that elevates any team he's on. His knowledge of Laravel and WordPress runs deep, and he consistently finds solutions to even the toughest problems that come up. I've yet to see him shy away from a challenge.",
        'author' => 'Bryce Adams',
        'company' => 'Founder, Metorik',
        'avatar' => asset('img/testimonials/bryce-adams.jpg')
    ],
    [
        'quote' => "Joey's hard-work ethic and determination is what makes him an extremely successful individual. I'm constantly amazed at his ability to get things done. I will definitely work with Joey again.",
        'author' => 'Greg Isenberg',
        'company' => 'CEO, Late Checkout',
        'avatar' => asset('img/testimonials/greg-isenberg.jpg'),
        'twitter' => 'https://x.com/gregisenberg'
    ],
    [
        'quote' => "Joey was one of the most consistently talented and reliable people I've ever worked with. Outstanding skills and fiercely committed to project success. I couldn't recommend anyone higher.",
        'author' => 'Justin Evans',
        'company' => 'Partner, Sunroom.is',
        'avatar' => asset('img/testimonials/justin-evans.jpg')
    ],
    [
        'quote' => "I've had the pleasure of working with Joey on several coding contracts over the years. He's a great communicator, highly efficient, and brings an impressive skill set to the table. I definitely recommend Joey for your coding project.",
        'author' => 'Jill Binder',
        'company' => 'Leader of the Diversity in WordPress group',
        'avatar' => asset('img/testimonials/jill-binder.jpg')
    ],
    [
        'quote' => "Joey is a rockstar engineer. He took my description for a customized software licensing system, and quickly turned it into a fully functional web site and service. He is personable, responsive, very organized, and a great problem solver. I highly recommend him for any engineering projects.",
        'author' => 'John Wu',
        'company' => 'Founder at John Wu Presents',
        'avatar' => asset('img/testimonials/john-wu.jpg')
    ],
];
@endphp

<div>
    <div class="text-center">
        <x-ui.typography variant="h2">
            Proven Track Record
        </x-ui.typography>
        <p class="mt-4 text-lg font-sans text-zinc-600 dark:text-zinc-400">
            For nearly two decades, building successful software has been my focus.
        </p>
    </div>

    {{-- Metrics Grid --}}
    <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-3">
        @foreach($metrics as $metric)
        <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-700">
                {{ $metric['value'] }}
            </div>
            <div class="mt-2 text-sm font-sans font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $metric['label'] }}
            </div>
            <div class="mt-1 text-xs font-sans text-zinc-600 dark:text-zinc-400">
                {{ $metric['description'] }}
            </div>
        </div>
        @endforeach
    </div>

    {{-- Client Testimonials Carousel --}}
    <div class="mt-16 relative"
         x-data="{
             currentIndex: 0,
             testimonials: {{ json_encode($testimonials) }},
             visibleTestimonials: [],
             init() {
                 this.updateVisibleTestimonials();
                 document.addEventListener('keydown', (e) => {
                     if (e.key === 'ArrowLeft') this.prev();
                     if (e.key === 'ArrowRight') this.next();
                 });
                 window.addEventListener('resize', () => this.updateVisibleTestimonials());
             },
             updateVisibleTestimonials() {
                 const isMobile = window.innerWidth < 768; // md breakpoint
                 const count = isMobile ? 1 : 2;
                 const indices = [];
                 for (let i = 0; i < count; i++) {
                     indices.push((this.currentIndex + i) % this.testimonials.length);
                 }
                 this.visibleTestimonials = indices.map(i => this.testimonials[i]);
             },
             next() {
                 const isMobile = window.innerWidth < 768;
                 const step = isMobile ? 1 : 2;
                 this.currentIndex = (this.currentIndex + step) % this.testimonials.length;
                 this.updateVisibleTestimonials();
             },
             prev() {
                 const isMobile = window.innerWidth < 768;
                 const step = isMobile ? 1 : 2;
                 this.currentIndex = (this.currentIndex - step + this.testimonials.length) % this.testimonials.length;
                 this.updateVisibleTestimonials();
             }
         }"
         role="region"
         aria-label="Customer testimonials"
         aria-roledescription="carousel">

        {{-- Carousel Container --}}
        <div class="overflow-hidden mx-8 sm:mx-16">
            <div class="flex gap-4 sm:gap-8 transition-all duration-300 ease-in-out">
                <template x-for="testimonial in visibleTestimonials" :key="testimonial.author">
                    <div class="flex-none w-full md:w-1/2" :style="window.innerWidth >= 768 ? 'width: calc(50% - 1rem);' : 'width: 100%;'">
                        <x-ui.gradient-border variant="primary" hover="false" padding="p-[1px]" class="h-full">
                            <div class="p-6 h-full flex flex-col">
                                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-700 opacity-20 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                </svg>
                                <blockquote class="mt-4 font-sans text-zinc-600 dark:text-zinc-400 flex-grow min-h-[120px]" x-text="`&quot;${testimonial.quote}&quot;`">
                                </blockquote>
                                <div class="mt-4 flex items-center gap-3 flex-shrink-0">
                                    <template x-if="testimonial.avatar">
                                        <picture>
                                            <source :srcset="testimonial.avatar.replace('.jpg', '.webp')" type="image/webp">
                                            <img :src="testimonial.avatar"
                                                 :alt="testimonial.author"
                                                 class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-zinc-800 shadow-sm">
                                        </picture>
                                    </template>
                                    <div class="flex-1">
                                        <div class="text-sm font-sans font-semibold text-zinc-900 dark:text-zinc-100" x-text="testimonial.author">
                                        </div>
                                        <div class="text-xs font-sans text-zinc-600 dark:text-zinc-400" x-text="testimonial.company">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-ui.gradient-border>
                    </div>
                </template>
            </div>
        </div>

        {{-- Navigation Arrows --}}
        <button @click="prev()"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white dark:bg-zinc-800 rounded-full p-1 sm:p-2 shadow-lg transition hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:scale-110 cursor-pointer"
                aria-label="Previous testimonials">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-zinc-600 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button @click="next()"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white dark:bg-zinc-800 rounded-full p-1 sm:p-2 shadow-lg transition hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:scale-110 cursor-pointer"
                aria-label="Next testimonials">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-zinc-600 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

    </div>

    {{-- Client Logos --}}
    <div class="mt-16">
        <x-home.client-logos />
    </div>
</div>
