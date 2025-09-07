@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'icon' => null
])

@php
    $baseClasses = 'group relative inline-flex items-center gap-2 justify-center rounded-xl px-6 py-3 text-sm font-semibold transition-all duration-300 overflow-hidden';
    
    $variantClasses = match($variant) {
        'primary' => 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white hover:shadow-xl hover:shadow-blue-500/25 hover:-translate-y-0.5',
        'secondary' => 'bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:shadow-xl hover:shadow-purple-500/25 hover:-translate-y-0.5',
        'outline' => 'border-2 border-zinc-300 dark:border-zinc-600 text-zinc-900 dark:text-zinc-100 hover:border-transparent relative',
        default => ''
    };
    
    $classes = $baseClasses . ' ' . $variantClasses;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($variant === 'outline')
            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        @endif
        <span class="relative z-10 flex items-center gap-2 {{ $variant === 'outline' ? 'group-hover:text-white' : '' }}">
            {{ $slot }}
            @if($icon)
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            @endif
        </span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($variant === 'outline')
            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        @endif
        <span class="relative z-10 flex items-center gap-2 {{ $variant === 'outline' ? 'group-hover:text-white' : '' }}">
            {{ $slot }}
            @if($icon)
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            @endif
        </span>
    </button>
@endif