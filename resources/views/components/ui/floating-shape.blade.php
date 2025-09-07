@props([
    'shape' => 'circle',
    'size' => 'w-64 h-64',
    'color' => 'primary',
    'position' => 'top-20 right-20',
    'animation' => 'float',
    'blur' => 'blur-3xl',
    'opacity' => 'opacity-20'
])

@php
    $shapeClasses = match($shape) {
        'circle' => 'rounded-full',
        'square' => 'rounded-3xl rotate-45',
        'blob' => 'rounded-full',
        default => 'rounded-full'
    };
    
    $colorClasses = match($color) {
        'primary' => 'bg-gradient-primary',
        'accent' => 'bg-gradient-accent',
        'cyan' => 'bg-gradient-cyan',
        'purple' => 'bg-gradient-purple',
        default => 'bg-gradient-primary'
    };
    
    $animationClass = match($animation) {
        'float' => 'animate-float',
        'pulse' => 'animate-pulse',
        'spin' => 'animate-spin-slow',
        'none' => '',
        default => 'animate-float'
    };
@endphp

<div {{ $attributes->merge(['class' => "absolute $position $size $shapeClasses $colorClasses $blur $opacity $animationClass pointer-events-none"]) }}></div>