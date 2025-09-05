@props([
    'background' => 'none',
    'spacing' => 'normal',
    'container' => true,
    'containerSize' => 'default'
])

@php
    $backgrounds = [
        'none' => '',
        'white' => 'bg-white dark:bg-zinc-900',
        'gray' => 'bg-zinc-50 dark:bg-zinc-900/50',
        'frost' => 'bg-white/80 backdrop-blur-xl dark:bg-zinc-900/80 dark:backdrop-blur-xl',
        'gradient' => 'bg-gradient-to-br from-zinc-50 via-white to-zinc-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900',
        'gradient-mesh' => 'bg-gradient-to-br from-teal-50 via-white to-zinc-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-teal-950/20',
        'dark' => 'bg-zinc-900 dark:bg-black',
        'pattern' => 'bg-white dark:bg-zinc-900 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] dark:bg-[radial-gradient(#27272a_1px,transparent_1px)] bg-[size:20px_20px]',
    ];
    
    $spacings = [
        'none' => '',
        'small' => 'py-8 lg:py-12',
        'normal' => 'py-12 lg:py-16 xl:py-20',
        'large' => 'py-16 lg:py-24 xl:py-32',
    ];
    
    $backgroundClass = $backgrounds[$background] ?? '';
    $spacingClass = $spacings[$spacing] ?? $spacings['normal'];
@endphp

<section {{ $attributes->merge(['class' => "relative {$backgroundClass} {$spacingClass}"]) }}>
    @if($container)
        <x-ui.container :size="$containerSize">
            {{ $slot }}
        </x-ui.container>
    @else
        {{ $slot }}
    @endif
</section>