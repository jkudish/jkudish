@props([
    'variant' => 'primary',
    'padding' => 'p-[2px]',
    'rounded' => 'rounded-xl',
    'hover' => true
])

@php
    $gradientClasses = match($variant) {
        'primary' => 'bg-gradient-to-r from-gradient-cyan to-gradient-blue',
        'accent' => 'bg-gradient-to-r from-gradient-purple to-gradient-pink',
        'rainbow' => 'bg-gradient-rainbow',
        default => 'bg-gradient-to-r from-gradient-cyan to-gradient-blue'
    };
    
    $hoverClasses = $hover ? 'group hover:shadow-xl hover:shadow-gradient-blue/20 transition-all duration-300' : '';
@endphp

<div {{ $attributes->merge(['class' => "$padding $rounded $gradientClasses $hoverClasses"]) }}>
    <div class="h-full w-full bg-white dark:bg-zinc-900 {{ $rounded }}">
        {{ $slot }}
    </div>
</div>