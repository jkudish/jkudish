@props([
    'type' => 'text',
    'lines' => 3,
    'rounded' => 'rounded-md'
])

@php
    $baseClasses = 'animate-pulse bg-gradient-to-r from-zinc-200 via-zinc-300 to-zinc-200 dark:from-zinc-700 dark:via-zinc-600 dark:to-zinc-700 bg-[length:200%_100%]';
@endphp

@switch($type)
    @case('text')
        <div class="space-y-2">
            @for($i = 0; $i < $lines; $i++)
                <div class="{{ $baseClasses }} h-4 {{ $rounded }} {{ $i === $lines - 1 ? 'w-3/4' : 'w-full' }}"></div>
            @endfor
        </div>
        @break
        
    @case('card')
        <div class="{{ $baseClasses }} {{ $rounded }} p-6">
            <div class="space-y-4">
                <div class="h-4 bg-white/20 dark:bg-zinc-800/20 rounded w-3/4"></div>
                <div class="space-y-2">
                    <div class="h-3 bg-white/20 dark:bg-zinc-800/20 rounded"></div>
                    <div class="h-3 bg-white/20 dark:bg-zinc-800/20 rounded"></div>
                    <div class="h-3 bg-white/20 dark:bg-zinc-800/20 rounded w-5/6"></div>
                </div>
            </div>
        </div>
        @break
        
    @case('image')
        <div class="{{ $baseClasses }} aspect-video {{ $rounded }}"></div>
        @break
        
    @case('avatar')
        <div class="{{ $baseClasses }} w-12 h-12 rounded-full"></div>
        @break
        
    @case('button')
        <div class="{{ $baseClasses }} h-10 w-32 {{ $rounded }}"></div>
        @break
        
    @default
        <div {{ $attributes->merge(['class' => "$baseClasses $rounded"]) }}>
            {{ $slot }}
        </div>
@endswitch