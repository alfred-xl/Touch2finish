<x-layout>
    <x-slot name="seo">
        @php
            $serviceSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $service['title'],
                'description' => $service['seo_description'],
                'url' => route('services.show', ['slug' => $service['slug']]),
                'provider' => [
                    '@type' => 'LocalBusiness',
                    '@id' => route('home') . '#business',
                    'name' => $business['name'],
                    'url' => route('home'),
                    'telephone' => $business['phone_display'],
                    'email' => $business['email'],
                ],
            ];
            $hasServiceImage = !empty($service['hero_image']) && is_file(public_path($service['hero_image']));
            if ($hasServiceImage) {
                $serviceSchema['image'] = asset($service['hero_image']);
            }
        @endphp
        @include('partials.seo', [
            'title' => $service['seo_title'],
            'description' => $service['seo_description'],
            'canonical' => route('services.show', ['slug' => $service['slug']]),
            'ogImage' => $hasServiceImage ? asset($service['hero_image']) : asset('images/og-default.jpeg'),
            'schema' => $serviceSchema,
        ])
    </x-slot>

    <section class="section-shell bg-touch-surface">
        <div class="site-container">
            <nav aria-label="Breadcrumb" class="flex flex-wrap items-center gap-2 text-xs font-semibold text-touch-muted">
                <a href="{{ route('home') }}" class="hover:text-touch-deep">Home</a><i data-lucide="chevron-right" class="h-3 w-3" aria-hidden="true"></i>
                <a href="{{ route('services.index') }}" class="hover:text-touch-deep">Services</a><i data-lucide="chevron-right" class="h-3 w-3" aria-hidden="true"></i>
                <span class="text-touch-dark" aria-current="page">{{ $service['title'] }}</span>
            </nav>
            <div class="mt-10 grid items-center gap-10 lg:grid-cols-[1.08fr_.92fr] lg:gap-16">
                <div data-reveal="fade-up"><p class="eyebrow">{{ $service['eyebrow'] }}</p><h1 class="mt-5 max-w-3xl font-display text-4xl font-extrabold leading-tight text-touch-dark sm:text-5xl">{{ $service['title'] }}</h1><p class="mt-6 max-w-2xl text-base leading-7 text-touch-muted sm:text-lg">{{ $service['summary'] }}</p><div class="mt-8 flex flex-col gap-3 sm:flex-row"><a href="{{ route('home', ['service' => $service['slug']]) }}#contact" class="btn-primary">Get a Free Quote</a><a href="https://wa.me/{{ $business['whatsapp'] }}" class="btn-secondary">WhatsApp Us</a></div></div>
                @if ($hasServiceImage)
                    <div class="service-image-frame" data-reveal="fade-in"><img src="{{ asset($service['hero_image']) }}" alt="{{ $service['image_alt'] }}" width="1600" height="1200" loading="eager" fetchpriority="high" style="object-position: {{ $service['image_position'] }}"></div>
                @else
                    {{-- Add genuine service imagery through hero_image in config when an approved asset is available. --}}
                    <div class="service-hero-fallback" aria-label="{{ $service['title'] }} service"><i data-lucide="{{ $service['icon'] }}" class="h-16 w-16 text-touch-gold" aria-hidden="true"></i><span class="mt-5 font-display text-lg font-semibold text-touch-dark">{{ $service['title'] }}</span><span class="mt-2 text-sm text-touch-muted">{{ $business['tagline'] }}</span></div>
                @endif
            </div>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
            <div><p class="eyebrow">About This Service</p><h2 class="mt-5 section-heading">Support shaped around the requirement.</h2></div>
            <div class="space-y-5">@foreach ($service['introduction'] as $paragraph)<p class="text-base leading-7 text-touch-muted sm:text-lg">{{ $paragraph }}</p>@endforeach</div>
        </div>
    </section>

    <section class="section-shell bg-touch-soft">
        <div class="site-container grid gap-12 lg:grid-cols-2 lg:gap-20">
            <div><p class="eyebrow">What It Can Include</p><h2 class="mt-5 section-heading">An agreed scope for the service.</h2><ul class="mt-8 grid gap-3 sm:grid-cols-2">@foreach ($service['inclusions'] as $item)<li class="flex items-start gap-2 text-sm leading-6 text-touch-text"><i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>{{ $item }}</li>@endforeach</ul>@if ($service['inclusions_note'])<p class="mt-7 border-l-2 border-touch-gold pl-4 text-sm font-semibold leading-6 text-touch-dark">{{ $service['inclusions_note'] }}</p>@endif @if (!empty($service['safety_note']))<p class="mt-7 rounded-md border border-touch-border bg-white p-4 text-sm leading-6 text-touch-text"><strong>Safety note:</strong> {{ $service['safety_note'] }}</p>@endif</div>
            <div><p class="eyebrow">Suitable For</p><h2 class="mt-5 section-heading">Customers and spaces we can review.</h2><ul class="mt-8 divide-y divide-touch-border border-y border-touch-border">@foreach ($service['suitable_for'] as $item)<li class="py-3 text-sm text-touch-text">{{ $item }}</li>@endforeach</ul></div>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container grid gap-12 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
            <div data-reveal="fade-up"><p class="eyebrow">For Your Quotation</p><h2 class="mt-5 section-heading">Information that helps us assess the work.</h2><p class="mt-5 text-base leading-7 text-touch-muted">Share as much relevant information as possible. You can attach up to four photographs to the quotation form or send additional images through WhatsApp.</p></div>
            <ul class="grid gap-x-8 gap-y-3 sm:grid-cols-2">@foreach ($service['quote_requirements'] as $item)<li class="flex items-start gap-3 border-b border-touch-border pb-3 text-sm text-touch-text"><span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-touch-gold" aria-hidden="true"></span>{{ $item }}</li>@endforeach</ul>
        </div>
    </section>

    <section class="section-shell bg-touch-dark text-white">
        <div class="site-container"><p class="eyebrow">Service Process</p><h2 class="mt-5 font-display text-3xl font-bold text-white sm:text-4xl">From enquiry to final review.</h2><ol class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">@foreach ($service['process'] as $index => $step)<li class="border-l border-white/20 pl-5"><span class="text-xs font-bold tracking-widest text-touch-gold">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3 class="mt-4 font-display text-base font-semibold text-white">{{ $step }}</h3></li>@endforeach</ol></div>
    </section>

    <section class="section-shell bg-touch-surface">
        <div class="site-container"><div class="max-w-3xl"><p class="eyebrow">Frequently Asked Questions</p><h2 class="mt-5 section-heading">Important details about {{ strtolower($service['short_title']) }}.</h2></div><x-site.faq :faqs="$service['faqs']" /></div>
    </section>

    @if ($relatedServices)
        <section class="section-shell bg-white"><div class="site-container"><p class="eyebrow">Related Services</p><h2 class="mt-5 section-heading">Other ways Touch2finish can help.</h2><div class="mt-8 divide-y divide-touch-border border-y border-touch-border">@foreach ($relatedServices as $related)<a href="{{ route('services.show', ['slug' => $related['slug']]) }}" class="flex min-h-[70px] items-center justify-between gap-5 py-4 text-touch-dark hover:text-touch-deep"><span><span class="font-display font-semibold">{{ $related['title'] }}</span><span class="mt-1 block text-sm font-normal text-touch-muted">{{ $related['summary'] }}</span></span><i data-lucide="arrow-right" class="h-5 w-5 shrink-0" aria-hidden="true"></i></a>@endforeach</div></div></section>
    @endif

    <section class="bg-touch-soft py-14 sm:py-16"><div class="site-container flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between"><div><h2 class="font-display text-2xl font-bold text-touch-dark sm:text-3xl">{{ $service['cta_heading'] }}</h2><p class="mt-3 max-w-2xl text-base leading-7 text-touch-muted">{{ $service['cta_copy'] }}</p></div><div class="flex flex-col gap-3 sm:flex-row"><a href="{{ route('home', ['service' => $service['slug']]) }}#contact" class="btn-primary">Get a Free Quote</a><a href="tel:{{ $business['phone_href'] }}" class="btn-secondary">{{ $business['phone_display'] }}</a></div></div></section>
</x-layout>
