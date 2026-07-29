<x-layout>
    <x-slot name="seo">@include('partials.seo', [
        'title' => 'Page Not Found | Touch2finish',
        'description' => 'The requested page could not be found. Return to Touch2finish or explore our valeting, cleaning, removals, handyman and refurbishment services.',
        'canonical' => url('/'), 'robots' => 'noindex, follow',
    ])</x-slot>
    <section class="section-shell flex min-h-[70vh] items-center bg-touch-soft">
        <div class="site-container"><div class="mx-auto max-w-2xl text-center" data-reveal="fade-up">
            <p class="eyebrow">Page Not Found</p>
            <p class="mt-5 font-display text-7xl font-extrabold text-touch-border sm:text-8xl" aria-hidden="true">404</p>
            <h1 class="section-heading mt-5">We could not find that page.</h1>
            <p class="mx-auto mt-5 max-w-xl text-base leading-7 text-touch-muted">The page may have been moved, renamed or removed. Return to the homepage or explore the available Touch2finish services.</p>
            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row"><a href="{{ route('home') }}" class="btn-primary">Back to Home</a><a href="{{ route('services.index') }}" class="btn-secondary">Explore Our Services</a></div>
        </div></div>
    </section>
</x-layout>
