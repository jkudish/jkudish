@php
$achievements = [
    'at_scale' => [
        'title' => '🏢 At Scale',
        'items' => [
            'WordPress.com features used by millions',
            'WooCommerce Connect shipping integrations',
            'Analytics platform for thousands of stores',
        ],
    ],
    'for_clients' => [
        'title' => '💼 For Clients',
        'items' => [
            'Reduced Image Salon\'s processing time by 75%',
            'Multilingual dashboards serving 6,000+ photographers',
            'Complete business automation systems with AI',
        ],
    ],
    'for_myself' => [
        'title' => '🚀 For Myself',
        'items' => [
            'Multiple profitable SaaS products',
            'Currently launching 3 new indie projects',
            'The Maker Notes newsletter',
        ],
    ],
];
@endphp

<div class="mx-auto max-w-2xl lg:max-w-5xl">
    <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
        Things I've Built
    </h2>
    
    <div class="mt-8 grid gap-8 lg:grid-cols-3">
        @foreach($achievements as $category)
        <div>
            <h3 class="font-semibold text-lg text-zinc-900 dark:text-zinc-100">
                {{ $category['title'] }}
            </h3>
            
            <ul class="mt-4 space-y-2">
                @foreach($category['items'] as $item)
                <li class="flex gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <span class="text-teal-600 dark:text-teal-400">→</span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>