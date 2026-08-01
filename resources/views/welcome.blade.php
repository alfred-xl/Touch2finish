<x-layout>
    @php
        $business = config('touch2finish.business');
        $services = config('touch2finish.services', []);
        $preferredHero = 'images/services/touch2finish-hero.webp';
        $heroImage = is_file(public_path($preferredHero)) ? $preferredHero : 'images/og-default.jpeg';
        $heroAlt = $heroImage === $preferredHero
            ? 'Representative furniture assembly using a power drill.'
            : 'Touch2finish property, vehicle and moving services.';
    @endphp

    <x-slot name="seo">
        @php
            $homeSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                '@id' => url('/') . '#business',
                'name' => $business['name'],
                'description' => 'Mobile car valeting, cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses.',
                'url' => url('/'),
                'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo.png')],
                'image' => asset($heroImage),
                'telephone' => $business['phone_display'],
                'email' => $business['email'],
                'areaServed' => ['@type' => 'City', 'name' => 'London'],
            ];
        @endphp
        @include('partials.seo', [
            'title' => 'Touch2finish | Valeting, Cleaning, Removals and Property Services',
            'description' => 'Touch2finish provides mobile car valeting, domestic and commercial cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses.',
            'canonical' => url('/'),
            'ogImage' => asset($heroImage),
            'schema' => $homeSchema,
        ])
    </x-slot>

    <section class="bg-touch-surface">
        <div class="site-container grid items-center gap-10 py-12 sm:py-14 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:py-16">
            <div data-reveal="fade-up">
                <p class="eyebrow">London Valeting, Cleaning, Removals and Property Services</p>
                <h1 class="mt-5 max-w-2xl font-display text-4xl font-extrabold leading-[1.08] text-touch-dark sm:text-5xl lg:text-6xl">Clean. Move. Improve.</h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-touch-text sm:text-lg">Mobile valeting, cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses across London.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <a href="/#contact" class="btn-primary">Get a Free Quote</a>
                    <a href="{{ route('services.index') }}" class="btn-secondary">Explore Services</a>
                </div>
                <div class="mt-7 text-sm text-touch-muted">
                    <span>Prefer to speak with us directly?</span>
                    <a href="tel:{{ $business['phone_href'] }}" class="ml-1 font-semibold text-touch-dark underline decoration-touch-gold decoration-2 underline-offset-4 hover:text-touch-deep">Call {{ $business['phone_display'] }}</a>
                </div>
            </div>
            <div class="hero-media" data-reveal="fade-in">
                <img src="{{ asset($heroImage) }}" alt="{{ $heroAlt }}" width="1600" height="1200" loading="eager" fetchpriority="high">
            </div>
        </div>
    </section>

    <section class="trust-strip" aria-label="Service assurances">
        <div class="site-container grid grid-cols-1 divide-y divide-touch-border sm:grid-cols-2 sm:divide-y-0 lg:grid-cols-4 lg:divide-x">
            @foreach ([['file-check-2', 'Free Quotations', 'No-obligation initial enquiry'], ['building-2', 'Residential & Commercial', 'Services for homes and businesses'], ['calendar-clock', 'Flexible Scheduling', 'Arranged around availability'], ['clock-3', 'Response Within 24 Hours', 'During normal working periods']] as [$icon, $title, $description])
                <div class="trust-item"><span class="trust-icon"><i data-lucide="{{ $icon }}" class="h-4 w-4" aria-hidden="true"></i></span><div><h2 class="text-sm font-bold text-touch-dark">{{ $title }}</h2><p class="mt-1 text-xs leading-5 text-touch-muted">{{ $description }}</p></div></div>
            @endforeach
        </div>
    </section>

    <section id="about" class="scroll-mt-20 bg-white py-12 sm:py-14 lg:py-16">
        <div class="site-container grid gap-5 lg:grid-cols-[.7fr_1.3fr] lg:items-start lg:gap-16" data-reveal="fade-up">
            <div><p class="eyebrow">About Touch2finish</p><h2 class="mt-5 max-w-xl font-display text-3xl font-bold leading-tight text-touch-dark sm:text-4xl">One dependable team for practical everyday services.</h2></div>
            <div class="max-w-2xl"><p class="text-base leading-7 text-touch-muted sm:text-lg">Touch2finish brings related vehicle, moving, cleaning and property services together so customers can organise the work through one clear point of contact.</p><a href="/#how-it-works" class="btn-text mt-5">See how the process works <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i></a></div>
        </div>
    </section>

    <section id="services" class="section-shell scroll-mt-20 bg-touch-surface">
        <div class="site-container">
            <div class="max-w-3xl" data-reveal="fade-up"><p class="eyebrow">Our Services</p><h2 class="mt-5 section-heading">Choose the service you need.</h2><p class="mt-5 max-w-2xl text-base leading-7 text-touch-muted sm:text-lg">Select a service to view the details or begin a quotation with the service already selected.</p></div>
            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-6">
                @foreach ($services as $service)
                    @php
                        $serviceImage = !empty($service['thumbnail_image']) && is_file(public_path($service['thumbnail_image'])) ? $service['thumbnail_image'] : null;
                    @endphp
                    <article data-reveal="fade-up" data-reveal-delay="{{ ($loop->index % 3) * 80 }}" class="flex h-full flex-col overflow-hidden rounded-lg border border-touch-border bg-white md:min-h-full lg:col-span-2 {{ $loop->iteration === 4 ? 'lg:col-start-2' : '' }}">
                        @if ($serviceImage)
                            <div class="aspect-[16/10] overflow-hidden bg-touch-soft"><img src="{{ asset($serviceImage) }}" alt="{{ $service['image_alt'] }}" width="800" height="600" loading="lazy" class="h-full w-full object-cover" style="object-position: {{ $service['image_position'] }}"></div>
                        @else
                            <div class="flex aspect-[16/10] items-center justify-center bg-touch-soft" aria-hidden="true"><i data-lucide="{{ $service['icon'] }}" class="h-12 w-12 text-touch-gold"></i></div>
                        @endif
                        <div class="flex flex-1 flex-col p-5 sm:p-6"><h3 class="font-display text-xl font-bold text-touch-dark">{{ $service['title'] }}</h3><p class="mt-3 text-sm leading-6 text-touch-muted">{{ $service['summary'] }}</p><div class="mt-auto flex flex-wrap gap-x-5 gap-y-2 pt-5"><a href="{{ route('services.show', ['slug' => $service['slug']]) }}" class="text-sm font-bold text-touch-dark underline decoration-touch-gold decoration-2 underline-offset-4">View Service</a><a href="{{ route('home', ['service' => $service['slug']]) }}#contact" class="text-sm font-bold text-touch-deep underline underline-offset-4">Get Quote</a></div></div>
                    </article>
                @endforeach
            </div>
            <div class="mt-9 text-center"><a href="{{ route('services.index') }}" class="btn-secondary">View All Services</a></div>
        </div>
    </section>

    @php
        $steps = [
            ['Tell us what you need', 'Select a service and share your postcode, preferred date and useful details.'],
            ['Review your quotation', 'We assess the requirement and confirm the service scope, quotation and next step.'],
            ['Confirm and complete', 'Once approved, the work is arranged, completed and checked against the agreed scope.'],
        ];
    @endphp
    <section id="how-it-works" class="section-shell scroll-mt-20 bg-white">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow">How It Works</p><h2 class="mt-5 section-heading">Simple from enquiry to completion.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Tell us what you need, review the quotation and confirm the agreed service.</p></div>
            <ol class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ($steps as $index => [$title, $copy])
                    <li data-reveal="fade-up" data-reveal-delay="{{ $index * 80 }}" class="border-t-2 border-touch-gold pt-6"><span class="text-xs font-bold tracking-[0.18em] text-touch-gold">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3 class="mt-3 font-display text-xl font-semibold text-touch-dark">{{ $title }}</h3><p class="mt-3 text-sm leading-7 text-touch-muted">{{ $copy }}</p></li>
                @endforeach
            </ol>
            <ul class="mt-9 flex flex-col gap-3 border-y border-touch-border py-5 sm:flex-row sm:items-center sm:justify-center sm:gap-8">
                @foreach (['Clear service scope', 'Careful handling', 'Final service review'] as $reassurance)
                    <li class="flex items-center gap-2 text-sm font-semibold text-touch-dark"><i data-lucide="check" class="h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>{{ $reassurance }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="bg-[#03403F] py-12 text-white sm:py-14" data-reveal="fade-up">
        <div class="site-container grid gap-8 lg:grid-cols-[1.2fr_.8fr] lg:items-center lg:gap-16">
            <div><p class="eyebrow">London Coverage</p><h2 class="mt-4 font-display text-3xl font-bold leading-tight text-white sm:text-4xl">One service or several &mdash; available across London.</h2><p class="mt-4 max-w-3xl text-base leading-7 text-white/75">Request one service or combine compatible services such as removals, furniture assembly and cleaning. Touch2finish primarily serves customers across London, while other locations may also be considered depending on the requirement.</p><div class="mt-7 flex flex-col gap-3 sm:flex-row"><a href="/#contact" class="btn-primary">Check Your Postcode</a><a href="{{ route('areas') }}" class="inline-flex min-h-[46px] items-center justify-center rounded-md border border-white/50 px-6 py-3 text-sm font-bold text-white transition hover:border-touch-gold hover:text-touch-gold">Areas We Cover</a></div></div>
            <ul class="divide-y divide-white/15 border-y border-white/15">
                @foreach (['Removals and furniture assembly', 'Cleaning and minor repairs', 'Decorating and post-work cleaning'] as $example)
                    <li class="flex items-center gap-3 py-3 text-sm text-white/85"><i data-lucide="check" class="h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>{{ $example }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section id="contact" class="section-shell scroll-mt-20 bg-touch-surface">
        <div class="site-container grid gap-10 lg:grid-cols-[.72fr_1.28fr] lg:gap-16">
            <div data-reveal="fade-up"><p class="eyebrow">Request a Quote</p><h2 class="mt-5 section-heading">Get your free quotation.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Tell us the service, postcode and preferred date. Add photographs where they help explain the work.</p>
                <div class="mt-8 divide-y divide-touch-border border-y border-touch-border">
                    @foreach ([['phone', 'Phone', $business['phone_display'], 'tel:' . $business['phone_href']], ['message-circle', 'WhatsApp', 'Message Touch2finish', 'https://wa.me/' . $business['whatsapp']]] as [$icon, $label, $value, $href])
                        <a href="{{ $href }}" class="contact-method"><i data-lucide="{{ $icon }}" class="h-5 w-5 text-touch-gold" aria-hidden="true"></i><span><span class="block text-xs font-bold uppercase tracking-widest text-touch-muted">{{ $label }}</span><span class="mt-1 block text-sm font-semibold text-touch-dark">{{ $value }}</span></span></a>
                    @endforeach
                </div>
                <p class="mt-6 flex items-start gap-2 text-sm leading-6 text-touch-muted"><i data-lucide="clock-3" class="mt-1 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>Response within 24 hours during normal working periods.</p>
            </div>
            <div><x-site.quote-form /></div>
        </div>
    </section>

    @php
        $faqs = [
            ['question' => 'Which areas do you cover?', 'answer' => 'Touch2finish primarily serves customers across London. Other locations may be considered depending on the service, travel distance, job size and availability. Send us your postcode so the team can confirm coverage.'],
            ['question' => 'Are quotations free?', 'answer' => 'Yes. Initial quotations are free and carry no obligation. Some larger or combined-service requirements may need additional information before final pricing.'],
            ['question' => 'How quickly will I receive a response?', 'answer' => 'We aim to respond to enquiries within 24 hours during normal working periods.'],
            ['question' => 'Can I combine several services?', 'answer' => 'Yes. Compatible services can be combined, such as removals, furniture assembly and cleaning.'],
        ];
    @endphp
    <section class="bg-white py-12 sm:py-14">
        <div class="site-container">
            <div class="max-w-3xl" data-reveal="fade-up"><p class="eyebrow">Frequently Asked Questions</p><h2 class="mt-5 section-heading">Useful information before you enquire.</h2></div>
            <x-site.faq :faqs="$faqs" />
        </div>
    </section>

    @if (session('quote_success'))
        <dialog x-data x-init="$nextTick(() => { $el.showModal(); $refs.closeButton.focus() })" aria-labelledby="quote-success-title" aria-describedby="quote-success-description" class="m-auto w-[calc(100%-2rem)] max-w-lg rounded-lg border border-touch-border bg-white p-0 text-touch-text shadow-2xl backdrop:bg-touch-dark/70">
            <div class="p-6 sm:p-8"><p class="eyebrow">Request Received</p><h2 id="quote-success-title" class="mt-4 font-display text-2xl font-bold text-touch-dark">Quote request sent</h2><p id="quote-success-description" class="mt-4 text-sm leading-7 text-touch-muted">Thank you. Your quotation request has been submitted successfully.</p><div class="mt-6 rounded-md bg-touch-soft p-5"><p class="text-xs font-bold uppercase tracking-widest text-touch-muted">Your reference</p><p class="mt-2 break-all font-display text-2xl font-bold text-touch-dark">{{ session('quote_success.reference') }}</p></div><p class="mt-5 text-sm leading-7 text-touch-muted">We aim to respond within 24 hours during normal working periods. Submitting a quotation request does not confirm a booking, price or service date.</p><button x-ref="closeButton" type="button" class="btn-primary mt-6 w-full" @click="$el.closest('dialog').close()">Close</button></div>
        </dialog>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak class="fixed bottom-24 right-4 z-[60] max-w-sm rounded-md border border-red-300 bg-white p-5 text-touch-text shadow-lg md:bottom-6 md:right-6" role="alert" aria-live="assertive">
            <div class="flex items-start gap-3"><i data-lucide="circle-alert" class="h-5 w-5 shrink-0 text-red-600" aria-hidden="true"></i><div><p class="font-semibold text-touch-dark">Quote request not sent</p><p class="mt-1 text-sm leading-6 text-touch-muted">{{ session('error') }}</p></div><button type="button" @click="show = false" class="ml-auto p-1 text-touch-muted hover:text-touch-dark" aria-label="Dismiss notification"><i data-lucide="x" class="h-4 w-4" aria-hidden="true"></i></button></div>
        </div>
    @endif
</x-layout>
