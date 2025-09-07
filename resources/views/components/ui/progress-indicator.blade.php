@props([
    'progress' => 0,
    'variant' => 'default',
    'size' => 'md',
    'animated' => false,
    'showLabel' => false
])

@php
    $sizeClasses = match($size) {
        'sm' => 'h-1',
        'md' => 'h-2',
        'lg' => 'h-3',
        'xl' => 'h-4',
        default => 'h-2'
    };
    
    $progressClasses = match($variant) {
        'gradient' => 'bg-gradient-to-r from-gradient-cyan to-gradient-blue',
        'accent' => 'bg-gradient-to-r from-gradient-purple to-gradient-pink',
        'success' => 'bg-green-500',
        'warning' => 'bg-yellow-500',
        'danger' => 'bg-red-500',
        default => 'bg-blue-500'
    };
    
    $animationClass = $animated ? 'animate-pulse' : '';
@endphp

<div {{ $attributes->merge(['class' => 'relative']) }}>
    @if($showLabel)
        <div class="flex justify-between mb-1">
            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $slot }}</span>
            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $progress }}%</span>
        </div>
    @endif
    
    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden {{ $sizeClasses }}">
        <div class="{{ $progressClasses }} {{ $sizeClasses }} {{ $animationClass }} rounded-full transition-all duration-500 ease-out"
             style="width: {{ $progress }}%">
            @if($variant === 'gradient' || $variant === 'accent')
                <div class="h-full w-full bg-white/20 animate-gradient-shift bg-[length:200%_100%]"></div>
            @endif
        </div>
    </div>
</div>