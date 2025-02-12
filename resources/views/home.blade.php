<x-layout>
    <div>
        <picture>
            <source srcset="{{ url('img/joey.webp') }}" type="image/webp">
            <source srcset="{{ url('img/joey.png') }}" type="image/png">
            <img
                src="data:image/png;base64,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"
                class="mx-auto h-48 w-48 rounded-full"
                loading="lazy"
                alt="Joey Kudish">
        </picture>
        <div class="mt-12 space-y-8 px-8 sm:max-w-[90%] md:max-w-none mx-auto">

            <h1 class="text-4xl font-title tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100 text-center sm:text-left">
                Hey, I'm Joey 👋</h1>

            <h2 class="text-2xl font-sans tracking-tight leading-8 sm:leading-10 text-zinc-800 sm:text-3xl dark:text-zinc-100">
                I'm a ✈️ Digital Nomad, World Explorer 🌏, Software Engineer 👨🏻‍💻 and Entrepreneur 💼</h2>

            <h2 class="text-2xl font-sans tracking-tight leading-8 sm:leading-10 text-zinc-800 sm:text-3xl dark:text-zinc-100">
                I work at <a href="https://metorik.com?utm_source=jkudish"><img loading="lazy"
                                                                                src="{{ url('img/metorik.svg') }}"
                                                                                class="h-8 sm:h-10 inline -mt-1 dark:hidden"
                                                                                alt="Metorik"><img loading="lazy"
                                                                                                   src="{{ url('img/metorik-dark.svg') }}"
                                                                                                   class="h-8 sm:h-10 hidden -mt-1 dark:inline"
                                                                                                   alt="Metorik"></a>,
                <br/>
                the co-pilot for
                <img loading="lazy"
                     src="{{ url('img/woo.svg') }}"
                     alt="WooCommerce"
                     class="h-5 sm:h-6 mx-1 -mt-1 inline">
                and <img loading="lazy"
                         src="{{ url('img/shopify.svg') }}"
                         class="ml-1 -mt-2 h-8 sm:h-10 inline dark:hidden"
                         alt="Shopify">
                <img loading="lazy"
                     src="{{ url('img/shopify-dark.svg') }}"
                     class="ml-1 -mt-2 h-8 sm:h-10 hidden dark:inline"
                     alt="Shopify">
            </h2>

        </div>
    </div>
</x-layout>
