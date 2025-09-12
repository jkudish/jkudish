@php
$benefits = [
    'Real insights from building indie projects',
    'AI automation workflows that actually work',
    'Laravel/WordPress tips from 15 years of experience',
    'Business lessons from the trenches',
];
@endphp

<div class="mx-auto max-w-2xl lg:max-w-5xl">
    <div class="rounded-2xl bg-zinc-50 px-6 py-16 sm:px-16 dark:bg-zinc-800/50">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-3xl">
                📬 The Maker Notes
            </h2>
            
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                Subscribe now to get the first issues:
            </p>
            
            <ul class="mt-6 space-y-2 text-left text-sm text-zinc-600 dark:text-zinc-400">
                @foreach($benefits as $benefit)
                <li class="flex gap-2">
                    <span class="text-teal-600 dark:text-teal-400">•</span>
                    {{ $benefit }}
                </li>
                @endforeach
            </ul>
            
            <p class="mt-6 font-semibold text-zinc-800 dark:text-zinc-100">
                No fluff. Just practical insights from someone doing the work.
            </p>
            
            <form class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-center" action="{{ route('newsletter') }}" method="GET">
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    class="min-w-0 flex-auto rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                />
                <x-ui.gradient-button variant="primary" type="submit">
                    Subscribe Now → It's Free
                </x-ui.gradient-button>
            </form>
            
            <p class="mt-4 text-xs text-zinc-500 dark:text-zinc-400">
                Join hundreds of makers and developers.
            </p>
        </div>
    </div>
</div>