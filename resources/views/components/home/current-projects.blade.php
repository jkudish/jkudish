@php
$projects = [
    [
        'name' => 'PHAiTO',
        'logo' => url('img/companies/phaito.png'),
        'logo_size' => 'medium',
        'logo_filter' => 'grayscale',
        'show_title' => false,
        'description' => 'Lightroom AI that actually understands photography. Edit entire catalogs in minutes, not hours.',
        'status' => 'launched',
        'status_label' => 'Recently Launched',
        'status_icon' => 'lucide-check-circle',
        'url' => 'https://phaito.com',
        'external' => true,
    ],
    [
        'name' => 'Tether',
        'logo' => url('img/tether.png'),
        'logo_size' => 'large',
        'show_title' => false,
        'description' => 'Get SMS verification codes anywhere. No SIM card required.',
        'status' => 'building',
        'status_label' => 'Building in public',
        'status_icon' => 'lucide-smartphone',
        'url' => 'https://tethermobile.com',
        'external' => true,
    ],
    [
        'name' => 'Human in the Loop',
        'icon' => 'lucide-mail',
        'icon_size' => 'large',
        'show_title' => true,
        'description' => 'Monthly-ish dispatch: AI experiments, automation workflows, indie hacking lessons, and the best links I find online.',
        'status' => 'live',
        'status_label' => 'Monthly-ish issues',
        'status_icon' => 'lucide-rocket',
        'url' => route('newsletter'),
        'external' => false,
    ],
];
@endphp

<div>
    <div class="flex items-center gap-4 mb-8">
        <x-ui.typography variant="h2">
            What I'm Building Right Now
        </x-ui.typography>
        <div class="flex-1 h-px bg-gradient-to-r from-zinc-200 to-transparent dark:from-zinc-700"></div>
    </div>
    
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
        <a 
            href="{{ $project['url'] }}"
            @if($project['external'])
                target="_blank"
                rel="noopener noreferrer"
            @endif
            class="no-underline group relative flex flex-col rounded-2xl border border-zinc-200/50 p-6 hover:border-emerald-500/30 dark:border-zinc-700/40 dark:hover:border-emerald-600/30 transition-all duration-200 hover:-translate-y-1 hover:shadow-lg bg-white dark:bg-zinc-900/50 shadow-sm"
        >
            {{-- Logo/Icon Display - Fixed height container --}}
            <div class="h-20 flex items-center mb-4">
                @if(isset($project['logo']))
                    @php
                        $logoClasses = match($project['logo_size'] ?? 'medium') {
                            'large' => 'h-14 w-auto',  // Reduced from h-16
                            'medium' => 'h-11 w-auto',  // Reduced from h-12
                            default => 'h-11 w-auto'
                        };
                        if (isset($project['logo_filter']) && $project['logo_filter'] === 'grayscale') {
                            $logoClasses .= ' grayscale opacity-70 dark:brightness-0 dark:invert';
                        }
                    @endphp
                    <img src="{{ $project['logo'] }}" alt="{{ $project['name'] }}" class="{{ $logoClasses }} object-contain">
                @elseif(isset($project['icon']))
                    @php
                        $iconSize = $project['icon_size'] ?? 'medium';
                        $iconClasses = match($iconSize) {
                            'large' => 'w-8 h-8',  // Increased from w-6 h-6
                            default => 'w-6 h-6'
                        };
                        $iconPadding = match($iconSize) {
                            'large' => 'p-3',  // Increased padding
                            default => 'p-2.5'
                        };
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-lg blur-lg opacity-[0.015]"></div>
                            <div class="relative bg-white/10 dark:bg-zinc-800/50 backdrop-blur-sm {{ $iconPadding }} rounded-lg border border-white/20 dark:border-zinc-700/50">
                                <x-icon name="{{ $project['icon'] }}" class="{{ $iconClasses }} text-teal-600 dark:text-teal-400" />
                            </div>
                        </div>
                        @if($project['show_title'])
                            <x-ui.typography variant="h4">
                                {{ $project['name'] }}
                            </x-ui.typography>
                        @endif
                    </div>
                @endif
            </div>
            
            {{-- Title (if not already shown with icon) --}}
            @if(!isset($project['icon']) && $project['show_title'])
                <x-ui.typography variant="h4" class="mb-2">
                    {{ $project['name'] }}
                </x-ui.typography>
            @endif
            
            {{-- Description - flex-grow to push status badge to bottom --}}
            <p class="text-sm font-sans text-gray-600 dark:text-zinc-400 flex-grow">
                {{ $project['description'] }}
            </p>
            
            {{-- Status Badge - Always at bottom --}}
            <div class="mt-4">
                @php
                    $statusClasses = match($project['status']) {
                        'building' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 border border-purple-200/50 dark:border-purple-700/30',
                        'coming_soon' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200/50 dark:border-blue-700/30',
                        'launched' => 'bg-green-100 text-green-800 dark:bg-emerald-900/30 dark:text-emerald-300 border border-green-200/50 dark:border-emerald-700/30',
                        'live' => 'bg-green-100 text-green-800 dark:bg-emerald-900/30 dark:text-emerald-300 border border-green-200/50 dark:border-emerald-700/30',
                        default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800/30 dark:text-zinc-300 border border-zinc-200/50 dark:border-zinc-700/30'
                    };
                @endphp
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                    <x-icon name="{{ $project['status_icon'] }}" class="w-3.5 h-3.5" />
                    {{ $project['status_label'] }}
                </span>
            </div>
            
            {{-- External Link Indicator --}}
            @if($project['external'])
                <x-icon name="lucide-external-link" class="absolute top-4 right-4 w-4 h-4 text-zinc-400 dark:text-zinc-500" />
            @endif
        </a>
        @endforeach
    </div>
</div>
