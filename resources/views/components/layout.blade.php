<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joey Kudish</title>

    <link rel="preload" href="{{ url('fonts/Telegraf UltraBold 800.woff') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff2') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff') }}" as="font" crossorigin/>

    <link rel="preload" href="{{ url('img/joey.webp') }}" as="image" crossorigin/>
    <link rel="preload" href="{{ url('img/joey.png') }}" as="image" crossorigin/>

    @vite('resources/css/app.css')

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

<x-navigation/>

<div class="max-w-2xl mx-auto">

    {{ $slot }}

</div>
<x-footer/>
</body>
</html>
