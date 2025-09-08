@php
$allCompanies = [
    [
        'name' => 'WooCommerce', 
        'logo' => url('img/companies/woo.png'),
        'class' => 'standard',
    ],
    [
        'name' => 'Automattic',
        'logo' => url('img/companies/automattic.png'),
        'class' => 'invert-light', // Needs inversion in light mode (dark logo)
    ],
    [
        'name' => 'WordPress VIP',
        'logo' => url('img/companies/wp-vip.png'),
        'class' => 'standard',
    ],
    [
        'name' => 'Pantheon',
        'logo' => url('img/companies/pantheon.png'),
        'class' => 'standard',
    ],
    [
        'name' => "Sotheby's",
        'logo' => url('img/companies/sothebys.png'),
        'class' => 'always-invert', // Always needs inversion (very dark logo)
    ],
    [
        'name' => 'Image Salon',
        'logo' => url('img/companies/image-salon.png'),
        'class' => 'image-salon', // Special handling for size and visibility
    ],
    [
        'name' => 'Metorik',
        'logo' => url('img/companies/metorik.png'),
        'class' => 'metorik', // Special handling to prevent gray square
    ],
    [
        'name' => 'PHAiTO',
        'logo' => url('img/companies/phaito.png'),
        'class' => 'standard',
    ],
    [
        'name' => 'DVLOP',
        'logo' => url('img/companies/dvlop.png'),
        'class' => 'colorful', // Colorful gradient logo
    ],
    [
        'name' => 'SmarterQueue',
        'logo' => url('img/companies/smarterqueue.png'),
        'class' => 'standard',
    ],
    [
        'name' => 'TELUS Health',
        'logo' => url('img/companies/telus-health.png'),
        'class' => 'colorful', // Purple and green logo
    ],
    [
        'name' => 'Turquoise Goat',
        'logo' => url('img/companies/turquoise-goat.png'),
        'class' => 'turquoise-goat', // Very light logo needs special handling
    ],
];

// Shuffle all companies and take 8
shuffle($allCompanies);
$companies = array_slice($allCompanies, 0, 8);
@endphp

<div>
    {{-- Section Header --}}
    <div class="text-center mb-8">
        <x-ui.typography variant="small" color="muted" weight="semibold" class="uppercase tracking-wider">
            Successful projects delivered for:
        </x-ui.typography>
    </div>
    
    {{-- Logo Grid --}}
    <div class="logo-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-zinc-200/50 dark:border-zinc-700/50 rounded-lg overflow-hidden">
        @foreach($companies as $company)
        <div class="relative bg-white/50 dark:bg-zinc-900/30 border-r border-b border-zinc-200/50 dark:border-zinc-700/50">
            <div class="flex items-center justify-center p-6 lg:p-8 h-[120px] lg:h-[140px]">
                @if($company['class'] === 'standard')
                    {{-- Standard logos that work well with default filters --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-10 lg:max-h-12 w-auto object-contain block mx-auto
                               grayscale opacity-60
                               dark:brightness-0 dark:invert dark:opacity-70"
                    />
                @elseif($company['class'] === 'invert-light')
                    {{-- Automattic - dark logo that needs special treatment --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-10 lg:max-h-12 w-auto object-contain block mx-auto
                               invert grayscale opacity-60
                               dark:invert-0 dark:brightness-200 dark:grayscale dark:opacity-70"
                    />
                @elseif($company['class'] === 'always-invert')
                    {{-- Sotheby's - very dark logo, always needs inversion --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-10 lg:max-h-12 w-auto object-contain block mx-auto
                               invert grayscale opacity-60
                               dark:invert dark:grayscale dark:opacity-70"
                    />
                @elseif($company['class'] === 'image-salon')
                    {{-- Image Salon - gold logo, needs special handling --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-14 lg:max-h-16 w-auto object-contain block mx-auto
                               grayscale brightness-50 opacity-100
                               dark:brightness-0 dark:invert dark:opacity-70"
                    />
                @elseif($company['class'] === 'metorik')
                    {{-- Metorik - colorful logo with black text, needs careful filtering --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-10 lg:max-h-12 w-auto object-contain block mx-auto
                               grayscale brightness-75 opacity-70
                               dark:invert dark:grayscale dark:opacity-70"
                    />
                @elseif($company['class'] === 'colorful')
                    {{-- Colorful logos like DVLOP and TELUS Health --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-10 lg:max-h-12 w-auto object-contain block mx-auto
                               grayscale opacity-70
                               dark:grayscale dark:brightness-150 dark:opacity-90"
                    />
                @elseif($company['class'] === 'turquoise-goat')
                    {{-- Turquoise Goat - very light logo needs strong treatment and larger size --}}
                    <img 
                        src="{{ $company['logo'] }}" 
                        alt="{{ $company['name'] }}"
                        loading="lazy"
                        class="max-h-16 lg:max-h-20 w-auto object-contain block mx-auto
                               invert grayscale opacity-60
                               dark:invert-0 dark:brightness-200 dark:grayscale dark:opacity-70"
                    />
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- Additional copy about other clients --}}
    <div class="mt-8 text-center">
        <x-ui.typography variant="small" color="muted">
            Plus dozens of startups, agencies, and innovative companies across e-commerce and SaaS industries
        </x-ui.typography>
    </div>
</div>