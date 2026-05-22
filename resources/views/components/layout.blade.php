<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset($seo)
        {{ $seo }}
    @else
        @include('partials.seo', [
            'title' => $title ?? 'Touch2finish | Premium Trade Services — Standard is Everything',
            'description' =>
                'Touch2finish — bespoke, high-end trade services in the UK. Removals, Car Valeting, Interior Decor, Real Estate & Cleaning. Standard is everything.',
            'canonical' => url()->current(),
        ])
    @endisset

    {{-- Fonts: Inter (body) + Sora (display/headings) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Lucide Icons — NOT deferred so icons are available before JS bundle --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- Fancybox CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">

    {{-- Alpine.js — defer is fine, it self-starts after DOMContentLoaded --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- App CSS + JS (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ================================================================
           GLOBAL CSS CUSTOM PROPERTIES
           Exposes brand tokens so third-party libs (Fancybox, Swiper)
           can read them from :root without needing Tailwind compilation.
        ================================================================ */
        :root {
            --t2f-navy: #071B3B;
            --t2f-teal: #157D9A;
            --t2f-deep: #0D5876;
            --t2f-gold: #E2AE49;
            --t2f-blue: #CBD9DC;
            --t2f-slate: #485465;
            --t2f-light: #F4F7F8;

            /* Fancybox z-index — must exceed sticky header z-50 (50).
               These are Fancybox 5's official CSS custom property API. */
            --f-zindex-backdrop: 9000;
            --f-zindex-toolbar: 9100;
            --f-zindex-caption: 9100;
            --f-zindex-loading: 9100;
            --f-zindex-error: 9100;
            --f-zindex-content: 9100;
            --f-zindex-thumbs: 9100;
            --f-zindex-nav: 9100;

            /* Fancybox button brand colours */
            --f-button-bg: #071B3B;
            --f-button-hover-bg: #E2AE49;
            --f-button-color: #ffffff;
            --f-button-hover-color: #ffffff;
            --f-backdrop-color: rgba(7, 27, 59, 0.96);
        }

        body {
            color: #485465;
        }

        /* Drop sticky header below Fancybox when lightbox is active.
           Fancybox adds .compensate-for-scrollbar to <html> on open. */
        html.compensate-for-scrollbar #site-header,
        html[data-fancybox-open] #site-header {
            z-index: 0 !important;
        }

        /* ----------------------------------------------------------------
           NAVIGATION
        ---------------------------------------------------------------- */
        .nav-link {
            position: relative;
            font-weight: 500;
            font-size: 0.875rem;
            color: #485465;
            transition: color 0.2s ease;
        }

        .nav-link::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #E2AE49;
            border-radius: 1px;
            transition: width 0.25s ease;
        }

        .nav-link:hover {
            color: #157D9A;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* ================================================================
           BUTTON SYSTEM — single source of truth
           All button variants live here. Tailwind component aliases are
           in app.css (@layer components). These raw-CSS rules are the
           canonical definitions and work even before the Vite build runs.
        ================================================================ */

        /* btn-primary — gold, all primary CTAs */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #E2AE49;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 20px -2px rgba(226, 174, 73, 0.32);
            transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #d9a43e;
            box-shadow: 0 10px 28px -4px rgba(226, 174, 73, 0.48);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:focus-visible {
            outline: 2px solid #E2AE49;
            outline-offset: 3px;
        }

        /* btn-secondary — teal solid, secondary actions */
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #157D9A;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 20px -2px rgba(21, 125, 154, 0.22);
            transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .btn-secondary:hover {
            background: #0D5876;
            box-shadow: 0 10px 28px -4px rgba(21, 125, 154, 0.32);
            transform: translateY(-2px);
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        .btn-secondary:focus-visible {
            outline: 2px solid #157D9A;
            outline-offset: 3px;
        }

        /* btn-ghost — transparent + border, for dark/hero backgrounds */
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            border: 1.5px solid rgba(255, 255, 255, 0.22);
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s ease, border-color 0.2s ease;
            backdrop-filter: blur(4px);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.38);
        }

        .btn-ghost:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.6);
            outline-offset: 3px;
        }

        /* btn-nav — compact gold, header navigation CTA */
        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #E2AE49;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.875rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 3px 14px -2px rgba(226, 174, 73, 0.30);
            transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
        }

        .btn-nav:hover {
            background: #d9a43e;
            box-shadow: 0 6px 20px -3px rgba(226, 174, 73, 0.45);
            transform: translateY(-1px);
        }

        /* btn-icon — square icon button (footer socials, etc.) */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            transition: background 0.2s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-icon:hover {
            background: #E2AE49;
        }

        /* ----------------------------------------------------------------
           SERVICE CARDS
        ---------------------------------------------------------------- */
        .service-card {
            position: relative;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 20px -2px rgba(21, 125, 154, 0.10);
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .service-card:hover {
            box-shadow: 0 16px 40px -6px rgba(21, 125, 154, 0.24);
            transform: translateY(-3px);
        }

        .service-card__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 0;
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-card__bg {
            transform: scale(1.04);
        }

        .service-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(7, 27, 59, 0.96) 0%,
                    rgba(13, 88, 118, 0.72) 50%,
                    rgba(13, 88, 118, 0.15) 100%);
            z-index: 1;
            transition: opacity 0.4s ease;
        }

        .service-card__face {
            position: absolute;
            inset: 0;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 1px solid #CBD9DC;
            z-index: 2;
            transition: opacity 0.3s ease;
        }

        .service-card__content {
            position: relative;
            z-index: 3;
            padding: 2rem;
            width: 100%;
            transition: opacity 0.35s ease;
        }

        @media (max-width: 767px) {
            .service-card__face {
                opacity: 0;
                pointer-events: none;
            }

            .service-card__content {
                opacity: 1;
                pointer-events: auto;
            }
        }

        @media (min-width: 768px) {
            .service-card__face {
                opacity: 1;
                pointer-events: auto;
            }

            .service-card__content {
                opacity: 0;
                pointer-events: none;
            }

            .service-card:hover .service-card__face {
                opacity: 0;
                pointer-events: none;
            }

            .service-card:hover .service-card__content {
                opacity: 1;
                pointer-events: auto;
            }
        }

        /* ----------------------------------------------------------------
           FORM INPUTS
        ---------------------------------------------------------------- */
        .t2f-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border-radius: 0.75rem;
            border: 1.5px solid #CBD9DC;
            color: #071B3B;
            font-size: 0.875rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: #ffffff;
        }

        .t2f-input:focus {
            outline: none;
            border-color: #157D9A;
            box-shadow: 0 0 0 3px rgba(21, 125, 154, 0.12);
        }

        .t2f-input.error {
            border-color: #ef4444;
        }

        /* ----------------------------------------------------------------
           BADGES & DIVIDERS
        ---------------------------------------------------------------- */
        .gold-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(226, 174, 73, 0.15);
            border: 1px solid rgba(226, 174, 73, 0.35);
            color: #E2AE49;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .gold-rule {
            display: block;
            width: 3.5rem;
            height: 3px;
            background: #E2AE49;
            border-radius: 9px;
        }

        /* ================================================================
           GALLERY / SWIPER — PREMIUM STYLED SLIDER
           Custom arrows (navy→gold on hover), teal bullets, slide cards
           with polished hover overlay.
        ================================================================ */

        /* Extra bottom padding for pagination dots */
        .projects-swiper {
            padding-bottom: 3.5rem !important;
        }

        /* Pagination bullets */
        .projects-swiper .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background: #CBD9DC;
            opacity: 1;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .projects-swiper .swiper-pagination-bullet-active {
            background: #157D9A !important;
            transform: scale(1.4);
        }

        /* Navigation arrows — fully custom brand style */
        .projects-swiper .swiper-button-next,
        .projects-swiper .swiper-button-prev {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #071B3B;
            color: #ffffff !important;
            box-shadow: 0 4px 16px rgba(7, 27, 59, 0.28);
            transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
            top: calc(50% - 1.75rem);
            /* adjust for pagination space */
        }

        .projects-swiper .swiper-button-next:hover,
        .projects-swiper .swiper-button-prev:hover {
            background: #E2AE49;
            box-shadow: 0 6px 22px rgba(226, 174, 73, 0.42);
            transform: scale(1.10);
        }

        .projects-swiper .swiper-button-next::after,
        .projects-swiper .swiper-button-prev::after {
            font-size: 13px;
            font-weight: 900;
        }

        .projects-swiper .swiper-button-disabled {
            opacity: 0.3 !important;
            pointer-events: none;
        }

        /* Individual gallery slide card */
        .gallery-slide-card {
            display: block;
            text-decoration: none;
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 20px -2px rgba(21, 125, 154, 0.12);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .gallery-slide-card:hover {
            box-shadow: 0 14px 36px -4px rgba(21, 125, 154, 0.26);
            transform: translateY(-4px);
        }

        .gallery-slide-card:focus-visible {
            outline: 2px solid #E2AE49;
            outline-offset: 3px;
        }

        .gallery-slide-card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        @media (min-width: 768px) {
            .gallery-slide-card img {
                height: 280px;
            }
        }

        .gallery-slide-card:hover img {
            transform: scale(1.05);
        }

        /* Hover caption overlay */
        .gallery-slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(7, 27, 59, 0.90) 0%,
                    rgba(7, 27, 59, 0.35) 48%,
                    transparent 100%);
            opacity: 0;
            transition: opacity 0.30s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.25rem;
            gap: 0.75rem;
        }

        .gallery-slide-card:hover .gallery-slide-overlay {
            opacity: 1;
        }

        /* Always show on mobile (no hover on touch) */
        @media (max-width: 767px) {
            .gallery-slide-overlay {
                opacity: 1;
            }
        }

        .gallery-slide-cat {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.10em;
            text-transform: uppercase;
            color: #E2AE49;
            margin-bottom: 0.2rem;
        }

        .gallery-slide-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            color: #ffffff;
        }

        .gallery-slide-zoom {
            width: 2.1rem;
            height: 2.1rem;
            border-radius: 50%;
            background: rgba(226, 174, 73, 0.90);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-left: auto;
        }
    </style>

    @stack('head')
