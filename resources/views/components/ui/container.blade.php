@props([
    'size' => 'default',
    'padding' => true
])

@php
    $sizes = [
        'narrow' => 'max-w-2xl',
        'default' => 'max-w-4xl lg:max-w-6xl xl:max-w-7xl',
        'wide' => 'max-w-5xl lg:max-w-7xl xl:max-w-screen-xl',
        'full' => 'max-w-full',
    ];
    
    $paddingClass = $padding ? 'px-4 sm:px-6 lg:px-8' : '';
    
    $sizeClass = $sizes[$size] ?? $sizes['default'];
@endphp

<div {{ $attributes->merge(['class' => "mx-auto w-full {$sizeClass} {$paddingClass}"]) }}>
    {{ $slot }}
</div>