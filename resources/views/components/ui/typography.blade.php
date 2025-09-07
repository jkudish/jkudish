@props([
    'variant' => 'body',
    'size' => 'default',
    'color' => 'default',
    'weight' => 'default',
    'as' => null
])

@php
    $variants = [
        'h1' => [
            'tag' => 'h1',
            'class' => 'text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight'
        ],
        'h2' => [
            'tag' => 'h2',
            'class' => 'text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight'
        ],
        'h3' => [
            'tag' => 'h3',
            'class' => 'text-xl sm:text-2xl font-semibold'
        ],
        'h4' => [
            'tag' => 'h4',
            'class' => 'text-lg sm:text-xl font-semibold'
        ],
        'lead' => [
            'tag' => 'p',
            'class' => 'text-lg sm:text-xl leading-relaxed'
        ],
        'body' => [
            'tag' => 'p',
            'class' => 'text-base'
        ],
        'small' => [
            'tag' => 'p',
            'class' => 'text-sm'
        ],
        'caption' => [
            'tag' => 'p',
            'class' => 'text-xs'
        ],
    ];
    
    $colors = [
        'default' => 'text-zinc-900 dark:text-zinc-100',
        'muted' => 'text-zinc-600 dark:text-zinc-400',
        'light' => 'text-zinc-500 dark:text-zinc-500',
        'primary' => 'text-teal-600 dark:text-teal-400',
        'gradient' => 'text-gradient-primary',
        'white' => 'text-white',
    ];
    
    $weights = [
        'default' => '',
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
    ];
    
    $variantConfig = $variants[$variant] ?? $variants['body'];
    $tag = $as ?? $variantConfig['tag'];
    $baseClass = $variantConfig['class'];
    $colorClass = $colors[$color] ?? $colors['default'];
    $weightClass = $weights[$weight] ?? '';
    
    $classes = trim("$baseClass $colorClass $weightClass");
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>