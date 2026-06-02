@php
    $siteName = config('app.name', 'Touch2finish');
    $pageTitle = isset($title)
        ? trim((string) $title)
        : 'Touch2finish | Premium Trade Services — Standard is Everything';
    $pageDesc = isset($description)
        ? trim((string) $description)
        : 'Touch2finish provides premium removals, handyman, car valeting, interior decor, refurbishment, real estate development, and cleaning services across the UK.';
    $canonical = isset($canonical) ? trim((string) $canonical) : url()->current();
    $ogImage = isset($ogImage) ? trim((string) $ogImage) : asset('images/og-default.jpeg');
    $robots = isset($robots) ? trim((string) $robots) : 'index, follow';

    $schemaJson = null;
    if (!empty($schema)) {
        $decoded = is_array($schema) ? $schema : json_decode($schema, true);
        $schemaJson = json_encode($decoded, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDesc }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

<link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('images/favicon-32.png') }}" sizes="32x32">
<link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}" sizes="180x180">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_GB">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDesc }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $siteName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDesc }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $siteName }}">

<meta name="theme-color" content="#071B3B">

@if ($schemaJson)
    <script type="application/ld+json">
{!! $schemaJson !!}
</script>
@endif
