@props([
    'padding' => true
])

<div {{ $attributes->merge(['class' => 'group relative flex flex-col items-start ' . ($padding ? 'p-6' : '')]) }}>
    {{ $slot }}
</div>