<div>
    <div class="text-center mb-16">
        <x-ui.typography variant="h2">
            How I Work
        </x-ui.typography>
        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
            No BS. No surprises. Just results.
        </p>
    </div>

    {{-- Process Steps --}}
    <div class="grid gap-12 md:grid-cols-3 max-w-5xl mx-auto">
        @php
        $steps = [
            [
                'title' => 'Figure It Out',
                'description' => 'Quick call. I\'ll tell you if I can help, how long it\'ll take, and exactly what it\'ll cost. No pitch.'
            ],
            [
                'title' => 'Build It',
                'description' => 'Regular updates, working demos, clean code. You\'ll know what\'s happening every step of the way.'
            ],
            [
                'title' => 'Ship It',
                'description' => 'Production-ready code, 30 days support included. Then monthly support or full handoff, your call..'
            ]
        ];
        @endphp

        @foreach($steps as $index => $step)
        <div class="text-left relative">
            <div class="flex items-center gap-3 mb-3">
                <x-icon name="lucide-chevron-right" class="w-4 h-4 text-teal-600 dark:text-teal-400" />

                <x-ui.typography variant="h3" class="text-teal-600 dark:text-teal-400">
                    {{ $step['title'] }}
                </x-ui.typography>
            </div>
            <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed">
                {{ $step['description'] }}
            </p>
        </div>
        @endforeach
    </div>
</div>
