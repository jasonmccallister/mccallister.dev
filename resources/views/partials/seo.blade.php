@php
    $seo = $seo ?? [
        'title' => \App\Support\Seo::documentTitle(),
        'description' => config('site.tagline'),
        'type' => 'website',
        'image' => \App\Support\Seo::absoluteImage(config('site.default_og_image')),
        'canonical' => url()->current(),
        'jsonLd' => [],
    ];
    $hasImage = filled($seo['image'] ?? null);
@endphp

<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">
@if (\App\Support\LaravelCloudHost::matchesRequest())
    <meta name="robots" content="noindex, nofollow">
@endif
<link rel="canonical" href="{{ $seo['canonical'] }}">
<link rel="describedby" href="{{ url('/llms.txt') }}">

<meta property="og:site_name" content="{{ config('site.name') }}">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="{{ $seo['type'] }}">
<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:url" content="{{ $seo['canonical'] }}">
@if ($hasImage)
    <meta property="og:image" content="{{ $seo['image'] }}">
@endif

<meta name="twitter:card" content="{{ $hasImage ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $seo['title'] }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
@if ($hasImage)
    <meta name="twitter:image" content="{{ $seo['image'] }}">
@endif

@foreach ($seo['jsonLd'] ?? [] as $graph)
    <script type="application/ld+json">{!! json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
@endforeach
