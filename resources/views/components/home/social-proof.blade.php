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
        'label' => 'First WordPress Core Commit',
        'description' => 'Contributing to open source for 13+ years'
    ],
    [
        'value' => '4-to-1',
        'label' => 'Efficiency Multiplier',
        'description' => 'My automation track record'
    ],
];

$testimonials = [
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
];
@endphp

<div>
    <div class="text-center">
        <x-ui.typography variant="h2">
            Proven Track Record
        </x-ui.typography>
        <p class="mt-4 text-lg font-sans text-zinc-600 dark:text-zinc-400">
            Building successful software for over a decade
        </p>
    </div>

    {{-- Metrics Grid --}}
    <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
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

    {{-- Client Testimonials --}}
    <div class="mt-16 grid gap-8 lg:grid-cols-2">
        @foreach($testimonials as $testimonial)
        <x-ui.gradient-border variant="primary" hover="false" padding="p-[1px]">
            <div class="p-6">
                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-700 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                </svg>
                <blockquote class="mt-4 font-sans text-zinc-600 dark:text-zinc-400">
                    "{{ $testimonial['quote'] }}"
                </blockquote>
                <div class="mt-4 flex items-center gap-3">
                    @if(isset($testimonial['avatar']))
                    <img src="{{ $testimonial['avatar'] }}"
                         alt="{{ $testimonial['author'] }}"
                         class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-zinc-800 shadow-sm">
                    @endif
                    <div class="flex-1">
                        <div class="text-sm font-sans font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ $testimonial['author'] }}
                        </div>
                        <div class="text-xs font-sans text-zinc-600 dark:text-zinc-400">
                            {{ $testimonial['company'] }}
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.gradient-border>
        @endforeach
    </div>

    {{-- Client Logos --}}
    <div class="mt-16">
        <div class="text-center mb-8">
            <x-ui.typography variant="small" color="muted" weight="semibold" class="uppercase tracking-wider">
                Successful projects delivered for:
            </x-ui.typography>
        </div>

        @php
        $allCompanies = [
            ['name' => 'WooCommerce', 'logo' => url('img/companies/woo.png'), 'class' => 'standard'],
            ['name' => 'Automattic', 'logo' => url('img/companies/automattic.png'), 'class' => 'invert-light'],
            ['name' => 'WordPress VIP', 'logo' => url('img/companies/wp-vip.png'), 'class' => 'standard'],
            ['name' => 'Pantheon', 'logo' => url('img/companies/pantheon.png'), 'class' => 'standard'],
            ['name' => "Sotheby's", 'logo' => url('img/companies/sothebys.png'), 'class' => 'always-invert'],
            ['name' => 'Image Salon', 'logo' => url('img/companies/image-salon.png'), 'class' => 'image-salon'],
            ['name' => 'Metorik', 'logo' => url('img/companies/metorik.png'), 'class' => 'metorik'],
            ['name' => 'PHAiTO', 'logo' => url('img/companies/phaito.png'), 'class' => 'standard'],
            ['name' => 'DVLOP', 'logo' => url('img/companies/dvlop.png'), 'class' => 'colorful'],
            ['name' => 'SmarterQueue', 'logo' => url('img/companies/smarterqueue.png'), 'class' => 'standard'],
            ['name' => 'TELUS Health', 'logo' => url('img/companies/telus-health.png'), 'class' => 'colorful'],
            ['name' => 'Turquoise Goat', 'logo' => url('img/companies/turquoise-goat.png'), 'class' => 'turquoise-goat'],
        ];

        // Shuffle all companies and take 8
        shuffle($allCompanies);
        $companies = array_slice($allCompanies, 0, 8);
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-zinc-200/50 dark:border-zinc-700/50 rounded-lg overflow-hidden">
            @foreach($companies as $company)
            <div class="relative bg-white/50 dark:bg-zinc-900/30 border-r border-b border-zinc-200/50 dark:border-zinc-700/50">
                <div class="flex items-center justify-center p-6 h-[120px]">
                    @if($company['class'] === 'standard')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-10 w-auto object-contain grayscale opacity-60 dark:brightness-0 dark:invert dark:opacity-70" />
                    @elseif($company['class'] === 'invert-light')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-10 w-auto object-contain invert grayscale opacity-60 dark:invert-0 dark:brightness-200 dark:grayscale dark:opacity-70" />
                    @elseif($company['class'] === 'always-invert')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-10 w-auto object-contain invert grayscale opacity-60 dark:invert dark:grayscale dark:opacity-70" />
                    @elseif($company['class'] === 'image-salon')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-14 w-auto object-contain grayscale brightness-50 opacity-100 dark:brightness-0 dark:invert dark:opacity-70" />
                    @elseif($company['class'] === 'metorik')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-10 w-auto object-contain grayscale brightness-75 opacity-70 dark:invert dark:grayscale dark:opacity-70" />
                    @elseif($company['class'] === 'colorful')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-10 w-auto object-contain grayscale opacity-70 dark:grayscale dark:brightness-150 dark:opacity-90" />
                    @elseif($company['class'] === 'turquoise-goat')
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" loading="lazy" class="max-h-16 w-auto object-contain invert grayscale opacity-60 dark:invert-0 dark:brightness-200 dark:grayscale dark:opacity-70" />
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <x-ui.typography variant="small" color="muted">
                Plus dozens of startups, agencies, and innovative companies across e-commerce and SaaS industries
            </x-ui.typography>
        </div>
    </div>
</div>
