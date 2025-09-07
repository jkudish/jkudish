@props([
    'span' => 'col-span-1',
    'variant' => 'default',
    'hover' => true,
    'padding' => 'p-6'
])

@php
    $baseClasses = 'rounded-2xl transition-all duration-300';
    
    $variantClasses = match($variant) {
        'gradient' => 'bg-gradient-to-br from-gradient-cyan/5 to-gradient-blue/5 border border-gradient-cyan/20',
        'bordered' => 'bg-white dark:bg-zinc-900 border-2 border-zinc-200 dark:border-zinc-800',
        'elevated' => 'bg-white dark:bg-zinc-900 shadow-lg',
        'glass' => 'bg-white/5 dark:bg-zinc-900/5 backdrop-blur-lg border border-white/10 dark:border-zinc-800/50',
        default => 'bg-zinc-50 dark:bg-zinc-900/50'
    };
    
    $hoverClasses = $hover ? 'hover:scale-[1.02] hover:shadow-xl hover:shadow-gradient-blue/10' : '';
@endphp

<div {{ $attributes->merge(['class' => "$span $baseClasses $variantClasses $hoverClasses $padding"]) }}>
    {{ $slot }}
</div>