<x-layout title="Contact - Joey Kudish">
    <div class="mx-auto max-w-2xl lg:max-w-5xl">
        <header class="max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                Get in Touch
            </h1>
            <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                Have a project in mind? Need help with automation? Just want to say hi? I'd love to hear from you.
            </p>
        </header>
        
        <div class="mt-16 grid gap-16 lg:grid-cols-3 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-zinc-100 p-8 dark:border-zinc-700/40">
                    <h2 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100">
                        Send Me a Message
                    </h2>
                    
                    <form class="mt-8 space-y-6" action="#" method="POST">
                        @csrf
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                    First Name
                                </label>
                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                    disabled
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
                                    class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                    disabled
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
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                disabled
                            />
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Subject
                            </label>
                            <select
                                name="subject"
                                id="subject"
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                disabled
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
                                class="mt-1 w-full rounded-md border border-zinc-900/10 px-3 py-2 shadow-sm placeholder:text-zinc-400 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-teal-400 dark:focus:ring-teal-400/10 sm:text-sm"
                                placeholder="Tell me about your project..."
                                disabled
                            ></textarea>
                        </div>
                        
                        <div>
                            <x-ui.button variant="primary" type="submit">
                                Send Message →
                            </x-ui.button>
                        </div>
                        
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            * Contact form coming soon. For now, please email me directly at joey@jkudish.com
                        </p>
                    </form>
                </div>
            </div>
            
            <div class="space-y-8">
                <div>
                    <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100">
                        Other Ways to Connect
                    </h2>
                    
                    <div class="mt-6 space-y-4">
                        <a href="mailto:joey@jkudish.com" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">📧</span>
                            <div>
                                <p class="font-medium text-zinc-900 dark:text-zinc-100">
                                    Email
                                </p>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    joey@jkudish.com
                                </p>
                            </div>
                        </a>
                        
                        <a href="https://linkedin.com/in/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">💼</span>
                            <div>
                                <p class="font-medium text-zinc-900 dark:text-zinc-100">
                                    LinkedIn
                                </p>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    /in/jkudish
                                </p>
                            </div>
                        </a>
                        
                        <a href="https://github.com/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">🐙</span>
                            <div>
                                <p class="font-medium text-zinc-900 dark:text-zinc-100">
                                    GitHub
                                </p>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    @jkudish
                                </p>
                            </div>
                        </a>
                        
                        <a href="https://twitter.com/jkudish" class="flex items-start gap-3 rounded-lg p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                            <span class="text-xl">𝕏</span>
                            <div>
                                <p class="font-medium text-zinc-900 dark:text-zinc-100">
                                    X (Twitter)
                                </p>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    @jkudish
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="rounded-2xl bg-zinc-50 p-6 dark:bg-zinc-800/50">
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">
                        Response Time
                    </h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        I typically respond within 24-48 hours. For urgent matters, please indicate that in your subject line.
                    </p>
                </div>
                
                <div class="rounded-2xl bg-teal-50 p-6 dark:bg-teal-900/20">
                    <h3 class="font-semibold text-teal-900 dark:text-teal-100">
                        Open for Projects
                    </h3>
                    <p class="mt-2 text-sm text-teal-700 dark:text-teal-300">
                        I'm currently accepting new clients for Q1 2025. Let's discuss your project!
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>