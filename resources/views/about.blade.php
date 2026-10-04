<x-layout>
    @php($business = config('touch2finish.business'))
    <x-slot name="seo">
        @include('partials.seo', [
            'title' => 'About Touch2Finish | Touch2finish Services Ltd UK',
            'description' => 'Meet Touch2Finish, operated by Touch2finish Services Ltd. UK valeting, cleaning, removals, handyman and property services, primarily across London.',
            'canonical' => route('about'),
        ])
    </x-slot>

    <section class="section-shell bg-touch-surface">
        <div class="site-container max-w-4xl">
            <p class="eyebrow">About {{ $business['name'] }}</p>
            <h1 class="mt-5 font-display text-4xl font-extrabold leading-tight text-touch-dark sm:text-5xl">Practical services. One clear point of contact.</h1>
            <p class="mt-6 text-lg leading-8 text-touch-muted">{{ $business['name'] }} is a UK multi-service business operated by {{ $business['legal_name'] }}, company number {{ $business['company_number'] }}. We provide mobile car valeting, cleaning, removals, handyman and property improvement services, primarily across London.</p>
            <p class="mt-5 font-display text-xl font-semibold text-touch-dark">{{ $business['tagline'] }}</p>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container grid gap-10 lg:grid-cols-2 lg:gap-16">
            <div>
                <p class="eyebrow">What We Do</p>
                <h2 class="mt-5 section-heading">Help for your vehicle, property and move.</h2>
                <p class="mt-5 text-base leading-7 text-touch-muted">Our services cover vehicle care, domestic and commercial cleaning, removals and man-and-van support, handyman tasks, and selected refurbishment and decorating work. Customers can enquire about one service or a combination of compatible tasks.</p>
                <a href="{{ route('services.index') }}" class="btn-text mt-6">Explore our services <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i></a>
            </div>
            <div>
                <p class="eyebrow">How We Work</p>
                <h2 class="mt-5 section-heading">Clear scope before work begins.</h2>
                <p class="mt-5 text-base leading-7 text-touch-muted">We start with the details of your requirement: the service, postcode, preferred date and any photographs that help explain the work. We review the information and confirm the proposed scope and quotation before arranging the service.</p>
                <p class="mt-4 text-base leading-7 text-touch-muted">Our approach centres on clear communication, careful handling and reviewing completed work against the agreed scope. Submitting an enquiry does not confirm a booking or service date.</p>
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-soft">
        <div class="site-container grid gap-10 lg:grid-cols-2 lg:gap-16">
            <div>
                <p class="eyebrow">London and Beyond</p>
                <h2 class="mt-5 section-heading">Coverage confirmed for your requirement.</h2>
                <p class="mt-5 text-base leading-7 text-touch-muted">London is our primary service area. Requests outside London may be considered depending on the service, travel distance, job size and availability. Send your postcode so we can review your location.</p>
                <a href="{{ route('areas') }}" class="btn-text mt-6">Areas We Cover <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i></a>
            </div>
            <div>
                <p class="eyebrow">Company Information</p>
                <h2 class="mt-5 font-display text-2xl font-bold text-touch-dark">{{ $business['legal_name'] }}</h2>
                <p class="mt-5 text-base leading-7 text-touch-muted">{{ $business['name'] }} is the public brand of {{ $business['legal_name'] }} in the {{ $business['country_name'] }}.</p>
                <p class="mt-4 text-base leading-7 text-touch-muted">Company No. {{ $business['company_number'] }}</p>
                <p class="mt-4"><a href="https://find-and-update.company-information.service.gov.uk/company/{{ $business['company_number'] }}" class="font-semibold text-touch-dark underline underline-offset-4">View our Companies House record</a></p>
            </div>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container max-w-4xl text-center">
            <h2 class="section-heading">Tell us what you need.</h2>
            <p class="mt-5 text-base leading-7 text-touch-muted">Share the service, location and preferred date for a no-obligation initial quotation.</p>
            <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
                <a href="{{ route('home') }}#contact" class="btn-primary">Get a Free Quote</a>
                <a href="tel:{{ $business['phone_href'] }}" class="btn-secondary">Call {{ $business['phone_display'] }}</a>
            </div>
        </div>
    </section>
</x-layout>