</head>

<body class="min-h-screen flex flex-col bg-white antialiased">

    {{-- ════════════════════════════════════════════════════════ HEADER ══════ --}}
    <header id="site-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-[#CBD9DC]/40"
        x-data="{ open: false }" @scroll.window="open = false">

        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Touch2finish home">
                {{-- Header logo --}}
                <img src="{{ asset('images/logo.png') }}" alt="Touch2finish logo" class="h-10 md:h-12 w-auto"
                    width="300" height="100">
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden md:flex items-center gap-7" aria-label="Primary navigation">
                <a href="/" class="nav-link">Home</a>
                <a href="/#about" class="nav-link">About</a>
                <a href="/#services" class="nav-link">Services</a>
                <a href="/#gallery-section" class="nav-link">Projects</a>
                <a href="/#contact" class="btn-nav">
                    <i data-lucide="file-text" class="w-4 h-4" aria-hidden="true"></i>
                    Get a Quote
                </a>
            </nav>

            {{-- Mobile hamburger --}}
            <button
                class="md:hidden w-10 h-10 rounded-lg flex items-center justify-center text-[#071B3B] hover:bg-[#CBD9DC]/30 transition-colors"
                @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-menu"
                aria-label="Toggle navigation">
                <i x-show="!open" data-lucide="menu" class="w-5 h-5" aria-hidden="true"></i>
                <i x-show="open" data-lucide="x" class="w-5 h-5" aria-hidden="true" style="display:none"></i>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden border-t border-[#CBD9DC]/40 bg-white px-6 py-5 flex flex-col gap-1" style="display:none">

            <a href="/" @click="open = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#485465] hover:bg-[#CBD9DC]/20 hover:text-[#157D9A] transition-colors">
                <i data-lucide="home" class="w-4 h-4 text-[#157D9A]" aria-hidden="true"></i> Home
            </a>
            <a href="/#about" @click="open = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#485465] hover:bg-[#CBD9DC]/20 hover:text-[#157D9A] transition-colors">
                <i data-lucide="users" class="w-4 h-4 text-[#157D9A]" aria-hidden="true"></i> About Us
            </a>
            <a href="/#services"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'services'; }, 160);"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#485465] hover:bg-[#CBD9DC]/20 hover:text-[#157D9A] transition-colors">
                <i data-lucide="briefcase" class="w-4 h-4 text-[#157D9A]" aria-hidden="true"></i> Services
            </a>
            <a href="/#gallery-section"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'gallery'; }, 160);"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#485465] hover:bg-[#CBD9DC]/20 hover:text-[#157D9A] transition-colors">
                <i data-lucide="image" class="w-4 h-4 text-[#157D9A]" aria-hidden="true"></i> Projects
            </a>
            {{-- Mobile CTA — gold, consistent lift on hover --}}
            <a href="/#contact"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'contact'; }, 160);"
                class="btn-primary flex justify-center mt-3">
                <i data-lucide="file-text" class="w-4 h-4" aria-hidden="true"></i> Get a Quote
            </a>
        </div>
    </header>

    {{-- ════════════════════════════════════════════════════ MAIN CONTENT ══════ --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- ═══════════════════════════════════════════════════════════ FOOTER ══════ --}}
    <footer class="bg-[#071B3B] text-white" aria-label="Site footer">
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12 pb-12 border-b border-white/10">

                {{-- Brand column --}}
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Touch2finish home">
                            <img src="{{ asset('images/logo-white.png') }}" alt="Touch2finish logo"
                                class="h-12 w-auto">
                        </a>

                    </div>
                    <p class="text-sm leading-relaxed text-white/60 max-w-xs mb-7">
                        We are here to help from start to finish. A premium multi-service trade business
                        delivering the highest standard across every project, every time.
                    </p>
                    {{-- Consistent btn-icon for social links --}}
                    <div class="flex gap-3">
                        <a href="mailto:info@touch2finish.co.uk" class="btn-icon" aria-label="Email Touch2finish">
                            <i data-lucide="mail" class="w-4 h-4" aria-hidden="true"></i>
                        </a>
                        <a href="tel:+447456490400" class="btn-icon" aria-label="Call Touch2finish">
                            <i data-lucide="phone" class="w-4 h-4" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <nav aria-label="Footer navigation">
                    <h2 class="text-xs font-bold tracking-widest uppercase text-white/40 mb-5">Quick Links</h2>
                    <ul class="space-y-3 text-sm">
                        @foreach ([['/', 'Home'], ['/#about', 'About Us'], ['/#services', 'Our Services'], ['/#gallery', 'Recent Projects'], ['/#contact', 'Get a Quote']] as [$href, $label])
                            <li>
                                <a href="{{ $href }}"
                                    class="text-white/60 hover:text-[#E2AE49] transition-colors flex items-center gap-2">
                                    <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>

                {{-- Contact --}}
                <div>
                    <h2 class="text-xs font-bold tracking-widest uppercase text-white/40 mb-5">Get In Touch</h2>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-[#E2AE49] mt-0.5 flex-shrink-0"
                                aria-hidden="true"></i>
                            <a href="mailto:info@touch2finish.co.uk"
                                class="text-white/60 hover:text-[#E2AE49] transition-colors break-all">
                                info@touch2finish.co.uk
                            </a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-[#E2AE49] flex-shrink-0"
                                aria-hidden="true"></i>
                            <a href="tel:+447456490400" class="text-white/60 hover:text-[#E2AE49] transition-colors">
                                +44 7456 490 400
                            </a>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#E2AE49] mt-0.5 flex-shrink-0"
                                aria-hidden="true"></i>
                            <span class="text-white/60">United Kingdom</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/30">
                <p>&copy; {{ date('Y') }} Touch2finish. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white/70 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white/70 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script>
        // ── Lucide icons ──────────────────────────────────────────────────
        // lucide.min.js was loaded synchronously in <head>, always available.
        if (window.lucide) lucide.createIcons();
        (function initFancybox() {
            if (!window.Fancybox) {
                console.warn('Touch2finish: Fancybox did not load.');
                return;
            }

            var siteHeader = document.getElementById('site-header');

            Fancybox.bind('[data-fancybox]', {
                on: {
                    'init': function() {
                        if (siteHeader) siteHeader.style.zIndex = '0';
                    },
                    'destroy': function() {
                        if (siteHeader) siteHeader.style.zIndex = '';
                    },
                },
                Toolbar: {
                    display: {
                        left: ['infobar'],
                        middle: [],
                        right: ['zoomIn', 'zoomOut', 'toggle1to1', 'slideshow', 'thumbs', 'close'],
                    },
                },
                keyboard: {
                    Escape: 'close'
                },
                backdropClick: 'close',
                Images: {
                    zoom: true
                },
                Thumbs: {
                    type: 'classic'
                },
                animated: true,
                showClass: 'f-fadeIn',
                hideClass: 'f-fadeOut',
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
