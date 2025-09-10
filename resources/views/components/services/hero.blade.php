<div class="relative">
    {{-- Gradient overlay --}}
    <div class="absolute inset-0 -z-10 opacity-30">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-emerald-100 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gradient-to-tr from-purple-100 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="text-center">
        {{-- Service icons --}}
        <div class="mb-8 flex justify-center gap-8">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                <div class="relative bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-lg">
                    <x-icon name="lucide-zap" class="w-10 h-10 text-yellow-600 dark:text-yellow-400" />
                </div>
            </div>
            
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                <div class="relative bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-lg">
                    <x-icon name="lucide-file-text" class="w-10 h-10 text-purple-600 dark:text-purple-400" />
                </div>
            </div>
            
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                <div class="relative bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-lg">
                    <x-icon name="lucide-code-2" class="w-10 h-10 text-emerald-600 dark:text-emerald-400" />
                </div>
            </div>
            
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                <div class="relative bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-lg">
                    <x-icon name="lucide-sparkles" class="w-10 h-10 text-cyan-600 dark:text-cyan-400" />
                </div>
            </div>
        </div>

        <x-ui.typography variant="h1">
            I Build Software That Works.
            <span class="block text-gradient-primary mt-2">Let's Build Yours.</span>
        </x-ui.typography>
        
        <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400 max-w-3xl mx-auto">
            From prototype to profit. From manual to magical. From blocked to launched.
        </p>
        
        <div class="mt-8 flex justify-center gap-4">
            <a href="#services" class="inline-flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                <span>Explore Services</span>
                <x-icon name="lucide-arrow-down" class="w-4 h-4 animate-bounce" />
            </a>
        </div>
    </div>
</div>