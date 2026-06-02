<x-layout>
    {{-- ═══════════════════════════════════════════════════════════ SEO ══════ --}}
    <x-slot name="seo">
        @php
            $homeSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                // @id — stable URI that uniquely identifies this business entity
                '@id' => url('/') . '#business',
                'name' => 'Touch2finish',
                'description' =>
                    'Premium multi-service trade business delivering removals, car valeting, interior decor, real estate development, and commercial cleaning across the UK.',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
                'image' => asset('images/og-default.jpeg'),
                'telephone' => '+44-7456-490400',
                'email' => 'info@touch2finish.co.uk',
                'priceRange' => '£',
                'currenciesAccepted' => 'GBP',
                'areaServed' => 'United Kingdom',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'GB',
                ],
                // sameAs — add social profile URLs when available, omit empty array
                // 'sameAs' => ['https://www.facebook.com/touch2finish'],
                'openingHoursSpecification' => [
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        'opens' => '08:00',
                        'closes' => '18:00',
                    ],
                ],
            ];
        @endphp
        @include('partials.seo', [
            'title' => 'Touch2finish | Premium Trade Services — Standard is Everything',
            'description' =>
                'Touch2finish delivers bespoke, high-standard trade services across the UK — removals, car valeting, interior decor, real estate development & cleaning. Get a free quote today.',
            'canonical' => url('/'),
            'ogImage' => asset('images/og-default.jpeg'),
            'schema' => $homeSchema,
        ])
    </x-slot>

    {{-- ════════════════════════════════════════════════════════════ HERO ══════ --}}
    <section class="relative bg-[#071B3B] overflow-hidden min-h-[90vh] flex items-center">

        <div class="absolute inset-0 opacity-[0.04] pointer-events-none" aria-hidden="true">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="absolute inset-0 z-0" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1920&q=80"
                alt="" class="w-full h-full object-cover opacity-[0.12]" loading="eager" fetchpriority="high">
        </div>

        <div class="absolute -top-40 -right-40 w-[700px] h-[700px] rounded-full blur-3xl pointer-events-none"
            style="background:rgba(21,125,154,0.08)" aria-hidden="true"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full blur-3xl pointer-events-none"
            style="background:rgba(226,174,73,0.05)" aria-hidden="true"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div>
                    <div class="gold-badge mb-8">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E2AE49] animate-pulse" aria-hidden="true"></span>
                        Premium Trade Services
                    </div>
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-black text-white leading-[1.08] mb-6 tracking-tight text-balance">
                        We are here to help
                        <span class="text-[#E2AE49] block mt-1">from start to finish</span>
                    </h1>
                    <p class="text-white/65 text-lg leading-relaxed mb-10 max-w-md">
                        Bespoke, high-standard trade services delivered with precision and care.
                        Removals, Valeting, Decor, Real Estate & Cleaning all under one roof.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#contact" class="btn-primary text-base">
                            <i data-lucide="file-text" class="w-5 h-5" aria-hidden="true"></i>
                            Get a Free Quote
                        </a>
                        <a href="#services" class="btn-ghost text-base">
                            <i data-lucide="layers" class="w-5 h-5" aria-hidden="true"></i>
                            Our Services
                        </a>
                    </div>
                    <div class="mt-12 flex flex-wrap items-center gap-6 text-sm text-white/50">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#E2AE49]" aria-hidden="true"></i>
                            <span>Fully Insured</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="star" class="w-4 h-4 text-[#E2AE49]" aria-hidden="true"></i>
                            <span>5-Star Rated</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4 text-[#E2AE49]" aria-hidden="true"></i>
                            <span>Fast Response</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="rounded-2xl p-8"
                        style="background:rgba(255,255,255,0.07);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.12)">
                        <h2 class="text-white/50 text-xs font-bold tracking-widest uppercase mb-7">Why Touch2finish?
                        </h2>
                        <div class="space-y-6">
                            @foreach ([['icon' => 'award', 'title' => 'Highest Standard', 'desc' => 'We never cut corners. Every job is completed to an exceptional level of finish.'], ['icon' => 'users', 'title' => 'All Are Welcome', 'desc' => 'Residential or commercial, big or small, we treat every client with equal care.'], ['icon' => 'pound-sterling', 'title' => 'Competitive Pricing', 'desc' => "Premium quality doesn't have to mean premium prices. We keep it fair and transparent."], ['icon' => 'headphones', 'title' => 'Dedicated Support', 'desc' => "From initial quote to project completion, we're with you every step of the way."]] as $item)
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                        style="background:rgba(226,174,73,0.15)">
                                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 text-[#E2AE49]"
                                            aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $item['title'] }}</p>
                                        <p class="text-white/50 text-xs leading-relaxed mt-0.5">{{ $item['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-2 text-white/30 text-xs"
            aria-hidden="true">
            <span class="tracking-widest uppercase text-[10px]">Scroll</span>
            <div class="w-px h-10 bg-white/15 animate-pulse"></div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════ ABOUT US ══════ --}}
    <section id="about" class="bg-white py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden" style="box-shadow:0 20px 40px -8px rgba(21,125,154,0.18)">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=900&q=80"
                            alt="Professional Touch2finish team members at work on a project"
                            class="w-full h-[520px] object-cover" loading="lazy">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-[#071B3B] text-white rounded-2xl px-8 py-6 hidden md:block"
                        style="box-shadow:0 20px 48px -8px rgba(7,27,59,0.35)">
                        <p class="text-4xl font-black text-[#E2AE49]" style="font-family:'Sora',sans-serif">100%</p>
                        <p class="text-sm text-white/70 mt-1">Satisfaction Guarantee</p>
                    </div>
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-2xl -z-10"
                        style="background:rgba(226,174,73,0.80)" aria-hidden="true"></div>
                </div>
                <div>
                    <span class="eyebrow">Who We Are</span>
                    <h2 class="section-heading mb-6">Standard is everything</h2>
                    <p class="text-[#485465] leading-relaxed mb-5 text-base">
                        Touch2finish was founded on a single, uncompromising belief: that every client,
                        regardless of the size or complexity of their project, deserves to receive work of
                        the absolute highest standard.
                    </p>
                    <p class="text-[#485465] leading-relaxed mb-8 text-base">
                        Whether you need a single room refreshed, a full property refurbished, your vehicle detailed to
                        a showroom finish, or a complex real estate development managed from start to finish, we bring
                        the same relentless commitment to quality to every job.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        @foreach ([['icon' => 'check-circle', 'text' => 'Bespoke service plans'], ['icon' => 'check-circle', 'text' => 'No hidden costs'], ['icon' => 'check-circle', 'text' => 'Experienced tradespeople'], ['icon' => 'check-circle', 'text' => 'Fully vetted & insured']] as $point)
                            <div class="flex items-center gap-2 text-sm font-medium text-[#485465]">
                                <i data-lucide="{{ $point['icon'] }}" class="w-4 h-4 text-[#E2AE49] flex-shrink-0"
                                    aria-hidden="true"></i>
                                {{ $point['text'] }}
                            </div>
                        @endforeach
                    </div>
                    <a href="#contact" class="btn-primary">
                        Work With Us
                        <i data-lucide="arrow-right" class="w-4 h-4" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════ SERVICES ══════ --}}
    <section id="services" class="py-24 px-6 bg-[#F4F7F8]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="eyebrow">What We Do</span>
                <h2 class="section-heading mt-2 mb-4">Our Services</h2>
                <span class="gold-rule mx-auto" aria-hidden="true"></span>
            </div>

            @php
                // FIX: interior-decor now uses asset() for an absolute URL,
                // consistent with ContactController. Background-image CSS works
                // correctly from any URL depth.
                $services = [
                    [
                        'slug' => 'removals-handyman',
                        'title' => 'Removals & HandyMan',
                        'icon' => 'truck',
                        'image' =>
                            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                        'desc' =>
                            'Local or long distance. Small, big, or fragile items. Handled with care and professionalism.',
                    ],
                    [
                        'slug' => 'car-valeting',
                        'title' => 'Car Valeting & Wash',
                        'icon' => 'car',
                        'image' =>
                            'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=800&q=80',
                        'desc' =>
                            'Showroom-grade detailing for your vehicle. Interior, exterior, and everything in between.',
                    ],
                    [
                        'slug' => 'interior-decor',
                        'title' => 'Interior Decor & Refurb',
                        'icon' => 'paint-roller',
                        'image' => asset('images/interior-decor.jpg'),
                        'desc' =>
                            'Transform your space with expert decorating and refurbishment to the highest standard.',
                    ],
                    [
                        'slug' => 'real-estate',
                        'title' => 'Real Estate Development',
                        'icon' => 'building-2',
                        'image' =>
                            'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80',
                        'desc' =>
                            'From acquisition to completion, we manage property development with strategic expertise.',
                    ],
                    [
                        'slug' => 'cleaning',
                        'title' => 'Private & Commercial Cleaning',
                        'icon' => 'sparkles',
                        'image' =>
                            'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=800&q=80',
                        'desc' =>
                            'Immaculate results for homes and businesses. Scheduled, deep clean, or post-construction.',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $i => $service)
                    <div class="service-card {{ $i === 4 ? 'md:col-span-2 lg:col-span-1' : '' }}">
                        <div class="service-card__bg" style="background-image:url('{{ $service['image'] }}');"
                            role="img" aria-label="{{ $service['title'] }} service background"></div>
                        <div class="service-card__overlay" aria-hidden="true"></div>
                        <div class="service-card__face">
                            <div class="w-14 h-14 rounded-2xl bg-[#CBD9DC] flex items-center justify-center mb-4"
                                style="box-shadow:0 4px 20px -2px rgba(21,125,154,0.10)">
                                <i data-lucide="{{ $service['icon'] }}" class="w-7 h-7 text-[#157D9A]"
                                    aria-hidden="true"></i>
                            </div>
                            <h3 class="text-[#071B3B] font-black text-center text-base leading-snug">
                                {{ $service['title'] }}</h3>
                            <div class="mt-3 w-8 h-0.5 bg-[#E2AE49] rounded-full" aria-hidden="true"></div>
                        </div>
                        <div class="service-card__content">
                            <div class="w-10 h-10 rounded-xl mb-4 flex items-center justify-center"
                                style="background:rgba(255,255,255,0.15)" aria-hidden="true">
                                <i data-lucide="{{ $service['icon'] }}" class="w-5 h-5 text-[#E2AE49]"></i>
                            </div>
                            <h3 class="text-xl font-black text-white mb-2">{{ $service['title'] }}</h3>
                            <p class="text-white/75 text-sm leading-relaxed mb-5">{{ $service['desc'] }}</p>
                            <a href="/services/{{ $service['slug'] }}"
                                class="inline-flex items-center gap-1.5 text-[#E2AE49] text-sm font-bold hover:gap-3 transition-all duration-200">
                                Learn More
                                <i data-lucide="arrow-right" class="w-4 h-4" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ GALLERY ══════ --}}
    <section id="gallery-section" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="eyebrow">Our Work</span>
                    <h2 class="section-heading mt-2">Recent Projects</h2>
                </div>

            </div>
            <span class="gold-rule mt-4" aria-hidden="true"></span>
        </div>

        <div class="swiper projects-swiper px-6 md:px-12" role="region" aria-label="Recent project gallery">
            <div class="swiper-wrapper">
                @php
                    $gallery = [
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Living Room Renovation',
                            'cat' => 'Interior Decor',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Kitchen Deep Clean',
                            'cat' => 'Cleaning',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Property Development',
                            'cat' => 'Real Estate',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Executive Car Valet',
                            'cat' => 'Car Valeting',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Bedroom Transformation',
                            'cat' => 'Interior Decor',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Office Removal',
                            'cat' => 'Removals',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?auto=format&fit=crop&w=900&q=80',
                            'label' => 'New Build Completion',
                            'cat' => 'Real Estate',
                        ],
                        [
                            'src' =>
                                'https://images.unsplash.com/photo-1527515673510-8aa78ce21f9b?auto=format&fit=crop&w=900&q=80',
                            'label' => 'Commercial Cleaning',
                            'cat' => 'Cleaning',
                        ],
                    ];
                @endphp

                @foreach ($gallery as $photo)
                    <div class="swiper-slide !w-[280px] md:!w-[360px]">
                        <a href="{{ $photo['src'] }}" data-fancybox="gallery"
                            data-caption="{{ $photo['label'] }} — {{ $photo['cat'] }}" class="gallery-slide-card"
                            aria-label="View full-screen: {{ $photo['label'] }}, {{ $photo['cat'] }}">
                            <img src="{{ $photo['src'] }}"
                                alt="{{ $photo['label'] }} — Touch2finish {{ $photo['cat'] }} project"
                                loading="lazy">
                            <div class="gallery-slide-overlay" aria-hidden="true">
                                <div class="flex-1">
                                    <span class="gallery-slide-cat">{{ $photo['cat'] }}</span>
                                    <span class="gallery-slide-label">{{ $photo['label'] }}</span>
                                </div>
                                <div class="gallery-slide-zoom">
                                    <i data-lucide="zoom-in" class="w-4 h-4 text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev" aria-label="Previous project"></div>
            <div class="swiper-button-next" aria-label="Next project"></div>
            <div class="swiper-pagination" aria-label="Gallery pagination"></div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════ CONTACT / QUOTE ══════ --}}
    <section id="contact" class="py-24 px-6 bg-[#F4F7F8]">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">

                <div class="lg:col-span-2">
                    <span class="eyebrow">Let's Talk</span>
                    <h2 class="section-heading mt-2 mb-5">Get a Free<br>Quote Today</h2>
                    <p class="text-[#485465] leading-relaxed mb-8">
                        Fill in the form and our team will respond with a tailored, no-obligation quote within 24 hours.
                        Standard is everything and that starts from your very first enquiry.
                    </p>
                    <div class="space-y-4">
                        @foreach ([['icon' => 'mail', 'label' => 'Email Us', 'value' => 'info@touch2finish.co.uk', 'href' => 'mailto:info@touch2finish.co.uk'], ['icon' => 'phone', 'label' => 'Call Us', 'value' => '+44 7456 490 400', 'href' => 'tel:+447456490400'], ['icon' => 'clock', 'label' => 'Response Time', 'value' => 'Within 24 hours', 'href' => null]] as $contact)
                            <div class="flex items-center gap-4 bg-white rounded-xl p-4 border border-[#CBD9DC]/30"
                                style="box-shadow:0 4px 20px -2px rgba(21,125,154,0.08)">
                                <div
                                    class="w-11 h-11 rounded-xl bg-[#157D9A] flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="{{ $contact['icon'] }}" class="w-5 h-5 text-white"
                                        aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-[#485465]/50 font-bold uppercase tracking-widest">
                                        {{ $contact['label'] }}</p>
                                    @if ($contact['href'])
                                        <a href="{{ $contact['href'] }}"
                                            class="text-[#071B3B] font-bold text-sm hover:text-[#157D9A] transition-colors">{{ $contact['value'] }}</a>
                                    @else
                                        <p class="text-[#071B3B] font-bold text-sm">{{ $contact['value'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl border border-[#CBD9DC]/20 p-8 md:p-10"
                        style="box-shadow:0 20px 40px -8px rgba(21,125,154,0.15)">

                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl" role="alert">
                                <div class="flex items-center gap-2 mb-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"
                                        aria-hidden="true"></i>
                                    <p class="text-red-700 font-semibold text-sm">Please fix the following errors:</p>
                                </div>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600 text-sm">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('quote.submit') }}" method="POST" x-data="{ submitting: false }"
                            x-on:submit="submitting = true" class="space-y-5" novalidate>
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="name"
                                        class="block text-xs font-bold text-[#485465]/60 uppercase tracking-widest mb-2">Full
                                        Name <span class="text-[#E2AE49]" aria-label="required">*</span></label>
                                    <div class="relative">
                                        <i data-lucide="user"
                                            class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#CBD9DC] pointer-events-none"
                                            aria-hidden="true"></i>
                                        <input type="text" id="name" name="name"
                                            value="{{ old('name') }}" placeholder="John Smith" autocomplete="name"
                                            class="t2f-input @error('name') error @enderror">
                                    </div>
                                    @error('name')
                                        <p class="mt-1 text-red-500 text-xs" role="alert">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-xs font-bold text-[#485465]/60 uppercase tracking-widest mb-2">Email
                                        Address <span class="text-[#E2AE49]" aria-label="required">*</span></label>
                                    <div class="relative">
                                        <i data-lucide="mail"
                                            class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#CBD9DC] pointer-events-none"
                                            aria-hidden="true"></i>
                                        <input type="email" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="john@example.com"
                                            autocomplete="email" class="t2f-input @error('email') error @enderror">
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-red-500 text-xs" role="alert">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="phone"
                                    class="block text-xs font-bold text-[#485465]/60 uppercase tracking-widest mb-2">Phone
                                    Number <span class="text-[#E2AE49]" aria-label="required">*</span></label>
                                <div class="relative">
                                    <i data-lucide="phone"
                                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#CBD9DC] pointer-events-none"
                                        aria-hidden="true"></i>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="+44 7700 900000" autocomplete="tel"
                                        class="t2f-input @error('phone') error @enderror">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-red-500 text-xs" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="service"
                                    class="block text-xs font-bold text-[#485465]/60 uppercase tracking-widest mb-2">Service
                                    Required <span class="text-[#E2AE49]" aria-label="required">*</span></label>
                                <div class="relative">
                                    <i data-lucide="briefcase"
                                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#CBD9DC] pointer-events-none"
                                        aria-hidden="true"></i>
                                    <select id="service" name="service"
                                        class="t2f-input appearance-none pr-10 @error('service') error @enderror">
                                        <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select
                                            a service…</option>
                                        @foreach (['Removals & HandyMan', 'Car Valeting / Wash', 'Interior Decor / Refurb', 'Real Estate Development', 'Private / Commercial Cleaning', 'Multiple Services'] as $svc)
                                            <option value="{{ $svc }}"
                                                {{ old('service') === $svc ? 'selected' : '' }}>{{ $svc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#CBD9DC] pointer-events-none"
                                        aria-hidden="true"></i>
                                </div>
                                @error('service')
                                    <p class="mt-1 text-red-500 text-xs" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="message"
                                    class="block text-xs font-bold text-[#485465]/60 uppercase tracking-widest mb-2">Project
                                    Details <span class="text-[#E2AE49]" aria-label="required">*</span></label>
                                <textarea id="message" name="message" rows="5"
                                    placeholder="Tell us about your project — location, scope, timeline, any specific requirements…"
                                    class="t2f-input pl-4 resize-none @error('message') error @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-red-500 text-xs" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="btn-primary w-full justify-center text-base py-4 disabled:opacity-70 disabled:cursor-not-allowed"
                                x-bind:disabled="submitting" x-bind:aria-busy="submitting.toString()">
                                <span x-show="!submitting" class="flex items-center justify-center gap-2">
                                    <i data-lucide="send" class="w-5 h-5" aria-hidden="true"></i>
                                    Send Quote Request
                                </span>

                                <span x-show="submitting" class="flex items-center justify-center gap-2"
                                    style="display: none;">
                                    <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                    Sending Request...
                                </span>
                            </button>
                            <p class="text-center text-xs text-[#485465]/40">
                                <i data-lucide="lock" class="w-3 h-3 inline-block mr-1" aria-hidden="true"></i>
                                Your information is secure and will never be shared.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show"
            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed bottom-6 right-6 z-[9999] max-w-sm w-full" role="status" aria-live="polite"
            style="display:none">
            <div class="bg-[#071B3B] text-white rounded-2xl px-6 py-5 flex items-start gap-4 border border-[#157D9A]/20"
                style="box-shadow:0 20px 48px -8px rgba(7,27,59,0.35)">
                <div class="w-10 h-10 rounded-xl bg-[#E2AE49] flex items-center justify-center flex-shrink-0">
                    <i data-lucide="check" class="w-5 h-5 text-white" aria-hidden="true"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm mb-0.5">Quote Request Sent!</p>
                    <p class="text-white/65 text-xs leading-relaxed">{{ session('success') }}</p>
                </div>
                <button @click="show = false"
                    class="text-white/40 hover:text-white transition-colors mt-0.5 flex-shrink-0"
                    aria-label="Dismiss notification">
                    <i data-lucide="x" class="w-4 h-4" aria-hidden="true"></i>
                </button>
            </div>
            <div class="h-1 bg-[#E2AE49]/20 rounded-full mt-1 mx-2 overflow-hidden" aria-hidden="true">
                <div class="h-full bg-[#E2AE49] rounded-full" style="animation:toast-progress 6s linear forwards;">
                </div>
            </div>
        </div>
        <style>
            @keyframes toast-progress {
                from {
                    width: 100%;
                }

                to {
                    width: 0%;
                }
            }
        </style>
    @endif

    @push('scripts')
        <script>
            (function initSwiper() {
                if (!window.Swiper) {
                    console.warn('Touch2finish: Swiper did not load.');
                    return;
                }
                new Swiper('.projects-swiper', {
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    loop: true,
                    speed: 650,
                    grabCursor: true,
                    freeMode: {
                        enabled: true,
                        momentum: true
                    },
                    autoplay: {
                        delay: 3800,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    a11y: {
                        prevSlideMessage: 'Previous project',
                        nextSlideMessage: 'Next project'
                    },
                    breakpoints: {
                        640: {
                            spaceBetween: 24
                        },
                        1024: {
                            spaceBetween: 28
                        }
                    },
                });
            })();
            if (window.lucide) lucide.createIcons();
        </script>
    @endpush

</x-layout>
