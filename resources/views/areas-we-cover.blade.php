<x-layout>
    <x-slot name="seo">
        @include('partials.seo', [
            'title' => 'Areas We Cover | Touch2finish London',
            'description' => 'Touch2finish primarily provides valeting, cleaning, removals, handyman and refurbishment services across London, with other locations considered depending on the requirement.',
            'canonical' => route('areas'),
        ])
    </x-slot>

    <section class="section-shell bg-touch-surface">
        <div class="site-container max-w-4xl" data-reveal="fade-up">
            <p class="eyebrow">Areas We Cover</p>
            <h1 class="mt-5 font-display text-4xl font-extrabold text-touch-dark sm:text-5xl">Services across London.</h1>
            <p class="mt-6 max-w-2xl text-lg text-touch-muted">Touch2finish primarily serves customers across London. Send us your postcode and required service so we can confirm current availability.</p>
        </div>
    </section>

    <section class="section-shell bg-white">
        <div class="site-container grid gap-10 lg:grid-cols-2">
            <div>
                <p class="eyebrow">Primary Coverage</p>
                <h2 class="section-heading mt-5">London service enquiries.</h2>
                <p class="mt-5 text-touch-muted">We review mobile valeting, cleaning, removals, handyman and refurbishment requirements across London based on the service details and current availability.</p>
            </div>
            <div>
                <p class="eyebrow">Outside London?</p>
                <h2 class="section-heading mt-5">Other locations may be considered.</h2>
                <p class="mt-5 text-touch-muted">Requests outside London may also be considered depending on the service, travel distance, job size, preferred date and availability.</p>
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-surface">
        <div class="site-container">
            <p class="eyebrow">Available Services</p>
            <h2 class="section-heading mt-5">Explore services in your area.</h2>
            <p class="mt-5 max-w-2xl text-touch-muted">Review the service that matches your requirements, then send your postcode so we can confirm coverage and availability.</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (config('touch2finish.services', []) as $service)
                    <a href="{{ route('services.show', ['slug' => $service['slug']]) }}" class="flex min-h-[76px] items-center justify-between gap-4 rounded-md border border-touch-border bg-white px-5 py-4 font-display font-bold text-touch-dark transition hover:border-touch-gold hover:text-touch-deep">
                        <span>{{ $service['title'] }}</span>
                        <i data-lucide="arrow-right" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-touch-soft">
        <div class="site-container text-center">
            <h2 class="section-heading">Tell us your postcode.</h2>
            <a href="{{ route('home') }}#contact" class="btn-primary mt-7">Check Your Postcode</a>
        </div>
    </section>
</x-layout>
