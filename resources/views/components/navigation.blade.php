<div class="mx-auto w-full my-6 max-w-7xl lg:px-8" x-data="{ mobileMenuOpen: false }">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-3xl lg:max-w-7xl">
            <div class="relative flex gap-4">
                <div class="flex flex-1"></div>
                <div class="flex justify-end md:justify-center">
                    <div class="pointer-events-auto md:hidden">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            x-bind:aria-expanded="mobileMenuOpen"
                            class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-zinc-800 shadow-sm shadow-zinc-200/50 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:hover:ring-white/20 dark:shadow-none"
                            type="button">Menu
                            <x-icon name="lucide-chevron-down" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400 transition-transform" x-bind:class="mobileMenuOpen ? 'rotate-180' : ''" />
                        </button>
                    </div>
                    
                    <!-- Mobile Menu Panel -->
                    <div x-show="mobileMenuOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="mobileMenuOpen = false"
                         class="absolute top-16 right-0 z-50 md:hidden"
                         role="dialog">
                        <div class="w-56 rounded-2xl bg-white/95 p-4 shadow-lg shadow-zinc-200/50 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/95 dark:ring-white/10 dark:shadow-none">
                            <nav>
                                <ul class="space-y-2">
                                    <li>
                                        <a @click="mobileMenuOpen = false" 
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('home') }}">About</a>
                                    </li>
                                    <li>
                                        <a @click="mobileMenuOpen = false"
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('services') }}">Services</a>
                                    </li>
                                    <li>
                                        <a @click="mobileMenuOpen = false"
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('projects') }}">Projects</a>
                                    </li>
                                    <li>
                                        <a @click="mobileMenuOpen = false"
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('speaking') }}">Speaking</a>
                                    </li>
                                    <li>
                                        <a @click="mobileMenuOpen = false"
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('newsletter') }}">Newsletter</a>
                                    </li>
                                    <li>
                                        <a @click="mobileMenuOpen = false"
                                           class="block rounded-lg px-4 py-3 text-sm font-medium text-zinc-800 transition hover:bg-teal-50 hover:text-teal-600 dark:text-zinc-200 dark:hover:bg-zinc-700/50 dark:hover:text-teal-400 no-underline"
                                           href="{{ route('contact') }}">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <nav class="pointer-events-auto hidden md:block">
                        <ul class="flex rounded-full bg-white/95 px-3 text-sm font-medium text-gray-700 shadow-sm shadow-zinc-200/50 ring-1 ring-zinc-200/50 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:shadow-none">
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('home') }}">About</a></li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('services') }}">Services</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('projects') }}">Projects</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('speaking') }}">Speaking</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('newsletter') }}">Newsletter</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-600 dark:hover:text-teal-400 no-underline"
                                   href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex justify-end md:flex-1 gap-4">
                    <div class="pointer-events-auto">
                        <button type="button" aria-label="Switch to dark theme"
                                class="group rounded-full bg-white/90 px-3 py-2 shadow-sm shadow-zinc-200/50 ring-1 ring-zinc-900/5 backdrop-blur transition dark:bg-zinc-800/90 dark:ring-white/10 dark:hover:ring-white/20 dark:shadow-none"
                                onClick="toggleDarkMode()">
                            <x-icon name="lucide-sun" class="h-6 w-6 fill-zinc-100 stroke-zinc-500 transition group-hover:fill-zinc-200 group-hover:stroke-zinc-700 dark:hidden [@media(prefers-color-scheme:dark)]:fill-teal-50 [@media(prefers-color-scheme:dark)]:stroke-teal-500 [@media(prefers-color-scheme:dark)]:group-hover:fill-teal-50 [@media(prefers-color-scheme:dark)]:group-hover:stroke-teal-600" />
                            <x-icon name="lucide-moon" class="hidden h-6 w-6 fill-zinc-700 stroke-zinc-500 transition dark:block [@media(prefers-color-scheme:dark)]:group-hover:stroke-zinc-400 [@media_not_(prefers-color-scheme:dark)]:fill-teal-400/10 [@media_not_(prefers-color-scheme:dark)]:stroke-teal-500" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
