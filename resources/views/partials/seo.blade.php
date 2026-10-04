@php
    $siteName = config('touch2finish.business.name');
    $pageTitle = isset($title)
        ? trim((string) $title)
        : 'Touch2Finish | Valeting, Cleaning, Removals and Property Services';
    $pageDesc = isset($description)
        ? trim((string) $description)
        : 'Touch2Finish provides mobile car valeting, domestic and commercial cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses.';
    $canonical = \App\Support\Seo::url(isset($canonical) ? trim((string) $canonical) : request()->getPathInfo());
    $ogImage = \App\Support\Seo::url(isset($ogImage) ? trim((string) $ogImage) : '/images/og-default.jpeg');
    $imagePath = public_path(ltrim(parse_url($ogImage, PHP_URL_PATH), '/'));
    $imageSize = is_file($imagePath) ? getimagesize($imagePath) : false;
    $robots = isset($robots) ? trim((string) $robots) : 'index, follow';

    $schemaJson = null;
    if (!empty($schema)) {
        $decoded = is_array($schema) ? $schema : json_decode($schema, true);
        $schemaJson = json_encode($decoded, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR);
    }
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDesc }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">
<link rel="sitemap" type="application/xml" title="Sitemap" href="{{ \App\Support\Seo::route('sitemap') }}">

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
@if ($imageSize)
<meta property="og:image:width" content="{{ $imageSize[0] }}">
<meta property="og:image:height" content="{{ $imageSize[1] }}">
@endif
<meta property="og:image:alt" content="{{ $siteName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDesc }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $siteName }}">
<meta name="theme-color" content="#03403F">

@if ($schemaJson)
    <script type="application/ld+json">
{!! $schemaJson !!}
</script>
@endif
