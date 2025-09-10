<div class="mx-auto w-full my-6 max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-3xl lg:max-w-7xl">
            <div class="relative flex gap-4">
                <div class="flex flex-1"></div>
                <div class="flex justify-end md:justify-center">
                    <div class="pointer-events-auto md:hidden">
                        <button
                            class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:hover:ring-white/20"
                            type="button" aria-expanded="false" data-headlessui-state=""
                            id="headlessui-popover-button-:Rbmiqja:">Menu
                            <x-icon name="lucide-chevron-down" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400" />
                        </button>
                    </div>
                    <div hidden=""
                         style="position:fixed;top:1px;left:1px;width:1px;height:0;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none"></div>
                    <nav class="pointer-events-auto hidden md:block">
                        <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('home') }}">About</a></li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('services') }}">Services</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('projects') }}">Projects</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('speaking') }}">Speaking</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('newsletter') }}">Newsletter</a>
                            </li>
                            <li>
                                <a class="w-full relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400"
                                   href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex justify-end md:flex-1 gap-4">
                    <div class="pointer-events-auto">
                        <button type="button" aria-label="Switch to dark theme"
                                class="group rounded-full bg-white/90 px-3 py-2 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur transition dark:bg-zinc-800/90 dark:ring-white/10 dark:hover:ring-white/20"
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
