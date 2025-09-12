@props([
    'title' => 'Joey Kudish',
    'description' => 'Expert Laravel developer and AI automation consultant helping businesses build scalable web applications and automate workflows.',
    'keywords' => 'Joey Kudish, software developer, Laravel expert, AI automation, web development, consultant',
    'image' => null,
    'imageAlt' => null,
    'type' => 'website',
    'author' => 'Joey Kudish',
    'robots' => 'index, follow',
    'appendSiteName' => true,
    'siteName' => 'Joey Kudish',
    'locale' => 'en_US',
    'twitterHandle' => null,
    'structuredData' => null,
    'canonicalUrl' => null,
])

@php
    // Generate full title
    $fullTitle = $appendSiteName && $title !== $siteName 
        ? $title . ' - ' . $siteName 
        : $title;
    
    // Use default OG image if none provided
    $ogImage = $image ?? asset('img/social/og-default.jpg');
    $ogImageAlt = $imageAlt ?? $description;
    
    // Generate canonical URL if not provided
    $canonical = $canonicalUrl ?? url()->current();
@endphp

{{-- Basic Meta Tags --}}
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="{{ $robots }}">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:alt" content="{{ $ogImageAlt }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@if($twitterHandle)
    <meta name="twitter:site" content="{{ $twitterHandle }}">
    <meta name="twitter:creator" content="{{ $twitterHandle }}">
@endif

{{-- Structured Data / JSON-LD --}}
@if($structuredData)
    <script type="application/ld+json">
    {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endif