<x-layout>
    @php
        $business = config('touch2finish.business');
        $preferredHero = 'images/services/touch2finish-hero.webp';
        $heroImage = is_file(public_path($preferredHero)) ? $preferredHero : 'images/og-default.jpeg';
        $heroAlt = $heroImage === $preferredHero ? 'Representative furniture assembly using a power drill.' : 'Touch2finish property, vehicle and moving services.';
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
        <div class="site-container grid items-center gap-10 py-14 sm:py-16 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:py-20">
            <div data-reveal="fade-up">
                <p class="eyebrow">Valeting, Cleaning, Removals and Property Services</p>
                <h1 class="mt-5 max-w-2xl font-display text-4xl font-extrabold leading-[1.08] text-touch-dark sm:text-5xl lg:text-6xl">Clean. Move. Improve.</h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-touch-text sm:text-lg">Professional mobile valeting, cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses.</p>
                <p class="mt-4 max-w-xl text-base leading-7 text-touch-muted">Whether you need your vehicle refreshed, your property cleaned, your belongings moved or your space improved, Touch2finish helps manage the work from enquiry to completion.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <a href="/#contact" class="btn-primary">Get a Free Quote</a>
                    <a href="/#services" class="btn-secondary">Explore Our Services</a>
                </div>
                <div class="mt-7 text-sm text-touch-muted">
                    <span>Prefer to speak with us directly?</span>
                    <a href="tel:{{ $business['phone_href'] }}" class="ml-1 font-semibold text-touch-dark underline decoration-touch-gold decoration-2 underline-offset-4 hover:text-touch-deep">Call {{ $business['phone_display'] }}</a>
                </div>
            </div>
            {{-- Temporary media remains in use until the approved local Touch2finish hero WebP is supplied. --}}
            <div class="hero-media" data-reveal="fade-in"><img src="{{ asset($heroImage) }}" alt="{{ $heroAlt }}" width="1600" height="1200" loading="eager" fetchpriority="high"></div>
        </div>
    </section>

    <section class="trust-strip" aria-label="Service assurances">
        <div class="site-container grid grid-cols-1 divide-y divide-touch-border sm:grid-cols-2 sm:divide-y-0 lg:grid-cols-4 lg:divide-x">
            @foreach ([['file-check-2', 'Free Quotations', 'No-obligation initial enquiry'], ['building-2', 'Residential & Commercial', 'Services for homes and businesses'], ['calendar-clock', 'Flexible Scheduling', 'Arranged around availability'], ['clock-3', 'Response Within 24 Hours', 'During normal working periods']] as [$icon, $title, $description])
                <div class="trust-item"><span class="trust-icon"><i data-lucide="{{ $icon }}" class="h-4 w-4" aria-hidden="true"></i></span><div><h2 class="text-sm font-bold text-touch-dark">{{ $title }}</h2><p class="mt-1 text-xs leading-5 text-touch-muted">{{ $description }}</p></div></div>
            @endforeach
        </div>
    </section>

    <section id="about" class="section-shell scroll-mt-20 bg-white">
        <div class="site-container grid gap-8 lg:grid-cols-2 lg:gap-16">
            <div><p class="eyebrow">About Touch2finish</p><h2 class="mt-5 max-w-xl font-display text-3xl font-bold leading-tight text-touch-dark sm:text-4xl">Practical services managed through one dependable team.</h2></div>
            <div class="max-w-2xl">
                <p class="text-base leading-7 text-touch-muted sm:text-lg">Organising a move, cleaning a property, maintaining a vehicle or completing improvements can involve several different providers. Touch2finish makes the process easier by bringing essential services together under one coordinated approach.</p>
                <p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">We support homeowners, tenants, landlords, businesses, vehicle owners and property professionals. Customers can request one individual service or combine compatible services into a wider solution.</p>
                <p class="mt-7 border-l-2 border-touch-gold pl-5 font-display text-base font-semibold leading-7 text-touch-dark sm:text-lg">From the first enquiry to the final service check, our goal is to keep the work clear, organised and straightforward.</p>
            </div>
        </div>
    </section>
    @php
        $services = collect(config('touch2finish.services', []))
            ->map(fn (array $service): array => [
                'title' => $service['title'],
                'icon' => $service['icon'],
                'short' => $service['summary'],
                'detail' => implode(' ', $service['introduction']),
                'inclusions' => array_slice($service['inclusions'], 0, 6),
                'cta' => 'Explore ' . $service['short_title'],
                'href' => route('services.show', ['slug' => $service['slug']]),
                'image' => !empty($service['thumbnail_image']) && is_file(public_path($service['thumbnail_image'])) ? $service['thumbnail_image'] : null,
                'image_alt' => $service['image_alt'],
                'image_position' => $service['image_position'],
            ])
            ->values()
            ->all();
    @endphp
    <section id="services" class="section-shell scroll-mt-20 bg-touch-surface">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow">Our Services</p><h2 class="mt-5 section-heading">Professional support for your vehicle, property and move.</h2><p class="mt-5 max-w-2xl text-base leading-7 text-touch-muted sm:text-lg">Touch2finish provides practical services for homes, vehicles and businesses. Choose the service you need or contact us about combining several services into one coordinated requirement.</p></div>
            <x-site.service-accordion :services="$services" />
        </div>
    </section>

    @php
        $serviceGroups = [
            ['Clean', 'Maintain a clean, presentable home, workplace or vehicle with services arranged around the space, condition and required result.', ['Mobile car valeting', 'Domestic cleaning', 'Commercial cleaning', 'Deep and end-of-tenancy cleaning']],
            ['Move', 'Get practical support for transporting belongings, furniture and business equipment between locations.', ['House and flat removals', 'Office relocation', 'Man-and-van support', 'Furniture and single-item transport']],
            ['Improve', 'Complete practical maintenance, decorating and selected refurbishment work through one organised service provider.', ['Handyman support', 'Furniture assembly', 'Property maintenance', 'Decorating and refurbishment']],
        ];
    @endphp
    <section class="section-shell bg-white">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow">What We Help You Do</p><h2 class="mt-5 section-heading">One clear service structure: Clean. Move. Improve.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Touch2finish brings related services together in a way that is easier to understand and organise. Whether the requirement concerns a vehicle, a move or a property, customers can begin with one clear point of contact.</p></div>
            <div class="mt-12 grid gap-10 border-y border-touch-border py-10 lg:grid-cols-3 lg:divide-x lg:divide-touch-border">
                @foreach ($serviceGroups as $index => [$title, $copy, $items])
                    <article class="lg:px-8 first:lg:pl-0 last:lg:pr-0"><span class="text-xs font-bold tracking-[0.18em] text-touch-gold">0{{ $index + 1 }}</span><h3 class="mt-3 font-display text-2xl font-bold text-touch-dark">{{ $title }}</h3><p class="mt-4 text-sm leading-7 text-touch-muted">{{ $copy }}</p><ul class="mt-6 space-y-2">@foreach ($items as $item)<li class="flex items-start gap-2 text-sm text-touch-text"><span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-touch-gold" aria-hidden="true"></span>{{ $item }}</li>@endforeach</ul></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-dark text-white">
        <div class="site-container grid gap-10 lg:grid-cols-2 lg:gap-20">
            <div><p class="eyebrow">More Than One Service?</p><h2 class="mt-5 font-display text-3xl font-bold leading-tight text-white sm:text-4xl">Combine services and simplify the work.</h2><p class="mt-5 text-base leading-7 text-white/75">Some customer requirements involve more than one task. A move may also require furniture assembly and cleaning. A rental-property turnaround may involve minor repairs, decorating and a final deep clean.</p><p class="mt-4 text-base leading-7 text-white/75">Touch2finish can review the complete requirement and help coordinate compatible services through one point of contact.</p><a href="/#contact" class="btn-primary mt-8">Discuss a Combined Service</a></div>
            <ul class="divide-y divide-white/15 border-y border-white/15">@foreach (['Removals and furniture assembly', 'End-of-tenancy cleaning and minor repairs', 'Decorating and post-work cleaning', 'Move-in cleaning and handyman support', 'Office relocation and commercial cleaning', 'Vehicle valeting for selected business fleets'] as $item)<li class="flex items-center gap-3 py-4 text-sm text-white/85"><i data-lucide="plus" class="h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>{{ $item }}</li>@endforeach</ul>
        </div>
    </section>

    @php
        $steps = [
            ['Tell Us What You Need', 'Complete the quotation form, call us or send a WhatsApp message explaining the required service.'],
            ['Share the Important Details', 'Provide your postcode, preferred date, photographs and relevant property, vehicle or moving information.'],
            ['Receive and Approve the Quotation', 'We review the requirement, request any necessary clarification and provide the appropriate quotation or next step.'],
            ['We Complete and Review the Service', 'Once confirmed, the agreed work is carried out and reviewed against the approved service scope.'],
        ];
    @endphp
    <section id="how-it-works" class="section-shell scroll-mt-20 bg-touch-surface">
        <div class="site-container"><div class="max-w-3xl"><p class="eyebrow">How It Works</p><h2 class="mt-5 section-heading">A clear process from enquiry to completion.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Customers should understand what happens after they contact Touch2finish. Keep the process simple, transparent and easy to follow.</p></div>
            <ol class="process-list mt-12">@foreach ($steps as $index => [$title, $copy])<li class="process-step"><span class="process-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3 class="mt-5 font-display text-lg font-semibold text-touch-dark">{{ $title }}</h3><p class="mt-3 text-sm leading-7 text-touch-muted">{{ $copy }}</p></li>@endforeach</ol>
            <a href="/#contact" class="btn-secondary mt-10">Start Your Quote</a>
        </div>
    </section>

    @php
        $standards = [
            ['Clear Preparation', 'We confirm the service details, location, access requirements and expected work before the appointment.'],
            ['Appropriate Equipment', 'The equipment and materials required for the agreed service are identified during preparation.'],
            ['Careful Handling', 'Vehicles, belongings, property surfaces and customer spaces should be treated with appropriate care.'],
            ['Clear Communication', 'Relevant information is communicated before and during the service.'],
            ['Defined Scope', 'The quotation explains what is included so both the customer and team understand the expected service.'],
            ['Final Review', 'The completed work is checked against the agreed scope before the service is concluded.'],
        ];
    @endphp
    <section class="section-shell bg-white">
        <div class="site-container grid gap-10 lg:grid-cols-[.82fr_1.18fr] lg:gap-20">
            <div><p class="eyebrow">Our Service Approach</p><h2 class="mt-5 section-heading">Prepared properly for the work ahead.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Good service begins before the team arrives. We review the information provided, confirm the practical requirements and prepare for the agreed work.</p></div>
            <ol class="divide-y divide-touch-border border-y border-touch-border">@foreach ($standards as $index => [$title, $copy])<li class="grid gap-3 py-5 sm:grid-cols-[3rem_1fr]"><span class="text-xs font-bold tracking-widest text-touch-gold">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><div><h3 class="font-display text-base font-semibold text-touch-dark">{{ $title }}</h3><p class="mt-2 text-sm leading-6 text-touch-muted">{{ $copy }}</p></div></li>@endforeach</ol>
        </div>
    </section>

    <section id="areas" class="section-shell scroll-mt-20 bg-touch-soft">
        <div class="site-container grid items-center gap-10 lg:grid-cols-[1.15fr_.85fr] lg:gap-20">
            <div><p class="eyebrow">Areas We Cover</p><h2 class="mt-5 section-heading">Services across London.</h2><p class="mt-5 max-w-2xl text-base leading-7 text-touch-muted sm:text-lg">Touch2finish primarily serves customers across London for mobile valeting, cleaning, removals, handyman and refurbishment requirements.</p><p class="mt-4 max-w-2xl text-base leading-7 text-touch-text">Requests outside London may also be considered depending on the required service, travel distance, job size, preferred date and availability.</p></div>
            <div class="postcode-callout"><i data-lucide="map-pin" class="h-8 w-8 text-touch-gold" aria-hidden="true"></i><p class="mt-5 font-display text-xl font-semibold text-touch-dark">Share your postcode</p><p class="mt-2 text-sm leading-6 text-touch-muted">We will check the service, travel requirements and preferred date.</p><div class="mt-6 flex flex-wrap gap-3"><a href="/#contact" class="btn-primary">Check Service Availability</a><a href="{{ route('areas') }}" class="btn-secondary">Areas We Cover</a></div></div>
        </div>
    </section>

    <section id="contact" class="section-shell scroll-mt-20 bg-touch-surface">
        <div class="site-container grid gap-10 lg:grid-cols-[.82fr_1.18fr] lg:gap-16">
            <div><p class="eyebrow">Request a Quote</p><h2 class="mt-5 section-heading">Tell us what you need.</h2><p class="mt-5 text-base leading-7 text-touch-muted sm:text-lg">Request a free, no-obligation quotation for valeting, cleaning, removals, handyman or refurbishment services.</p><p class="mt-4 text-sm leading-7 text-touch-muted">Include your postcode, preferred date and useful property, vehicle or access information. You may also securely attach up to four photographs.</p>
                <div class="mt-8 divide-y divide-touch-border border-y border-touch-border">@foreach ([['phone', 'Phone', $business['phone_display'], 'tel:' . $business['phone_href']], ['message-circle', 'WhatsApp', 'Message Touch2finish', 'https://wa.me/' . $business['whatsapp']], ['mail', 'Email', $business['email'], 'mailto:' . $business['email']]] as [$icon, $label, $value, $href])<a href="{{ $href }}" class="contact-method"><i data-lucide="{{ $icon }}" class="h-5 w-5 text-touch-gold" aria-hidden="true"></i><span><span class="block text-xs font-bold uppercase tracking-widest text-touch-muted">{{ $label }}</span><span class="mt-1 block text-sm font-semibold text-touch-dark">{{ $value }}</span></span></a>@endforeach</div>
                <p class="mt-6 flex items-start gap-2 text-sm leading-6 text-touch-muted"><i data-lucide="clock-3" class="mt-1 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>We aim to respond within 24 hours during normal working periods.</p>
            </div>
            <div><x-site.quote-form /></div>
        </div>

        @php
            $faqs = [
                ['question' => 'Which areas do you cover?', 'answer' => 'Touch2finish primarily serves customers across London. Other locations may be considered depending on the service, travel distance, job size and availability. Send us your postcode so the team can confirm coverage.'],
                ['question' => 'Do you provide free quotations?', 'answer' => 'Yes. Initial quotations are free and carry no obligation. Some larger or combined-service requirements may require additional information before final pricing.'],
                ['question' => 'How quickly will I receive a response?', 'answer' => 'We aim to respond to enquiries within 24 hours during normal working periods.'],
                ['question' => 'Can I book more than one service?', 'answer' => 'Yes. Compatible services can be combined. For example, customers may request removals, furniture assembly and cleaning as part of one coordinated requirement.'],
                ['question' => 'Do I need to send photographs?', 'answer' => 'Photographs are optional, but they can help us understand the condition, size and expected work more accurately. Up to four can be attached to the quotation form.'],
                ['question' => 'Do you provide products, equipment or materials?', 'answer' => 'This depends on the selected service. The quotation will explain what Touch2finish provides and whether any products or materials will be charged separately.'],
                ['question' => 'Can I request an urgent or same-day service?', 'answer' => 'Urgent enquiries can be submitted by telephone or WhatsApp. Availability is not confirmed until the team has reviewed the request.'],
                ['question' => 'How is my booking confirmed?', 'answer' => 'A service is confirmed after the quotation has been approved and the date, access arrangements and any payment requirements have been agreed.'],
            ];
        @endphp
        <div class="site-container mt-16 border-t border-touch-border pt-14 lg:mt-20 lg:pt-16">
            <div class="max-w-3xl"><p class="eyebrow">Frequently Asked Questions</p><h2 class="mt-5 section-heading">Important information before you book.</h2></div>
            <x-site.faq :faqs="$faqs" />
        </div>
    </section>

    <section class="bg-white py-14 sm:py-16">
        <div class="site-container flex flex-col gap-7 border-y border-touch-border py-10 lg:flex-row lg:items-center lg:justify-between">
            <div><h2 class="font-display text-2xl font-bold text-touch-dark sm:text-3xl">Ready to clean, move or improve?</h2><p class="mt-3 max-w-2xl text-base leading-7 text-touch-muted">Tell us what you need and let Touch2finish help you plan the appropriate next step.</p><p class="mt-2 text-sm font-semibold text-touch-dark">{{ $business['phone_display'] }}</p></div>
            <div class="flex flex-col gap-3 sm:flex-row"><a href="/#contact" class="btn-primary">Get a Free Quote</a><a href="https://wa.me/{{ $business['whatsapp'] }}" class="btn-secondary">WhatsApp Touch2finish</a></div>
        </div>
    </section>

    @if (session('quote_success'))
        <dialog x-data x-init="$nextTick(() => { $el.showModal(); $refs.closeButton.focus() })" aria-labelledby="quote-success-title" aria-describedby="quote-success-description" class="m-auto w-[calc(100%-2rem)] max-w-lg rounded-lg border border-touch-border bg-white p-0 text-touch-text shadow-2xl backdrop:bg-touch-dark/70">
            <div class="p-6 sm:p-8"><p class="eyebrow">Request Received</p><h2 id="quote-success-title" class="mt-4 font-display text-2xl font-bold text-touch-dark">Quote request sent</h2><p id="quote-success-description" class="mt-4 text-sm leading-7 text-touch-muted">Thank you. Your quotation request has been submitted successfully.</p><div class="mt-6 rounded-md bg-touch-soft p-5"><p class="text-xs font-bold uppercase tracking-widest text-touch-muted">Your reference</p><p class="mt-2 break-all font-display text-2xl font-bold text-touch-dark">{{ session('quote_success.reference') }}</p></div><p class="mt-5 text-sm leading-7 text-touch-muted">We aim to respond within 24 hours during normal working periods. Submitting a quotation request does not confirm a booking, price or service date.</p><button x-ref="closeButton" type="button" class="btn-primary mt-6 w-full" @click="$el.closest('dialog').close()">Close</button></div>
        </dialog>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak
            class="fixed bottom-24 right-4 z-[60] max-w-sm rounded-md border border-red-300 bg-white p-5 text-touch-text shadow-lg md:bottom-6 md:right-6"
            role="alert" aria-live="assertive">
            <div class="flex items-start gap-3"><i data-lucide="circle-alert" class="h-5 w-5 shrink-0 text-red-600" aria-hidden="true"></i><div><p class="font-semibold text-touch-dark">Quote request not sent</p><p class="mt-1 text-sm leading-6 text-touch-muted">{{ session('error') }}</p></div><button type="button" @click="show = false" class="ml-auto p-1 text-touch-muted hover:text-touch-dark" aria-label="Dismiss notification"><i data-lucide="x" class="h-4 w-4" aria-hidden="true"></i></button></div>
        </div>
    @endif
</x-layout>
