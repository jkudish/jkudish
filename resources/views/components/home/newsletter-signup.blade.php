@php
$benefits = [
    'Practical AI coding workflows that work',
    'Prompt engineering patterns that ship production code',
    'Human-AI collaboration strategies that 10x productivity',
    'Real examples from my daily AI-augmented development',
];
@endphp

<div class="mx-auto max-w-2xl lg:max-w-5xl">
    <div class="rounded-2xl bg-gradient-to-br from-teal-50/50 to-cyan-50/30 px-6 py-16 sm:px-16 dark:bg-zinc-800/50 border border-teal-100/50 dark:border-zinc-700/50 shadow-sm">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-zinc-100 sm:text-3xl">
                🤖 Human in the Loop
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
                Stay human while coding at AI speed. Real workflows that work.
            </p>
            
            <form class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-center" action="{{ route('newsletter') }}" method="GET">
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    class="min-w-0 flex-auto rounded-md border border-emerald-500/40 bg-white px-3 py-2 shadow-sm text-gray-900 placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-600/40 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20 sm:text-sm transition-all duration-200"
                />
                <x-ui.gradient-button variant="primary" type="submit">
                    Subscribe Now → It's Free
                </x-ui.gradient-button>
            </form>
            
            <p class="mt-4 text-xs text-zinc-500 dark:text-zinc-400">
                Join hundreds of developers mastering AI augmentation.
            </p>
        </div>
    </div>
</div>