<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset($seo)
        {{ $seo }}
    @else
        @include('partials.seo', [
            'title' => $title ?? 'Touch2Finish | Valeting, Cleaning, Removals and Property Services',
            'description' => 'Touch2Finish provides mobile car valeting, domestic and commercial cleaning, removals, handyman and refurbishment services for homes, vehicles and businesses.',
            'canonical' => url()->current(),
        ])
    @endisset

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="site-body">
    @php
        $business = config('touch2finish.business');
    @endphp
    <header id="site-header" class="site-header" x-data="{ open: false }" @keydown.escape.window="open = false">
        <div class="site-container flex h-[4.5rem] items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex shrink-0 items-center" aria-label="Touch2Finish home">
                <img src="{{ asset('images/logo.png') }}" alt="Touch2Finish" class="h-10 w-auto sm:h-11" width="300" height="100">
            </a>

            <nav class="hidden items-center gap-7 md:flex" aria-label="Primary navigation">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="{{ route('services.index') }}" class="nav-link">Services</a>
                <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
                <a href="{{ route('home') }}#contact" class="btn-primary btn-compact">Get a Free Quote</a>
            </nav>

            <button type="button" class="mobile-menu-button md:hidden" @click="open = !open"
                :aria-expanded="open.toString()" aria-controls="mobile-menu" aria-label="Toggle navigation menu">
                <span x-show="!open"><i data-lucide="menu" class="h-5 w-5" aria-hidden="true"></i></span>
                <span x-show="open" x-cloak><i data-lucide="x" class="h-5 w-5" aria-hidden="true"></i></span>
            </button>
        </div>

        <nav id="mobile-menu" x-show="open" x-cloak x-transition.opacity class="mobile-menu md:hidden"
            aria-label="Mobile navigation">
            <div class="site-container flex flex-col py-3">
                @foreach ([[route('home'), 'Home'], [route('about'), 'About'], [route('services.index'), 'Services'], [route('home').'#contact', 'Contact']] as [$href, $label])
                    <a href="{{ $href }}" class="mobile-nav-link" @click="open = false">{{ $label }}</a>
                @endforeach
                <a href="{{ route('home') }}#contact" class="btn-primary mt-3 justify-center" @click="open = false">Get a Free Quote</a>
            </div>
        </nav>
    </header>

    <main class="min-w-0 flex-grow">
        {{ $slot }}
    </main>

    <footer class="site-footer" aria-label="Site footer">
        <div class="site-container py-14 sm:py-16">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex" aria-label="Touch2Finish home">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Touch2Finish" class="h-12 w-auto" width="300" height="100">
                    </a>
                    <p class="mt-5 max-w-sm text-sm leading-6 text-white/70">Professional mobile valeting, cleaning, removals, handyman and property-improvement services for homes, vehicles and businesses.</p>
                    <p class="mt-4 font-display text-sm font-semibold text-white">Clean. Move. Improve.</p>
                    <div class="mt-5 flex gap-3">
                        <a href="tel:{{ $business['phone_href'] }}" class="footer-icon-link" aria-label="Call Touch2Finish"><i data-lucide="phone" class="h-4 w-4" aria-hidden="true"></i></a>
                        <a href="mailto:{{ $business['email'] }}" class="footer-icon-link" aria-label="Email Touch2Finish"><i data-lucide="mail" class="h-4 w-4" aria-hidden="true"></i></a>
                        <a href="https://wa.me/{{ $business['whatsapp'] }}" class="footer-icon-link" aria-label="WhatsApp Touch2Finish"><i data-lucide="message-circle" class="h-4 w-4" aria-hidden="true"></i></a>
                    </div>
                    @if ($socialProfiles = \App\Support\Seo::socialProfiles())
                        <ul class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm" aria-label="Official social profiles">
                            @foreach ($socialProfiles as $platform => $profileUrl)
                                <li><a href="{{ $profileUrl }}" class="footer-link" rel="me">{{ $business['name'] }} on {{ is_string($platform) ? $platform : parse_url($profileUrl, PHP_URL_HOST) }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <nav aria-label="Footer services">
                    <h2 class="footer-heading">Services</h2>
                    <ul class="mt-5 space-y-3 text-sm">
                        @foreach (config('touch2finish.services', []) as $footerService)
                            <li><a href="{{ route('services.show', ['slug' => $footerService['slug']]) }}" class="footer-link">{{ $footerService['navigation_title'] }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <nav aria-label="Footer company links">
                    <h2 class="footer-heading">Company</h2>
                    <ul class="mt-5 space-y-3 text-sm">
                        @foreach ([[route('about'), 'About Us'], [route('services.index'), 'Services'], [route('areas'), 'Areas We Cover'], [route('home').'#contact', 'Contact'], [route('home').'#contact', 'Get a Quote']] as [$href, $label])
                            <li><a href="{{ $href }}" class="footer-link">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <div>
                    <h2 class="footer-heading">Contact</h2>
                    <ul class="mt-5 space-y-4 text-sm text-white/70">
                        <li><a href="tel:{{ $business['phone_href'] }}" class="footer-link">{{ $business['phone_display'] }}</a></li>
                        <li><a href="mailto:{{ $business['email'] }}" class="footer-link break-all">{{ $business['email'] }}</a></li>
                        <li class="flex items-start gap-2"><i data-lucide="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i><span>London and surrounding locations considered</span></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 flex flex-col gap-5 border-t border-white/15 pt-7 text-xs text-white/55 md:flex-row md:items-center md:justify-between">
                <div class="space-y-2"><p>&copy; {{ date('Y') }} {{ $business['name'] }}. All rights reserved.</p><p>{{ $business['name'] }} is operated by {{ $business['legal_name'] }} &middot; Company No. {{ $business['company_number'] }}</p></div>
                <div class="flex flex-wrap gap-x-5 gap-y-3">
                    <a href="{{ route('legal.privacy') }}" class="footer-link">Privacy Policy</a>
                    <a href="{{ route('legal.cookies') }}" class="footer-link">Cookie Policy</a>
                    <a href="{{ route('legal.terms') }}" class="footer-link">Terms and Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
