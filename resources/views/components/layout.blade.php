@props([
    'title' => 'Joey Kudish',
    'hideNewsletter' => false,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'structuredData' => null,
    'appendSiteName' => true,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <x-seo 
        :title="$title"
        :description="$description"
        :keywords="$keywords"
        :image="$image"
        :structuredData="$structuredData"
        :appendSiteName="$appendSiteName"
    />

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    
    <!-- Legacy favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    
    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('img/favicon/android-chrome-512x512.png') }}">
    
    <!-- Browser theme color -->
    <meta name="theme-color" content="#000000">

    <link rel="preload" href="{{ url('fonts/Telegraf UltraBold 800.woff') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff2') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff') }}" as="font" crossorigin/>

    <link rel="preload" href="{{ url('img/joey.webp') }}" as="image" crossorigin/>
    <link rel="preload" href="{{ url('img/joey.png') }}" as="image" crossorigin/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://cdn.usefathom.com/script.js" data-site="OLWGPIDF" defer></script>
    <!-- / Fathom -->

    <script>
        let theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        theme = localStorage.theme || theme;

        function applyTheme() {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function toggleDarkMode() {
            theme = theme === 'dark' ? 'light' : 'dark';
            localStorage.theme = theme;
            applyTheme();
        }

        // apply on load
        applyTheme();

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', ({matches}) => {
                theme = (matches) ? 'dark' : 'light';
                localStorage.removeItem('theme');
                applyTheme();
            })
    </script>

</head>
<body class="dark:bg-zinc-800 flex flex-col min-h-screen">
{{-- Skip Navigation Link for Accessibility --}}
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-teal-600 text-white px-4 py-2 rounded-md z-50 focus:outline-none focus:ring-2 focus:ring-teal-500">
    Skip to main content
</a>

<x-navigation/>

<main id="main-content" class="flex-grow">
    {{ $slot }}
</main>
<x-footer :hideNewsletter="$hideNewsletter"/>
</body>
</html>
