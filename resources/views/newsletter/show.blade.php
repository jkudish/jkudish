<x-layout
    :title="$broadcast->name . ' - Human in the Loop Newsletter'"
    :description="$broadcast->subject"
    :appendSiteName="false"
>
    <div class="flex justify-center my-8 lg:my-12">
        <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back to Archive Link - Outside Container --}}
            <div class="mb-4">
                <a href="{{ route('newsletter') }}" class="inline-flex items-center text-sm text-teal-600 dark:text-teal-400 hover:underline">
                    ← Back to archive
                </a>
            </div>

            {{-- Single Container with Newsletter Content --}}
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg overflow-hidden border border-zinc-200/50 dark:border-zinc-800/50">

                {{-- Newsletter Header --}}
                <div class="px-6 sm:px-8 lg:px-10 py-8 border-b border-zinc-200/50 dark:border-zinc-800/50">
                    <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-zinc-100">
                        {{ $broadcast->name }}
                    </h1>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $broadcast->sent_at->format('F j, Y') }}
                    </p>
                </div>

                {{-- Subscribe Banner at Top --}}
                <div class="px-6 sm:px-8 lg:px-10 py-6 border-b border-zinc-200/50 dark:border-zinc-800/50 bg-zinc-50/50 dark:bg-zinc-800/30">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                Enjoying this newsletter?
                            </p>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                Subscribe to get future issues
                            </p>
                        </div>
                        <x-ui.gradient-button variant="primary" href="{{ route('newsletter') }}" icon="true">
                            Subscribe Now
                        </x-ui.gradient-button>
                    </div>
                </div>

                {{-- Newsletter HTML Content --}}
                <div class="px-6 sm:px-8 lg:px-10 pt-6 pb-8">
                    <div class="prose prose-lg max-w-none
                                [&_p]:text-zinc-700 dark:[&_p]:text-zinc-300 [&_p]:mb-6 [&_p]:leading-relaxed
                                [&_h1]:hidden
                                [&>p:first-of-type]:hidden
                                [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:text-zinc-900 dark:[&_h2]:text-zinc-100 [&_h2]:mb-5 [&_h2]:mt-8
                                [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-zinc-900 dark:[&_h3]:text-zinc-100 [&_h3]:mb-4 [&_h3]:mt-6
                                [&_h4]:text-lg [&_h4]:font-semibold [&_h4]:text-zinc-900 dark:[&_h4]:text-zinc-100 [&_h4]:mb-3 [&_h4]:mt-4
                                [&_strong]:text-zinc-900 dark:[&_strong]:text-zinc-100 [&_strong]:font-semibold
                                [&_li]:text-zinc-700 dark:[&_li]:text-zinc-300
                                [&_ul]:mb-6 [&_ol]:mb-6
                                [&_a]:text-teal-600 dark:[&_a]:text-teal-400 [&_a]:no-underline hover:[&_a]:underline
                                [&_hr]:border-zinc-200 dark:[&_hr]:border-zinc-700 [&_hr]:my-8 [&_hr]:border-t-2
                                [&_blockquote]:border-l-4 [&_blockquote]:border-teal-500 dark:[&_blockquote]:border-teal-400
                                [&_blockquote]:bg-teal-50 dark:[&_blockquote]:bg-teal-950/50
                                [&_blockquote]:rounded-r-xl [&_blockquote]:px-6 [&_blockquote]:py-4 [&_blockquote]:my-6
                                [&_blockquote]:not-italic
                                [&_blockquote_p]:text-zinc-700 dark:[&_blockquote_p]:text-zinc-200 [&_blockquote_p]:mb-0 [&_blockquote_p]:last:mb-0 [&_blockquote_p]:block
                                [&_.bento-blockquote]:border-l-4 [&_.bento-blockquote]:border-teal-500 dark:[&_.bento-blockquote]:border-teal-400
                                [&_.bento-blockquote]:bg-teal-50 dark:[&_.bento-blockquote]:bg-teal-950/50
                                [&_.bento-blockquote]:rounded-r-xl [&_.bento-blockquote]:px-6 [&_.bento-blockquote]:py-4 [&_.bento-blockquote]:my-6
                                [&_.bento-blockquote]:not-italic
                                [&_.bento-blockquote_p]:text-zinc-700 dark:[&_.bento-blockquote_p]:text-zinc-200 [&_.bento-blockquote_p]:mb-0 [&_.bento-blockquote_p]:last:mb-0 [&_.bento-blockquote_p]:block
                                [&_[data-type='bento-callout']]:!border-l-teal-500 dark:[&_[data-type='bento-callout']]:!border-l-teal-400
                                [&_[data-type='bento-callout']]:!bg-teal-50 dark:[&_[data-type='bento-callout']]:!bg-teal-950/50
                                [&_[data-type='bento-callout']]:!text-zinc-700 dark:[&_[data-type='bento-callout']]:!text-zinc-200">
                        {!! $broadcast->html_content !!}
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>
