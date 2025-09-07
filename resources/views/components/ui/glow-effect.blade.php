@props([
    'color' => 'blue',
    'intensity' => 'medium',
    'animate' => false
])

@php
    $glowClasses = match($color) {
        'blue' => match($intensity) {
            'light' => 'shadow-lg shadow-blue-500/20',
            'medium' => 'shadow-xl shadow-blue-500/30',
            'strong' => 'shadow-2xl shadow-blue-500/40',
            default => 'shadow-xl shadow-blue-500/30'
        },
        'purple' => match($intensity) {
            'light' => 'shadow-lg shadow-purple-500/20',
            'medium' => 'shadow-xl shadow-purple-500/30',
            'strong' => 'shadow-2xl shadow-purple-500/40',
            default => 'shadow-xl shadow-purple-500/30'
        },
        'cyan' => match($intensity) {
            'light' => 'shadow-lg shadow-cyan-500/20',
            'medium' => 'shadow-xl shadow-cyan-500/30',
            'strong' => 'shadow-2xl shadow-cyan-500/40',
            default => 'shadow-xl shadow-cyan-500/30'
        },
        'pink' => match($intensity) {
            'light' => 'shadow-lg shadow-pink-500/20',
            'medium' => 'shadow-xl shadow-pink-500/30',
            'strong' => 'shadow-2xl shadow-pink-500/40',
            default => 'shadow-xl shadow-pink-500/30'
        },
        default => 'shadow-xl shadow-blue-500/30'
    };
    
    $animationClass = $animate ? 'animate-glow-pulse' : '';
@endphp

<div {{ $attributes->merge(['class' => "$glowClasses $animationClass transition-shadow duration-300"]) }}>
    {{ $slot }}
</div>