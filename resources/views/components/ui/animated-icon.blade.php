@props([
    'icon' => 'arrow-right',
    'size' => 'w-6 h-6',
    'animation' => 'hover',
    'color' => 'currentColor'
])

@php
    $animationClasses = match($animation) {
        'hover' => 'group-hover:translate-x-1 transition-transform duration-200',
        'bounce' => 'animate-bounce',
        'spin' => 'animate-spin',
        'pulse' => 'animate-pulse',
        'float' => 'animate-float',
        'none' => '',
        default => ''
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-block $size $animationClasses"]) }}>
    @switch($icon)
        @case('arrow-right')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            @break
            
        @case('arrow-down')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            @break
            
        @case('sparkles')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            @break
            
        @case('code')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
            @break
            
        @case('rocket')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            @break
            
        @case('star')
            <svg class="{{ $size }}" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            @break
            
        @default
            {{ $slot }}
    @endswitch
</span>