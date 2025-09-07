@props([
    'status' => 'active',
    'pulse' => true,
    'size' => 'sm'
])

@php
    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-1 text-sm',
        'md' => 'px-3 py-1.5 text-base',
        'lg' => 'px-4 py-2 text-lg',
        default => 'px-2.5 py-1 text-sm'
    };
    
    $statusClasses = match($status) {
        'active' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
        'completed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
        'error' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        'new' => 'bg-gradient-to-r from-gradient-purple to-gradient-pink text-white',
        default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300'
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-medium $sizeClasses $statusClasses"]) }}>
    @if($pulse && in_array($status, ['active', 'new']))
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                {{ $status === 'active' ? 'bg-green-400' : 'bg-gradient-purple' }}"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 
                {{ $status === 'active' ? 'bg-green-500' : 'bg-gradient-purple' }}"></span>
        </span>
    @endif
    {{ $slot }}
</span>