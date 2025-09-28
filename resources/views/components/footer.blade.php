@props(['hideNewsletter' => false])

<footer class="relative mt-24 bg-gradient-to-b from-white to-zinc-50 dark:from-zinc-900 dark:to-zinc-950 backdrop-blur-xl backdrop-saturate-150 border-t border-zinc-200/30 dark:border-zinc-800/50">
    {{-- Newsletter Section --}}
    @unless($hideNewsletter)
    <div class="border-b border-zinc-100 dark:border-zinc-800/50">
        <x-ui.container size="default" padding="true">
            <div class="py-12 lg:py-16">
                <div class="mx-auto max-w-2xl text-center">
                    <div class="flex items-center justify-center gap-3 mb-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-lg blur-lg opacity-[0.015]"></div>
                            <div class="relative bg-white/10 dark:bg-zinc-800/50 backdrop-blur-sm p-2.5 rounded-lg border border-white/20 dark:border-zinc-700/50">
                                <x-icon name="lucide-user-check" class="w-6 h-6 text-teal-400" />
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-3xl">
                            AI won't replace you. But you + AI will replace you without it.
                        </h2>
                    </div>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-300">
                        Every two weeks, I share what actually worked building my apps with AI. Real workflows for solopreneurs & indie hackers.
                    </p>

                    <div x-data="{
                        email: '',
                        loading: false,
                        message: '',
                        messageType: '',
                        async submitNewsletter() {
                            if (!this.email) return;
                            
                            this.loading = true;
                            this.message = '';
                            
                            try {
                                const response = await fetch('{{ route('newsletter.store') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        email: this.email
                                    })
                                });
                                
                                const data = await response.json();
                                
                                if (response.ok) {
                                    this.message = data.message || 'Welcome to Human in the Loop! You\'ll receive my next AI development insights soon.';
                                    this.messageType = 'success';
                                    this.email = '';
                                    
                                    // Track Fathom event
                                    if (window.fathom && data.track_event) {
                                        window.fathom.trackEvent('newsletter_signup');
                                    }
                                } else {
                                    this.message = data.message || 'Something went wrong. Please try again.';
                                    this.messageType = 'error';
                                }
                            } catch (error) {
                                this.message = 'Something went wrong. Please try again.';
                                this.messageType = 'error';
                            } finally {
                                this.loading = false;
                                setTimeout(() => {
                                    this.message = '';
                                }, 5000);
                            }
                        }
                    }">
                        <form @submit.prevent="submitNewsletter" class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-center">
                            <input
                                type="email"
                                x-model="email"
                                placeholder="Enter your email"
                                aria-label="Email address"
                                class="min-w-0 flex-auto rounded-lg border border-emerald-500/40 bg-white dark:bg-zinc-800/50 backdrop-blur-sm px-4 py-3 text-gray-900 dark:text-white placeholder:text-gray-500 dark:placeholder:text-zinc-400 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 sm:text-sm transition-all duration-200"
                                :disabled="loading"
                                required
                            />
                            <x-ui.gradient-button variant="primary" type="submit" icon="true" x-bind:disabled="loading">
                                <span x-show="!loading">Count me in →</span>
                                <span x-show="loading">Subscribing...</span>
                            </x-ui.gradient-button>
                        </form>
                        
                        <div x-show="message" x-transition class="mt-4">
                            <p :class="{
                                'text-emerald-600 dark:text-emerald-400': messageType === 'success',
                                'text-red-600 dark:text-red-400': messageType === 'error'
                            }" class="text-sm font-medium" x-text="message"></p>
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-zinc-600 dark:text-zinc-500">
                        I'll never spam you, promise.
                    </p>
                </div>
            </div>
        </x-ui.container>
    </div>
    @endunless

    {{-- Footer Links --}}
    <x-ui.container size="default" padding="true">
        <div class="py-12 lg:py-16">
            <div class="flex flex-wrap justify-center gap-x-12 gap-y-3">
                <a href="{{ route('home') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    About
                </a>
                <a href="{{ route('services') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Services
                </a>
                <a href="{{ route('projects') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Projects
                </a>
                <a href="{{ route('speaking') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Speaking
                </a>
                <a href="{{ route('newsletter') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Newsletter
                </a>
                <a href="{{ route('contact') }}" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Contact
                </a>
                <a href="https://glass.photo/jkudish" target="_blank" rel="noopener noreferrer" class="link-underline text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    Photography
                </a>
            </div>

            {{-- Social Links --}}
            <div class="mt-12 border-t border-zinc-100 dark:border-zinc-800/50 pt-8">
                <div class="flex justify-center gap-8">
                    <a class="group -m-1 p-1"
                       aria-label="Follow on Blue Sky"
                       href="https://bsky.app/profile/jkudish.bsky.social"
                       title="Follow on Blue Sky"
                       target="_blank"
                       rel="noopener noreferrer"
                    >
                        <svg viewBox="0 0 600 530" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700">
                            <path d="m135.72 44.03c66.496 49.921 138.02 151.14 164.28 205.46 26.262-54.316 97.782-155.54 164.28-205.46 47.98-36.021 125.72-63.892 125.72 24.795 0 17.712-10.155 148.79-16.111 170.07-20.703 73.984-96.144 92.854-163.25 81.433 117.3 19.964 147.14 86.092 82.697 152.22-122.39 125.59-175.91-31.511-189.63-71.766-2.514-7.3797-3.6904-10.832-3.7077-7.8964-0.0174-2.9357-1.1937 0.51669-3.7077 7.8964-13.714 40.255-67.233 197.36-189.63 71.766-64.444-66.128-34.605-132.26 82.697-152.22-67.108 11.421-142.55-7.4491-163.25-81.433-5.9562-21.282-16.111-152.36-16.111-170.07 0-88.687 77.742-60.816 125.72-24.795z"></path>
                        </svg>
                    </a>
                    <a class="group -m-1 p-1"
                       aria-label="Follow on Glass"
                       href="https://glass.photo/jkudish"
                       title="Follow on Glass"
                       target="_blank"
                       rel="noopener noreferrer"
                    >
                        <svg viewBox="0 0 88 88" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M44 0C19.6995 0 0 19.6995 0 44C0 68.3007 19.6995 88 44 88C68.3007 88 88 68.3007 88 44C88 19.6995 68.3007 0 44 0ZM52.0065 69.8208C53.0482 68.1228 53.5764 65.4722 53.5764 61.9432V57.4029C50.8813 59.6505 48.4252 61.8002 46.7579 63.5815C44.6067 65.8792 43.8626 68.396 44.7687 70.3143C45.3384 71.5202 46.5074 72.2405 47.8956 72.2405C49.7612 72.2405 50.9523 71.5391 52.0065 69.8208ZM56.3504 51.5513C58.168 50.0708 60.0475 48.5392 61.7212 47.1254C62.3038 46.6328 63.1776 46.7046 63.6717 47.2859C64.1658 47.8673 64.0943 48.7374 63.5107 49.23C61.8181 50.6608 59.9294 52.1997 58.102 53.6881C57.5171 54.1645 56.9298 54.6433 56.3444 55.1212V61.9432C56.3444 66.0448 55.698 69.0923 54.368 71.2604C52.8032 73.8116 50.7461 75 47.8956 75C45.445 75 43.2869 73.6547 42.2641 71.4899C40.8589 68.5119 41.782 64.8518 44.7341 61.6986C46.8668 59.4205 50.1381 56.6421 53.5764 53.8173V44.404C52.4106 46.3288 51.0538 48.4601 49.9582 49.8771C47.3097 53.304 43.0751 57.8596 36.908 57.8596C29.3081 57.8596 24 50.7505 24 40.572C24 33.7283 25.802 27.5363 29.2117 22.6648C33.3835 16.7033 39.5445 13 45.2895 13C51.9156 13 56.5441 17.7299 56.5441 24.5022C56.5441 30.0898 53.5418 35.2299 48.0893 38.9765C47.4605 39.4093 46.5987 39.2506 46.1651 38.6233C45.731 37.9959 45.8897 37.1368 46.5189 36.7045C51.1987 33.4887 53.7761 29.1548 53.7761 24.5022C53.7761 20.1504 51.1516 15.7595 45.2895 15.7595C40.5087 15.7595 35.0885 19.0898 31.4809 24.2442C28.3979 28.6498 26.768 34.2958 26.768 40.572C26.768 49.2618 30.8429 55.1 36.908 55.1C40.7251 55.1 44.0734 52.9697 47.7659 48.1929C50.0426 45.2471 53.7143 38.6817 53.7512 38.6154C54.0571 38.0663 54.697 37.7931 55.3082 37.9509C55.9181 38.1086 56.3444 38.6578 56.3444 39.2865V51.5559L56.3504 51.5513Z" ></path>
                        </svg>
                    </a>
                    <a class="group -m-1 p-1"
                       aria-label="Follow on Twitter / X"
                       href="https://twitter.com/jkudish"
                       title="Follow on Twitter / X"
                       target="_blank"
                       rel="noopener noreferrer"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700">
                            <path
                                d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.6438L11.4257 12.9742V12.9738Z"></path>
                        </svg>
                    </a>
                    <a class="group -m-1 p-1"
                       aria-label="Follow on GitHub"
                       href="https://github.com/jkudish"
                       title="Follow on Github"
                       target="_blank"
                       rel="noopener noreferrer"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12 2C6.475 2 2 6.588 2 12.253c0 4.537 2.862 8.369 6.838 9.727.5.09.687-.218.687-.487 0-.243-.013-1.05-.013-1.91C7 20.059 6.35 18.957 6.15 18.38c-.113-.295-.6-1.205-1.025-1.448-.35-.192-.85-.667-.013-.68.788-.012 1.35.744 1.538 1.051.9 1.551 2.338 1.116 2.912.846.088-.666.35-1.115.638-1.371-2.225-.256-4.55-1.14-4.55-5.062 0-1.115.387-2.038 1.025-2.756-.1-.256-.45-1.307.1-2.717 0 0 .837-.269 2.75 1.051.8-.23 1.65-.346 2.5-.346.85 0 1.7.115 2.5.346 1.912-1.333 2.75-1.05 2.75-1.05.55 1.409.2 2.46.1 2.716.637.718 1.025 1.628 1.025 2.756 0 3.934-2.337 4.806-4.562 5.062.362.32.675.936.675 1.897 0 1.371-.013 2.473-.013 2.82 0 .268.188.589.688.486a10.039 10.039 0 0 0 4.932-3.74A10.447 10.447 0 0 0 22 12.253C22 6.588 17.525 2 12 2Z"></path>
                        </svg>
                    </a>
                    <a class="group -m-1 p-1"
                       aria-label="Follow on Pinkary"
                       href="https://pinkary.com/@jkudish"
                       title="Follow on Pinkary"
                       target="_blank"
                       rel="noopener noreferrer"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700 border-2 border-zinc-400 dark:border-zinc-400 rounded-full group-hover:border-emerald-700">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M8.79 18.35h0.248l0.069 -0.238q0.341 -1.186 0.741 -2.637v-0.001a324 324 0 0 1 0.746 -2.69 13.44 13.44 0 0 0 1.893 -0.209 9.12 9.12 0 0 0 1.412 -0.368 5.904 5.904 0 0 0 1.331 -0.657 3.408 3.408 0 0 0 1.044 -1.046c0.276 -0.436 0.406 -0.948 0.406 -1.522 0 -0.543 -0.145 -1.03 -0.444 -1.446 -0.276 -0.407 -0.643 -0.739 -1.093 -0.997a4.992 4.992 0 0 0 -1.417 -0.583 5.856 5.856 0 0 0 -1.501 -0.203q-0.685 0 -1.368 0.14 -0.669 0.137 -1.254 0.336l-0.001 0 -0.001 0q-0.555 0.195 -0.982 0.378l-0.199 0.085v0.217c0 0.176 0.085 0.325 0.173 0.439a1.68 1.68 0 0 0 0.294 0.294l0.007 0.005 0.007 0.005c0.059 0.041 0.119 0.078 0.179 0.106 0.056 0.026 0.137 0.057 0.231 0.057s0.186 -0.025 0.263 -0.053c0.081 -0.029 0.168 -0.07 0.261 -0.119l0.007 -0.003 0.006 -0.004q0.229 -0.135 0.618 -0.309l0.005 -0.002 0.004 -0.002a2.88 2.88 0 0 1 0.232 -0.099q-0.398 0.903 -0.739 1.752l0 0.002 0 0.002a107.52 107.52 0 0 0 -0.861 2.285l0 0.001 0 0.001q-0.401 1.128 -0.802 2.36a1027.68 1027.68 0 0 0 -0.858 2.619l-0.001 0.003 -0.001 0.003a18.72 18.72 0 0 1 -0.131 0.407l-0.003 0.01 -0.002 0.01a1.92 1.92 0 0 0 -0.07 0.499c0 0.387 0.212 0.684 0.541 0.887l0.002 0.001 0.002 0.001a1.968 1.968 0 0 0 1.011 0.283m5.645 -8.413c-0.236 0.349 -0.558 0.647 -0.973 0.891q-0.624 0.36 -1.414 0.573 -0.561 0.15 -1.119 0.223 0.38 -1.278 0.79 -2.46l0 -0.001q0.439 -1.275 0.907 -2.224 0.511 0.039 0.97 0.219l0.001 0 0.001 0c0.368 0.14 0.655 0.341 0.871 0.6l0.002 0.002 0.002 0.002c0.204 0.234 0.319 0.551 0.319 0.983 0 0.461 -0.12 0.853 -0.355 1.188l-0.001 0.002z"/>
                            <path d="M13.147 17.423a0.984 0.984 0 1 1 -1.968 0 0.984 0.984 0 0 1 1.968 0"/>
                        </svg>
                    </a>
                    <a class="group -m-1 p-1"
                       aria-label="Follow on LinkedIn"
                       href="https://www.linkedin.com/in/jkudish/"
                       target="_blank"
                       rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" aria-hidden="true"
                             class="h-7 w-7 fill-zinc-400 transition group-hover:fill-emerald-700">
                            <path
                                d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 0 01-1.548-1.549 1.548 1.548 0 111.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 3.58 20.4 3 19.666 3h.003z"></path>
                        </svg>
                    </a>
                </div>

                {{-- Bottom Copyright --}}
                <div class="mt-8 text-center">
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        © {{ date('Y') }} Joey Kudish. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </x-ui.container>
</footer>
