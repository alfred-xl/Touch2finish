<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Touch2finish — bespoke, high-end trade services in the UK. Removals, Car Valeting, Interior Decor, Real Estate & Cleaning. Standard is everything.">
    <title>{{ $title ?? 'Touch2finish | Bespoke Trade Services' }}</title>

    <!-- Geist Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ─────────────────────────────────────────────────────────────────────
           FIX 1 · TEXT COLOUR
           The old <body> carried class="text-brand-teal" which made every
           paragraph, label, and body copy element inherit teal (#127194) —
           a saturated blue-green that is too heavy for reading text.
           Teal is a brand ACCENT. Base prose is now near-black charcoal.
        ───────────────────────────────────────────────────────────────────── */
        body {
            color: #1f1f1f;
        }

        /* ─────────────────────────────────────────────────────────────────────
           FIX 2 · FANCYBOX CLOSE BUTTON BLOCKED (the "Projects" lightbox bug)

           ROOT CAUSE:
           The sticky <header> has Tailwind class z-50 (z-index: 50).
           A `position: sticky` element with any z-index creates a NEW stacking
           context. Fancybox 5 appends its overlay as a direct child of <body>,
           a sibling of <header>. Within the same stacking context (the root),
           a later sibling normally paints on top — but because the header has
           an explicit z-index it is promoted above Fancybox's container in
           Safari and some Chromium builds, covering the close button and the
           entire top toolbar strip. The user can see the dimmed lightbox but
           the × close button is hidden behind the header, so they cannot close.

           FIX A: Give Fancybox a z-index higher than the header.
           Fancybox 5 exposes CSS custom properties for this.
           We set --f-zindex-backdrop and --f-zindex-toolbar well above z-50.

           FIX B: When Fancybox opens, push the sticky header below by adding
           a class that sets z-index: 0 (removing it from the stacking race).
           We restore it on close. This is the belt-and-braces approach that
           works in every browser without relying on Fancybox internals.
        ───────────────────────────────────────────────────────────────────── */
        :root {
            /* Fancybox z-index tokens — must exceed header z-50 = 50 */
            --f-zindex-backdrop: 9000;
            --f-zindex-toolbar: 9100;
            --f-zindex-caption: 9100;
            --f-zindex-loading: 9100;
            --f-zindex-error: 9100;
            --f-zindex-content: 9100;
            --f-zindex-thumbs: 9100;
            --f-zindex-nav: 9100;

            /* Fancybox brand colours */
            --f-button-bg: #127194;
            --f-button-hover-bg: #F6E304;
            --f-button-color: #fff;
            --f-button-hover-color: #127194;
        }

        /*
           Belt-and-braces: when Fancybox is active it adds .compensate-for-scrollbar
           to <html>. We use that signal to drop the header out of the stacking race.
        */
        html.compensate-for-scrollbar #site-header,
        html[data-fancybox-open] #site-header {
            z-index: 0 !important;
        }

        /* Swiper custom pagination */
        .swiper-pagination-bullet-active {
            background: #127194 !important;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #127194 !important;
        }

        /* Nav animated yellow underline */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: #F6E304;
            border-radius: 1px;
            transition: width 0.28s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* ─────────────────────────────────────────────────────────────────────
           FIX 3 · SERVICE CARD LAYOUT

           ROOT CAUSE:
           The old markup used Tailwind opacity utilities
           (md:opacity-0 / md:group-hover:opacity-100) to swap between the
           "white resting face" and the "revealed image+text" layers. Two
           problems:
           (a) Tailwind JIT compiles md:opacity-100 and md:group-hover:opacity-0
               at equal specificity, so the transition was unreliable — some
               browsers kept the white face on top even after hover.
           (b) The white face div (absolute, z-20, opacity-0) still captured
               pointer events on mobile, so clicks on "Learn More" links
               hit the invisible face rather than the actual <a> tag.

           FIX: Replace all Tailwind opacity utilities with a set of plain CSS
           classes. Mobile-first defaults show image+content always. A media
           query switches to the face-first + hover-reveal pattern on desktop.
           pointer-events is toggled explicitly so clicks always land correctly.
        ───────────────────────────────────────────────────────────────────── */
        .service-card {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px -2px rgba(18, 113, 148, 0.10);
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            transition: box-shadow 0.3s ease;
        }

        .service-card:hover {
            box-shadow: 0 12px 32px -4px rgba(18, 113, 148, 0.22);
        }

        .service-card__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 0;
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        .service-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(18, 113, 148, 0.96) 0%,
                    rgba(18, 113, 148, 0.72) 55%,
                    rgba(18, 113, 148, 0.20) 100%);
            z-index: 1;
            transition: opacity 0.45s ease;
        }

        /* Clean white resting face */
        .service-card__face {
            position: absolute;
            inset: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border: 1px solid #f0f0f0;
            z-index: 2;
            transition: opacity 0.3s ease;
        }

        /* Revealed text content */
        .service-card__content {
            position: relative;
            z-index: 3;
            padding: 1.75rem;
            width: 100%;
            transition: opacity 0.35s ease;
        }

        /* Mobile defaults: image + content always visible, face hidden */
        .service-card__bg {
            opacity: 1;
        }

        .service-card__overlay {
            opacity: 1;
        }

        .service-card__face {
            opacity: 0;
            pointer-events: none;
        }

        .service-card__content {
            opacity: 1;
        }

        /* Desktop: start with clean white face, reveal on hover */
        @media (min-width: 768px) {
            .service-card__bg {
                opacity: 0;
                transform: scale(1.05);
            }

            .service-card__overlay {
                opacity: 0;
            }

            .service-card__face {
                opacity: 1;
                pointer-events: auto;
            }

            .service-card__content {
                opacity: 0;
            }

            .service-card:hover .service-card__bg {
                opacity: 1;
                transform: scale(1);
            }

            .service-card:hover .service-card__overlay {
                opacity: 1;
            }

            .service-card:hover .service-card__face {
                opacity: 0;
                pointer-events: none;
            }

            .service-card:hover .service-card__content {
                opacity: 1;
            }
        }

        /* ─────────────────────────────────────────────────────────────────────
           FIX 4 · MOBILE MENU — handled in markup below (see comments there)
        ───────────────────────────────────────────────────────────────────── */
    </style>
