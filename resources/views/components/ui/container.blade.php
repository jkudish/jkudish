@props([
    'size' => 'default',
    'padding' => true
])

@php
    $sizes = [
        'narrow' => 'max-w-3xl',
        'default' => 'max-w-7xl',
        'wide' => 'max-w-7xl',
        'full' => 'max-w-full',
    ];
    
    $paddingClass = $padding ? 'px-6 sm:px-8 lg:px-10' : '';
    
    $sizeClass = $sizes[$size] ?? $sizes['default'];
@endphp

<div {{ $attributes->merge(['class' => "mx-auto w-full {$sizeClass} {$paddingClass}"]) }}>
    {{ $slot }}
</div>