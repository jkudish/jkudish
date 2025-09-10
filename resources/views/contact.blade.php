<x-layout title="Contact - Joey Kudish">
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg">
                <div class="px-6 sm:px-8 lg:px-10 py-16 lg:py-24">
                    <header class="max-w-2xl mx-auto text-center">
                        <x-ui.typography variant="h1">
                            Get in Touch
                        </x-ui.typography>
                        <x-ui.typography variant="lead" color="muted" class="mt-6">
                            Have a project in mind? Let's discuss how I can help.
                        </x-ui.typography>
                    </header>
        
                    <div class="mt-16 grid gap-8 lg:grid-cols-3 lg:gap-12">
            <div class="lg:col-span-2">
                @if(session('success'))
                    <div class="mb-6 rounded-lg bg-teal-50 p-4 text-teal-800 dark:bg-teal-900/20 dark:text-teal-200">
                        {{ session('success') }}
                    </div>
                @endif
                
                        <div class="rounded-2xl bg-white dark:bg-zinc-800/50 border border-zinc-200/50 dark:border-zinc-700/50 p-8 lg:p-10 shadow-sm h-full">
                    <x-ui.typography variant="h3">
                        Send Me a Message
                    </x-ui.typography>
                    
                            <form class="mt-10 space-y-8" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        {{-- Honeypot field for spam protection --}}
                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                    First Name
                                </label>
                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    placeholder="John"
                                    required
                                    class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                    />
                            </div>
                            
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                    Last Name
                                </label>
                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    placeholder="Doe"
                                    required
                                    class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                    />
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="john@example.com"
                                required
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                            />
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Subject
                            </label>
                            <select
                                name="subject"
                                id="subject"
                                required
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                            >
                                <option>Project Inquiry</option>
                                <option>Consultation Request</option>
                                <option>Speaking Opportunity</option>
                                <option>General Question</option>
                                <option>Just Saying Hi</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Message
                            </label>
                            <textarea
                                name="message"
                                id="message"
                                rows="6"
                                required
                                minlength="10"
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                placeholder="Tell me about your project..."
                            ></textarea>
                        </div>
                        
                            <div class="pt-2">
                                <x-ui.gradient-button variant="primary" type="submit" icon="true">
                                    Send Message
                                </x-ui.gradient-button>
                            </div>
                        
                    </form>
                </div>
                        </div>
                        
                        <div class="lg:col-span-1 space-y-8">
                            <div>
                                <x-ui.typography variant="h4">
                                    Other Ways to Connect
                                </x-ui.typography>
                                
                                <div class="mt-6 space-y-4">
                                    <a href="mailto:joey@jkudish.com" class="group flex items-start gap-3 rounded-lg p-3 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 border border-transparent hover:border-emerald-200/50 dark:hover:border-emerald-700/30 transition-all">
                                        <div class="mt-0.5">
                                            <x-icon name="lucide-mail" class="w-5 h-5 text-zinc-400 dark:text-zinc-500 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors" />
                                        </div>
                                        <div>
                                            <x-ui.typography variant="body" weight="medium" class="group-hover:text-emerald-700 dark:group-hover:text-emerald-300 transition-colors">
                                                Email
                                            </x-ui.typography>
                                            <x-ui.typography variant="small" color="muted">
                                                joey@jkudish.com
                                            </x-ui.typography>
                                        </div>
                                    </a>
                        
                                    <a href="https://linkedin.com/in/jkudish" class="group flex items-start gap-3 rounded-lg p-3 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 border border-transparent hover:border-emerald-200/50 dark:hover:border-emerald-700/30 transition-all">
                                        <div class="mt-0.5">
                                            <svg viewBox="0 0 24 24" aria-hidden="true"
                                                 class="w-5 h-5 fill-zinc-400 dark:fill-zinc-500 group-hover:fill-emerald-600 dark:group-hover:fill-emerald-400 transition-colors">
                                                <path
                                                    d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 0 01-1.548-1.549 1.548 1.548 0 111.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 3.58 20.4 3 19.666 3h.003z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <x-ui.typography variant="body" weight="medium" class="group-hover:text-emerald-700 dark:group-hover:text-emerald-300 transition-colors">
                                                LinkedIn
                                            </x-ui.typography>
                                            <x-ui.typography variant="small" color="muted">
                                                /in/jkudish
                                            </x-ui.typography>
                                        </div>
                                    </a>
                        
                                    <a href="https://github.com/jkudish" class="group flex items-start gap-3 rounded-lg p-3 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 border border-transparent hover:border-emerald-200/50 dark:hover:border-emerald-700/30 transition-all">
                                        <div class="mt-0.5">
                                            <svg viewBox="0 0 24 24" aria-hidden="true"
                                                 class="w-5 h-5 fill-zinc-400 dark:fill-zinc-500 group-hover:fill-emerald-600 dark:group-hover:fill-emerald-400 transition-colors">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M12 2C6.475 2 2 6.588 2 12.253c0 4.537 2.862 8.369 6.838 9.727.5.09.687-.218.687-.487 0-.243-.013-1.05-.013-1.91C7 20.059 6.35 18.957 6.15 18.38c-.113-.295-.6-1.205-1.025-1.448-.35-.192-.85-.667-.013-.68.788-.012 1.35.744 1.538 1.051.9 1.551 2.338 1.116 2.912.846.088-.666.35-1.115.638-1.371-2.225-.256-4.55-1.14-4.55-5.062 0-1.115.387-2.038 1.025-2.756-.1-.256-.45-1.307.1-2.717 0 0 .837-.269 2.75 1.051.8-.23 1.65-.346 2.5-.346.85 0 1.7.115 2.5.346 1.912-1.333 2.75-1.05 2.75-1.05.55 1.409.2 2.46.1 2.716.637.718 1.025 1.628 1.025 2.756 0 3.934-2.337 4.806-4.562 5.062.362.32.675.936.675 1.897 0 1.371-.013 2.473-.013 2.82 0 .268.188.589.688.486a10.039 10.039 0 0 0 4.932-3.74A10.447 10.447 0 0 0 22 12.253C22 6.588 17.525 2 12 2Z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <x-ui.typography variant="body" weight="medium" class="group-hover:text-emerald-700 dark:group-hover:text-emerald-300 transition-colors">
                                                GitHub
                                            </x-ui.typography>
                                            <x-ui.typography variant="small" color="muted">
                                                @jkudish
                                            </x-ui.typography>
                                        </div>
                                    </a>
                        
                                    <a href="https://twitter.com/jkudish" class="group flex items-start gap-3 rounded-lg p-3 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 border border-transparent hover:border-emerald-200/50 dark:hover:border-emerald-700/30 transition-all">
                                        <div class="mt-0.5">
                                            <svg viewBox="0 0 24 24" aria-hidden="true"
                                                 class="w-5 h-5 fill-zinc-400 dark:fill-zinc-500 group-hover:fill-emerald-600 dark:group-hover:fill-emerald-400 transition-colors">
                                                <path
                                                    d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.6438L11.4257 12.9742V12.9738Z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <x-ui.typography variant="body" weight="medium" class="group-hover:text-emerald-700 dark:group-hover:text-emerald-300 transition-colors">
                                                X (Twitter)
                                            </x-ui.typography>
                                            <x-ui.typography variant="small" color="muted">
                                                @jkudish
                                            </x-ui.typography>
                                        </div>
                                    </a>
                                </div>
                            </div>
                
                            <div class="rounded-2xl bg-gradient-to-br from-zinc-50 to-zinc-100/50 dark:from-zinc-800/50 dark:to-zinc-900/50 border border-zinc-200/50 dark:border-zinc-700/50 p-6 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-zinc-200/20 to-transparent rounded-full blur-2xl"></div>
                                <div class="relative">
                                    <div class="flex items-center gap-3 mb-3">
                                        <x-icon name="lucide-clock" class="w-5 h-5 text-zinc-500 dark:text-zinc-400" />
                                        <x-ui.typography variant="h4">
                                            Response Time
                                        </x-ui.typography>
                                    </div>
                                    <x-ui.typography variant="small" color="muted">
                                        I typically respond within 24-48 hours during business days.
                                    </x-ui.typography>
                                </div>
                            </div>
                            
                            <div class="rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-950/20 border border-emerald-200/50 dark:border-emerald-700/30 p-6 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-emerald-300/20 to-transparent rounded-full blur-2xl"></div>
                                <div class="relative">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                        <x-ui.typography variant="h4" class="text-emerald-900 dark:text-emerald-100">
                                            Open for Projects
                                        </x-ui.typography>
                                    </div>
                                    <x-ui.typography variant="small" class="text-emerald-700 dark:text-emerald-300">
                                        I'm currently accepting new clients for Q4 2025. Let's discuss your project!
                                    </x-ui.typography>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>