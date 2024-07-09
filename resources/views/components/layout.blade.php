<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joey Kudish</title>

    <link rel="preload" href="{{ url('fonts/Telegraf UltraBold 800.woff') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff2') }}" as="font" crossorigin/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff') }}" as="font" crossorigin/>

    @vite('resources/css/app.css')
</head>
<body class="dark:bg-zinc-800">
    {{ $slot }}
</body>
</html>
