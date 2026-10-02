@php
    use App\Support\Nav;

    $locale   = app()->getLocale();
    $title    = trim($__env->yieldContent('title')) ?: __('site.meta.default_title');
    $desc     = trim($__env->yieldContent('description')) ?: __('site.meta.default_description');
    $canonical = $alternates[$locale]['url'] ?? url()->current();
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#07080a">

<title>{{ $title }}</title>
<meta name="description" content="{{ $desc }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- hreflang. Four near-identical pages without these look like duplicate
     content; with them they look like one site that speaks four languages. --}}
@foreach ($alternates as $alt)
    <link rel="alternate" hreflang="{{ $alt['tag'] }}" href="{{ $alt['url'] }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ $alternates[Nav::fallback()]['url'] ?? $canonical }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('stvr.name') }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:locale" content="{{ str_replace('-', '_', $alternates[$locale]['tag'] ?? $locale) }}">
<meta property="og:image" content="{{ url('/og.png') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ config('stvr.name') }}">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="{{ url('/favicon.svg') }}" type="image/svg+xml">
<link rel="icon" href="{{ url('/icon-192.png') }}" sizes="192x192" type="image/png">
<link rel="apple-touch-icon" href="{{ url('/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ url('/site.webmanifest') }}">

{{-- Fonts are self-hosted, so they preload from our own origin and the page
     makes no third-party request at all — which also means no cookie banner. --}}
<link rel="preload" as="style" href="@assetv('assets/css/fonts.css')">
<link rel="stylesheet" href="@assetv('assets/css/fonts.css')">
<link rel="stylesheet" href="@assetv('assets/css/site.css')">

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => config('stvr.name'),
    'applicationCategory' => 'GameApplication',
    'operatingSystem' => 'Windows',
    'description' => $desc,
    'url' => $canonical,
    'image' => url('/og.png'),
    'license' => config('stvr.links.licence'),
    'isAccessibleForFree' => true,
    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'inLanguage' => array_column($alternates, 'tag'),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
