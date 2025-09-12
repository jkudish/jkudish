<x-layout title="Contact - Joey Kudish">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-10">
        <header class="max-w-2xl">
            <x-ui.typography variant="h1">
                Get in Touch
            </x-ui.typography>
            <x-ui.typography variant="lead" color="muted" class="mt-6">
                Have a project in mind? Need help with automation? Just want to say hi? I'd love to hear from you.
            </x-ui.typography>
        </header>
        
        <div class="mt-16 grid gap-16 lg:grid-cols-3 lg:gap-8">
            <div class="lg:col-span-2">
                @if(session('success'))
                    <div class="mb-6 rounded-lg bg-teal-50 p-4 text-teal-800 dark:bg-teal-900/20 dark:text-teal-200">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="rounded-2xl border border-zinc-100 p-8 dark:border-zinc-700/40">
                    <x-ui.typography variant="h3">
                        Send Me a Message
                    </x-ui.typography>
                    
                    <form class="mt-8 space-y-6" action="{{ route('contact.store') }}" method="POST">
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
                        
                        <div>
                            <x-ui.gradient-button variant="primary" type="submit" icon="true">
                                Send Message
                            </x-ui.gradient-button>
                        </div>
                        
                    </form>
                </div>
            </div>
            
            <div class="space-y-8">
                <div>
                    <x-ui.typography variant="h4">
                        Other Ways to Connect
                    </x-ui.typography>
                    
                    <div class="mt-6 space-y-4">
                        <a href="mailto:joey@jkudish.com" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">📧</span>
                            <div>
                                <x-ui.typography variant="body" weight="medium">
                                    Email
                                </x-ui.typography>
                                <x-ui.typography variant="small" color="muted">
                                    joey@jkudish.com
                                </x-ui.typography>
                            </div>
                        </a>
                        
                        <a href="https://linkedin.com/in/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">💼</span>
                            <div>
                                <x-ui.typography variant="body" weight="medium">
                                    LinkedIn
                                </x-ui.typography>
                                <x-ui.typography variant="small" color="muted">
                                    /in/jkudish
                                </x-ui.typography>
                            </div>
                        </a>
                        
                        <a href="https://github.com/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">🐙</span>
                            <div>
                                <x-ui.typography variant="body" weight="medium">
                                    GitHub
                                </x-ui.typography>
                                <x-ui.typography variant="small" color="muted">
                                    @jkudish
                                </x-ui.typography>
                            </div>
                        </a>
                        
                        <a href="https://twitter.com/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">𝕏</span>
                            <div>
                                <x-ui.typography variant="body" weight="medium">
                                    X (Twitter)
                                </x-ui.typography>
                                <x-ui.typography variant="small" color="muted">
                                    @jkudish
                                </x-ui.typography>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="rounded-2xl bg-zinc-50 p-6 dark:bg-zinc-800/50">
                    <x-ui.typography variant="h4">
                        Response Time
                    </x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        I typically respond within 24-48 hours. For urgent matters, please indicate that in your subject line.
                    </x-ui.typography>
                </div>
                
                <div class="rounded-2xl bg-teal-50 p-6 dark:bg-teal-900/20">
                    <x-ui.typography variant="h4" class="text-teal-900 dark:text-teal-100">
                        Open for Projects
                    </x-ui.typography>
                    <x-ui.typography variant="small" class="mt-2 text-teal-700 dark:text-teal-300">
                        I'm currently accepting new clients for Q1 2025. Let's discuss your project!
                    </x-ui.typography>
                </div>
            </div>
        </div>
    </div>
</x-layout>