</head>

{{--
    FIX 1: body no longer has text-brand-teal.
    Base colour comes from body { color: #1f1f1f } above.
--}}

<body class="bg-brand-light antialiased font-sans flex flex-col min-h-screen" x-data>

    <!-- ═══════════════════════════════════════════════════ HEADER ══════ -->
    {{--
        id="site-header" is required for the Fancybox z-index fix.
        The CSS rule `html.compensate-for-scrollbar #site-header` uses this
        id to drop the header out of the stacking context while Fancybox is open.
    --}}
    <header id="site-header" x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'shadow-soft' : 'shadow-none'"
        class="sticky top-0 bg-white z-50 transition-shadow duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            {{--
                FIX: LOGO REVERTED to the original clicking-hand/cursor SVG
                from the first version of the site, updated to brand-teal palette.
            --}}
            <a href="/" class="flex items-center gap-2.5 group flex-shrink-0">
                <svg class="w-7 h-7 text-brand-teal group-hover:text-brand-yellow transition-colors duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                </svg>
                <div class="leading-tight">
                    <span class="block text-xl font-black tracking-tight text-gray-900">
                        Touch<span class="text-brand-teal">2</span>finish
                    </span>
                    <span class="block text-[9px] font-semibold tracking-widest text-gray-400 uppercase mt-px">
                        Standard is everything
                    </span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-700">
                <a href="/" class="nav-link hover:text-brand-teal transition-colors">Home</a>
                <a href="/#about" class="nav-link hover:text-brand-teal transition-colors">About</a>
                <a href="/#services" class="nav-link hover:text-brand-teal transition-colors">Services</a>
                <a href="/#gallery" class="nav-link hover:text-brand-teal transition-colors">Projects</a>
                <a href="/#contact"
                    class="inline-flex items-center gap-2 bg-brand-yellow text-gray-900 px-6 py-2.5 rounded-lg font-bold hover:bg-yellow-300 transition-all duration-200 shadow-sm hover:shadow-md">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Get a Quote
                </a>
            </nav>

            <!-- Mobile hamburger -->
            <button @click="open = !open"
                class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-brand-light transition-colors"
                :aria-expanded="open" aria-label="Toggle navigation">
                <i x-show="!open" data-lucide="menu" class="w-6 h-6"></i>
                <i x-show="open" data-lucide="x" class="w-6 h-6" style="display:none"></i>
            </button>
        </div>

        {{--
            ─────────────────────────────────────────────────────────────────
            FIX 4 · MOBILE MENU BUG — two root causes

            CAUSE A — Tailwind `flex` class fighting Alpine's display control:
            The old div had class="... flex flex-col ...". Tailwind compiles
            `flex` → `display: flex` in the stylesheet. Alpine's x-show writes
            `element.style.display = 'none'` as an inline style (wins). BUT
            Alpine's x-transition leave animation briefly removes that inline
            style so the transition can run, and at that moment the Tailwind
            `flex` class re-applies `display: flex` — the menu flashes back
            visible for the 150 ms leave duration. Result: looks stuck open.

            FIX A: Remove `flex` and `flex-col` from the static class list.
            Use :style binding so Alpine alone controls the display property
            at all times, including during transitions.

            CAUSE B — Same-page anchors not closing the menu:
            Clicking /#gallery on the same page doesn't trigger navigation,
            so the page doesn't reload and `open` stays true. If Swiper's
            touch/scroll handler fires in the same event loop tick it can
            also prevent Alpine's `open = false` mutation from flushing.

            FIX B: Use @click.prevent on same-page anchors. Set open=false
            immediately (Alpine re-renders synchronously), then navigate via
            window.location.hash after 160 ms — after the 150 ms leave
            transition has fully completed. This prevents Swiper from
            interfering and guarantees the menu is gone before scrolling starts.
            ─────────────────────────────────────────────────────────────────
        --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            :style="open ? 'display:flex; flex-direction:column;' : 'display:none;'"
            class="md:hidden border-t border-gray-100 bg-white px-6 py-5 gap-1 text-sm font-semibold text-gray-700"
            style="display:none;">
            <a href="/" @click="open = false"
                class="flex items-center gap-3 px-2 py-2.5 rounded-lg hover:bg-brand-light hover:text-brand-teal transition-colors">
                <i data-lucide="home" class="w-4 h-4 text-brand-teal flex-shrink-0"></i> Home
            </a>
            <a href="/#about" @click="open = false"
                class="flex items-center gap-3 px-2 py-2.5 rounded-lg hover:bg-brand-light hover:text-brand-teal transition-colors">
                <i data-lucide="users" class="w-4 h-4 text-brand-teal flex-shrink-0"></i> About Us
            </a>
            <a href="/#services"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'services'; }, 160);"
                class="flex items-center gap-3 px-2 py-2.5 rounded-lg hover:bg-brand-light hover:text-brand-teal transition-colors">
                <i data-lucide="briefcase" class="w-4 h-4 text-brand-teal flex-shrink-0"></i> Services
            </a>
            <a href="/#gallery"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'gallery'; }, 160);"
                class="flex items-center gap-3 px-2 py-2.5 rounded-lg hover:bg-brand-light hover:text-brand-teal transition-colors">
                <i data-lucide="image" class="w-4 h-4 text-brand-teal flex-shrink-0"></i> Projects
            </a>
            <a href="/#contact"
                @click.prevent="open = false; setTimeout(() => { window.location.hash = 'contact'; }, 160);"
                class="flex items-center justify-center gap-2 mt-2 bg-brand-yellow text-gray-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-300 transition-colors">
                <i data-lucide="file-text" class="w-4 h-4"></i> Get a Quote
            </a>
        </div>
    </header>

    <!-- ════════════════════════════════════════════ MAIN CONTENT ══════ -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- ═══════════════════════════════════════════════════ FOOTER ══════ -->
    <footer class="bg-brand-teal text-white">
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12 border-b border-white/10 pb-12">

                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        <svg class="w-7 h-7 text-brand-yellow" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                        <div>
                            <span class="block text-lg font-black tracking-tight text-white">
                                Touch<span class="text-brand-yellow">2</span>finish
                            </span>
                            <span class="block text-[9px] font-semibold tracking-widest text-white/50 uppercase mt-px">
                                Standard is everything
                            </span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-white/70 max-w-xs mb-6">
                        We are here to help — from start to finish. A premium multi-service trade business delivering
                        the highest standard across every project, every time.
                    </p>
                    <div class="flex gap-3">
                        <a href="mailto:info@touch2finish.co.uk"
                            class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand-yellow flex items-center justify-center transition-all duration-200 group">
                            <i data-lucide="mail" class="w-4 h-4 text-white group-hover:text-gray-900"></i>
                        </a>
                        <a href="tel:+447456490400"
                            class="w-9 h-9 rounded-lg bg-white/10 hover:bg-brand-yellow flex items-center justify-center transition-all duration-200 group">
                            <i data-lucide="phone" class="w-4 h-4 text-white group-hover:text-gray-900"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-bold tracking-widest uppercase text-white/50 mb-5">Quick Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="/"
                                class="text-white/70 hover:text-brand-yellow transition-colors flex items-center gap-2"><i
                                    data-lucide="chevron-right" class="w-3 h-3"></i>Home</a></li>
                        <li><a href="/#about"
                                class="text-white/70 hover:text-brand-yellow transition-colors flex items-center gap-2"><i
                                    data-lucide="chevron-right" class="w-3 h-3"></i>About Us</a></li>
                        <li><a
                                href="/#services"class="text-white/70 hover:text-brand-yellow transition-colors flex items-center gap-2"><i
                                    data-lucide="chevron-right" class="w-3 h-3"></i>Our Services</a></li>
                        <li><a href="/#gallery"
                                class="text-white/70 hover:text-brand-yellow transition-colors flex items-center gap-2"><i
                                    data-lucide="chevron-right" class="w-3 h-3"></i>Recent Projects</a></li>
                        <li><a href="/#contact"
                                class="text-white/70 hover:text-brand-yellow transition-colors flex items-center gap-2"><i
                                    data-lucide="chevron-right" class="w-3 h-3"></i>Get a Quote</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-sm font-bold tracking-widest uppercase text-white/50 mb-5">Get In Touch</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-brand-yellow mt-0.5 flex-shrink-0"></i>
                            <a href="mailto:info@touch2finish.co.uk"
                                class="text-white/70 hover:text-brand-yellow transition-colors break-all">info@touch2finish.co.uk</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-brand-yellow flex-shrink-0"></i>
                            <a href="tel:+447456490400"
                                class="text-white/70 hover:text-brand-yellow transition-colors">+44 7456 490 400</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-brand-yellow mt-0.5 flex-shrink-0"></i>
                            <span class="text-white/70">United Kingdom</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
                <p>&copy; {{ date('Y') }} Touch2finish. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script>
        lucide.createIcons();

        // ─────────────────────────────────────────────────────────────────
        // FIX 2 · FANCYBOX CLOSE BUTTON — belt-and-braces JS approach
        //
        // The CSS :root variables above already push Fancybox z-indexes to
        // 9000+. This JS listener adds a second safety net: when Fancybox
        // opens it dispatches a custom event. We set the header to z-index:0
        // on open and restore it on close, removing it from the stacking
        // context entirely while the lightbox is active.
        // ─────────────────────────────────────────────────────────────────
        const siteHeader = document.getElementById('site-header');

        Fancybox.bind("[data-fancybox]", {
            // Push the header below Fancybox on open
            on: {
                init: () => {
                    if (siteHeader) siteHeader.style.zIndex = '0';
                },
                destroy: () => {
                    // Restore header z-index when lightbox is fully closed
                    if (siteHeader) siteHeader.style.zIndex = '';
                },
            },
            Toolbar: {
                display: {
                    left: ["infobar"],
                    middle: [],
                    right: ["zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW",
                        "flipX", "flipY", "slideshow", "thumbs", "close"
                    ],
                },
            },
            Images: {
                zoom: true
            },
            Thumbs: {
                type: "classic"
            },
            // Keyboard Escape key should always close
            keyboard: {
                Escape: "close"
            },
        });
    </script>

    {{-- Page-specific scripts (Swiper init from welcome.blade.php) --}}
    @stack('scripts')
</body>

</html>
