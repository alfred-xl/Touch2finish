{{--
    resources/views/errors/404.blade.php
    Custom branded 404 page — replaces Laravel's default error page.
    Place at: resources/views/errors/404.blade.php
    Laravel auto-discovers error views in this directory.
--}}
<x-layout>
    @include('partials.seo', [
        'title' => 'Page Not Found | Touch2finish',
        'description' =>
            'The page you were looking for could not be found. Return to Touch2finish for premium trade services across the UK.',
        'canonical' => url('/'),
        'robots' => 'noindex, follow',
    ])

    <section class="min-h-[70vh] flex items-center justify-center px-6 bg-[#F4F7F8]">
        <div class="text-center max-w-lg">
            <div class="text-8xl font-black text-[#CBD9DC] mb-4" style="font-family:'Sora',sans-serif">404</div>
            <h1 class="text-2xl font-black text-[#071B3B] mb-3">Page Not Found</h1>
            <p class="text-[#485465] leading-relaxed mb-8">
                The page you were looking for doesn't exist or may have been moved.
                Head back home or explore our services.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="/" class="btn-primary">
                    <i data-lucide="home" class="w-4 h-4" aria-hidden="true"></i>
                    Back to Home
                </a>
                <a href="/#services" class="btn-secondary">
                    <i data-lucide="briefcase" class="w-4 h-4" aria-hidden="true"></i>
                    Our Services
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            if (window.lucide) lucide.createIcons();
        </script>
    @endpush
</x-layout>
