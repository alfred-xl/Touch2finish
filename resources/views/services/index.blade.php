<x-layout>
    <x-slot name="seo">
        @include('partials.seo', [
            'title' => 'Services | Touch2finish',
            'description' => 'Explore mobile valeting, cleaning, removals, handyman and refurbishment services from Touch2finish for homes, vehicles and businesses.',
            'canonical' => route('services.index'),
        ])
    </x-slot>

    <section class="section-shell bg-touch-surface">
        <div class="site-container grid items-center gap-10 lg:grid-cols-[1.08fr_.92fr] lg:gap-16">
            <div>
                <p class="eyebrow">Our Services</p>
                <h1 class="mt-5 max-w-3xl font-display text-4xl font-extrabold leading-tight text-touch-dark sm:text-5xl">Professional support for your vehicle, property and move.</h1>
                <p class="mt-6 max-w-2xl text-base leading-7 text-touch-muted sm:text-lg">Touch2finish provides mobile valeting, cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses, primarily across London.</p>
                <p class="mt-4 max-w-2xl text-base leading-7 text-touch-muted">Customers can request one service or discuss a coordinated requirement involving several compatible services.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('home') }}#contact" class="btn-primary">Get a Free Quote</a>
                    <a href="tel:{{ $business['phone_href'] }}" class="btn-secondary">Call Touch2finish</a>
                </div>
            </div>
            <div class="service-overview-visual" aria-label="Touch2finish service categories">
                @foreach ($services as $service)
                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-touch-dark"><i data-lucide="{{ $service['icon'] }}" class="h-5 w-5 text-touch-gold" aria-hidden="true"></i>{{ $service['short_title'] }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow">Choose a Service</p><h2 class="mt-5 section-heading">Five practical services, one clear point of contact.</h2></div>
            <div class="mt-12 divide-y divide-touch-border border-y border-touch-border">
                @foreach ($services as $index => $service)
                    @php
                        $hasImage = !empty($service['thumbnail_image']) && is_file(public_path($service['thumbnail_image']));
                    @endphp
                    <article class="service-summary-row">
                        <div data-reveal="{{ $loop->index % 2 === 1 ? 'slide-left' : 'slide-right' }}" class="{{ $loop->index % 2 === 1 ? 'lg:order-2' : '' }}">
                            <span class="text-xs font-bold tracking-[0.18em] text-touch-gold">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="mt-3 font-display text-2xl font-bold text-touch-dark sm:text-3xl">{{ $service['title'] }}</h3>
                            <p class="mt-4 max-w-xl text-base leading-7 text-touch-muted">{{ $service['summary'] }}</p>
                            <ul class="mt-6 grid gap-2 sm:grid-cols-2">
                                @foreach (array_slice($service['inclusions'], 0, 6) as $inclusion)
                                    <li class="flex items-start gap-2 text-sm text-touch-text"><i data-lucide="check" class="mt-0.5 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>{{ $inclusion }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('services.show', ['slug' => $service['slug']]) }}" class="btn-text mt-6">Explore {{ $service['short_title'] }} <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i></a>
                        </div>
                        @if ($hasImage)
                            <div data-reveal="{{ $loop->index % 2 === 1 ? 'slide-right' : 'slide-left' }}" class="service-image-frame {{ $loop->index % 2 === 1 ? 'lg:order-1' : '' }}"><img src="{{ asset($service['thumbnail_image']) }}" alt="{{ $service['image_alt'] }}" width="1200" height="900" loading="lazy" style="object-position: {{ $service['image_position'] }}"></div>
                        @else
                            <div data-reveal="fade-up" class="service-summary-visual {{ $loop->index % 2 === 1 ? 'lg:order-1' : '' }}" aria-hidden="true"><i data-lucide="{{ $service['icon'] }}" class="h-14 w-14 text-touch-gold"></i><span class="mt-4 font-display text-sm font-semibold text-touch-dark">{{ $service['title'] }}</span></div>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-soft">
        <div class="site-container">
            <div class="max-w-2xl"><p class="eyebrow">Clean. Move. Improve.</p><h2 class="mt-5 section-heading">A simple way to understand the service range.</h2></div>
            @php
                $groups = [
                    ['Clean', ['mobile-car-valeting', 'domestic-commercial-cleaning']],
                    ['Move', ['removals-man-and-van']],
                    ['Improve', ['handyman-property-maintenance', 'refurbishment-decorating']],
                ];
            @endphp
            <div class="mt-10 grid gap-8 lg:grid-cols-3 lg:divide-x lg:divide-touch-border">
                @foreach ($groups as [$group, $slugs])
                    <div class="lg:px-8 first:lg:pl-0"><h3 class="font-display text-2xl font-bold text-touch-dark">{{ $group }}</h3><ul class="mt-4 space-y-3">@foreach ($slugs as $slug)<li><a href="{{ route('services.show', ['slug' => $slug]) }}" class="text-sm font-semibold text-touch-text hover:text-touch-deep">{{ $services[$slug]['title'] }}</a></li>@endforeach</ul></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-dark text-white">
        <div class="site-container grid gap-10 lg:grid-cols-2 lg:gap-20">
            <div><p class="eyebrow">Combined Services</p><h2 class="mt-5 font-display text-3xl font-bold text-white sm:text-4xl">Need more than one service?</h2><p class="mt-5 text-base leading-7 text-white/75">Some requirements involve several connected tasks. Touch2finish can review compatible services and help organise the work through one point of contact.</p><a href="{{ route('home', ['service' => 'combined-services']) }}#contact" class="btn-primary mt-8">Discuss a Combined Service</a></div>
            <ul class="divide-y divide-white/15 border-y border-white/15">@foreach (['Removals and furniture assembly', 'Cleaning and minor repairs', 'Decorating and post-work cleaning', 'Office relocation and commercial cleaning'] as $example)<li class="py-4 text-sm text-white/80">{{ $example }}</li>@endforeach</ul>
        </div>
    </section>
</x-layout>
