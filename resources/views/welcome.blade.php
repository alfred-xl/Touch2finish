<x-layout>
    <x-slot name="title">Touch2finish | Premium Trade Services — Standard is Everything</x-slot>

    {{-- ═══════════════════════════════════════════════════════ HERO ══════ --}}
    <section class="relative bg-brand-teal overflow-hidden min-h-[90vh] flex items-center">
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1920&q=80"
                alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div
            class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div
                        class="inline-flex items-center gap-2 bg-brand-yellow/20 border border-brand-yellow/40 text-brand-yellow px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase mb-8">
                        <span class="w-2 h-2 rounded-full bg-brand-yellow animate-pulse"></span>
                        UK's Premium Trade Services
                    </div>
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.1] mb-6 tracking-tight">
                        We are here<br>to help!<br>
                        <span class="text-brand-yellow">From start</span><br>
                        <span class="text-brand-yellow">to finish.</span>
                    </h1>
                    <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-md">
                        Bespoke, high-standard trade services delivered with precision and care.
                        Removals, Valeting, Decor, Real Estate & Cleaning — all under one roof.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#contact"
                            class="inline-flex items-center gap-2 bg-brand-yellow text-gray-900 font-bold px-8 py-4 rounded-xl hover:bg-yellow-300 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-base">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                            Get a Free Quote
                        </a>
                        <a href="#services"
                            class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white font-bold px-8 py-4 rounded-xl hover:bg-white/20 transition-all duration-200 border border-white/20 text-base">
                            <i data-lucide="layers" class="w-5 h-5"></i>
                            Our Services
                        </a>
                    </div>
                    <div class="mt-12 flex flex-wrap items-center gap-6 text-sm text-white/50">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-brand-yellow"></i>
                            <span>Fully Insured</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="star" class="w-4 h-4 text-brand-yellow"></i>
                            <span>5-Star Rated</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4 text-brand-yellow"></i>
                            <span>Fast Response</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 shadow-soft-lg">
                        <h3 class="text-white/60 text-sm font-bold tracking-widest uppercase mb-6">Why Touch2finish?
                        </h3>
                        <div class="space-y-6">
                            @foreach ([['icon' => 'award', 'title' => 'Highest Standard', 'desc' => 'We never cut corners. Every job is completed to an exceptional level of finish.'], ['icon' => 'users', 'title' => 'All Are Welcome', 'desc' => 'Residential or commercial, big or small — we treat every client with equal care.'], ['icon' => 'pound-sterling', 'title' => 'Competitive Pricing', 'desc' => "Premium quality doesn't have to mean premium prices. We keep it fair and transparent."], ['icon' => 'headphones', 'title' => 'Dedicated Support', 'desc' => "From initial quote to project completion, we're with you every step of the way."]] as $item)
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-brand-yellow/20 flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 text-brand-yellow"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $item['title'] }}</p>
                                        <p class="text-white/55 text-xs leading-relaxed mt-0.5">{{ $item['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-2 text-white/40 text-xs">
            <span class="tracking-widest uppercase">Scroll</span>
            <div class="w-px h-10 bg-white/20 animate-pulse"></div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════ ABOUT US ══════ --}}
    <section id="about" class="bg-white py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-soft-lg">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=900&q=80"
                            alt="Professional team at work" class="w-full h-[520px] object-cover">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 bg-brand-teal text-white rounded-2xl px-8 py-6 shadow-soft-lg hidden md:block">
                        <p class="text-4xl font-black text-brand-yellow">100%</p>
                        <p class="text-sm text-white/70 mt-1">Satisfaction Guarantee</p>
                    </div>
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-brand-yellow rounded-2xl -z-10 opacity-80"></div>
                </div>

                <div>
                    <span
                        class="inline-block text-brand-yellow font-bold tracking-widest uppercase text-xs mb-3 bg-brand-yellow/10 px-3 py-1 rounded-full">Who
                        We Are</span>
                    {{-- Teal on headings is intentional brand accent on white bg --}}
                    <h2 class="text-3xl md:text-4xl font-black text-brand-teal mb-6 leading-tight">
                        Standard is<br>everything.
                    </h2>
                    {{-- Body copy: charcoal, not teal --}}
                    <p class="text-gray-600 leading-relaxed mb-5 text-base">
                        Touch2finish was founded on a single, uncompromising belief: that every client —
                        regardless of the size or complexity of their project — deserves to receive work of
                        the absolute highest standard.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8 text-base">
                        Whether you need a single room refreshed, a full property refurbishment, your vehicle
                        detailed to a showroom finish, or complex real estate development managed end-to-end —
                        we bring the same relentless commitment to quality to every single job.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        @foreach ([['icon' => 'check-circle', 'text' => 'Bespoke service plans'], ['icon' => 'check-circle', 'text' => 'No hidden costs'], ['icon' => 'check-circle', 'text' => 'Experienced tradespeople'], ['icon' => 'check-circle', 'text' => 'Fully vetted & insured']] as $point)
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <i data-lucide="{{ $point['icon'] }}"
                                    class="w-4 h-4 text-brand-yellow flex-shrink-0"></i>
                                {{ $point['text'] }}
                            </div>
                        @endforeach
                    </div>

                    <a href="#contact"
                        class="inline-flex items-center gap-2 bg-brand-teal text-white font-bold px-7 py-3.5 rounded-xl hover:bg-brand-teal/90 transition-all duration-200 shadow-soft hover:shadow-soft-hover">
                        Work With Us <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ SERVICES ══════ --}}
    {{--
        Cards use the .service-card CSS class system defined in layout.blade.php.
        See that file's <style> block for the full explanation of why the old
        Tailwind opacity utility approach was replaced.
    --}}
    <section id="services" class="py-24 px-6 bg-brand-light">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span
                    class="inline-block text-brand-yellow font-bold tracking-widest uppercase text-xs mb-3 bg-brand-teal/10 px-3 py-1 rounded-full">What
                    We Do</span>
                <h2 class="text-3xl md:text-4xl font-black text-brand-teal mb-4">Our Services</h2>
                <div class="w-16 h-1 bg-brand-yellow mx-auto rounded-full"></div>
            </div>

            @php
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
                        'image' =>
                            'https://images.unsplash.com/photo-1505691938895-1758d7def511?auto=format&fit=crop&w=800&q=80',
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

                        {{-- Photographic background --}}
                        <div class="service-card__bg" style="background-image: url('{{ $service['image'] }}');"></div>

                        {{-- Teal gradient overlay --}}
                        <div class="service-card__overlay"></div>

                        {{-- White resting face (desktop only, before hover) --}}
                        <div class="service-card__face">
                            <div
                                class="w-14 h-14 rounded-xl bg-brand-light flex items-center justify-center mb-4 shadow-soft">
                                <i data-lucide="{{ $service['icon'] }}" class="w-7 h-7 text-brand-teal"></i>
                            </div>
                            <h3 class="text-gray-900 font-bold text-center text-lg leading-snug">
                                {{ $service['title'] }}</h3>
                            <div class="mt-3 w-8 h-0.5 bg-brand-yellow rounded-full"></div>
                        </div>

                        {{-- Content revealed on hover (desktop) / always visible (mobile) --}}
                        <div class="service-card__content">
                            <div class="w-10 h-10 rounded-lg mb-4 flex items-center justify-center"
                                style="background:rgba(255,255,255,0.15)">
                                <i data-lucide="{{ $service['icon'] }}" class="w-5 h-5 text-brand-yellow"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">{{ $service['title'] }}</h3>
                            <p class="text-white/80 text-sm leading-relaxed mb-4">{{ $service['desc'] }}</p>
                            <a href="/services/{{ $service['slug'] }}"
                                class="inline-flex items-center gap-1.5 text-brand-yellow text-sm font-bold hover:gap-3 transition-all duration-200">
                                Learn More <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════ GALLERY — Swiper + Fancybox ══════ --}}
    <section id="gallery" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span
                        class="inline-block text-brand-yellow font-bold tracking-widest uppercase text-xs mb-3 bg-brand-teal/10 px-3 py-1 rounded-full">Our
                        Work</span>
                    <h2 class="text-3xl md:text-4xl font-black text-brand-teal">Recent Projects</h2>
                </div>
                <p class="text-gray-500 text-sm max-w-xs md:text-right">Click any image to view full-screen.</p>
            </div>
            <div class="w-16 h-1 bg-brand-yellow rounded-full mt-4"></div>
        </div>

        <div class="swiper projects-swiper px-6 md:px-12">
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
                    <div class="swiper-slide !w-[280px] md:!w-[350px]">
                        {{--
                        data-fancybox="gallery" groups all images into one lightbox.
                        Clicking opens Fancybox; the close button is guaranteed
                        accessible because layout.blade.php now drops the header's
                        z-index to 0 on init and restores it on destroy.
                    --}}
                        <a href="{{ $photo['src'] }}" data-fancybox="gallery"
                            data-caption="{{ $photo['label'] }} — {{ $photo['cat'] }}"
                            class="group block rounded-2xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 relative">
                            <img src="{{ $photo['src'] }}" alt="{{ $photo['label'] }}"
                                class="w-full h-[220px] md:h-[260px] object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-brand-teal/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                                <div>
                                    <span
                                        class="inline-block text-brand-yellow text-[10px] font-bold tracking-widest uppercase mb-1">{{ $photo['cat'] }}</span>
                                    <p class="text-white font-bold text-sm">{{ $photo['label'] }}</p>
                                </div>
                                <div
                                    class="ml-auto w-8 h-8 rounded-full bg-brand-yellow/90 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="zoom-in" class="w-4 h-4 text-brand-teal"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination !bottom-0 mt-6"></div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════ CONTACT / QUOTE ══════ --}}
    <section id="contact" class="py-24 px-6 bg-brand-light">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">

                {{-- Left: info --}}
                <div class="lg:col-span-2">
                    <span
                        class="inline-block text-brand-yellow font-bold tracking-widest uppercase text-xs mb-3 bg-brand-teal/10 px-3 py-1 rounded-full">Let's
                        Talk</span>
                    <h2 class="text-3xl md:text-4xl font-black text-brand-teal mb-5 leading-tight">
                        Get a Free<br>Quote Today
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Fill in the form and our team will respond with a tailored, no-obligation quote within 24 hours.
                        Standard is everything — and that starts from your very first enquiry.
                    </p>

                    <div class="space-y-4">
                        @foreach ([['icon' => 'mail', 'label' => 'Email Us', 'value' => 'info@touch2finish.co.uk', 'href' => 'mailto:info@touch2finish.co.uk'], ['icon' => 'phone', 'label' => 'Call Us', 'value' => '+44 7456 490 400', 'href' => 'tel:+447456490400'], ['icon' => 'clock', 'label' => 'Response Time', 'value' => 'Within 24 hours', 'href' => null]] as $contact)
                            <div class="flex items-center gap-4 bg-white rounded-xl p-4 shadow-soft">
                                <div
                                    class="w-11 h-11 rounded-lg bg-brand-teal flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="{{ $contact['icon'] }}" class="w-5 h-5 text-brand-yellow"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-widest">
                                        {{ $contact['label'] }}</p>
                                    @if ($contact['href'])
                                        <a href="{{ $contact['href'] }}"
                                            class="text-gray-800 font-bold text-sm hover:text-brand-teal transition-colors">{{ $contact['value'] }}</a>
                                    @else
                                        <p class="text-gray-800 font-bold text-sm">{{ $contact['value'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: form --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-soft p-8 md:p-10">

                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                <div class="flex items-center gap-2 mb-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
                                    <p class="text-red-700 font-semibold text-sm">Please fix the following errors:</p>
                                </div>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600 text-sm">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('quote.submit') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="name"
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Full
                                        Name *</label>
                                    <div class="relative">
                                        <i data-lucide="user"
                                            class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 pointer-events-none"></i>
                                        <input type="text" id="name" name="name"
                                            value="{{ old('name') }}" placeholder="John Smith"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 text-gray-900 text-sm focus:outline-none focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/10 transition-all placeholder-gray-300 @error('name') border-red-400 @enderror">
                                    </div>
                                    @error('name')
                                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Email
                                        Address *</label>
                                    <div class="relative">
                                        <i data-lucide="mail"
                                            class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 pointer-events-none"></i>
                                        <input type="email" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="john@example.com"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 text-gray-900 text-sm focus:outline-none focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/10 transition-all placeholder-gray-300 @error('email') border-red-400 @enderror">
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="phone"
                                    class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Phone
                                    Number *</label>
                                <div class="relative">
                                    <i data-lucide="phone"
                                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 pointer-events-none"></i>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="+44 7700 900000"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 text-gray-900 text-sm focus:outline-none focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/10 transition-all placeholder-gray-300 @error('phone') border-red-400 @enderror">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="service"
                                    class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Service
                                    Required *</label>
                                <div class="relative">
                                    <i data-lucide="briefcase"
                                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 pointer-events-none"></i>
                                    <select id="service" name="service"
                                        class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-200 text-gray-900 text-sm focus:outline-none focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/10 transition-all appearance-none @error('service') border-red-400 @enderror">
                                        <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select
                                            a service...</option>
                                        <option value="Removals & HandyMan"
                                            {{ old('service') === 'Removals & HandyMan' ? 'selected' : '' }}>
                                            Removals & HandyMan</option>
                                        <option value="Car Valeting / Wash"
                                            {{ old('service') === 'Car Valeting / Wash' ? 'selected' : '' }}>Car
                                            Valeting / Wash</option>
                                        <option value="Interior Decor / Refurb"
                                            {{ old('service') === 'Interior Decor / Refurb' ? 'selected' : '' }}>
                                            Interior Decor / Refurb</option>
                                        <option value="Real Estate Development"
                                            {{ old('service') === 'Real Estate Development' ? 'selected' : '' }}>Real
                                            Estate Development</option>
                                        <option value="Private / Commercial Cleaning"
                                            {{ old('service') === 'Private / Commercial Cleaning' ? 'selected' : '' }}>
                                            Private / Commercial Cleaning</option>
                                        <option value="Multiple Services"
                                            {{ old('service') === 'Multiple Services' ? 'selected' : '' }}>
                                            Multiple Services</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 pointer-events-none"></i>
                                </div>
                                @error('service')
                                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message"
                                    class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Project
                                    Details *</label>
                                <textarea id="message" name="message" rows="5"
                                    placeholder="Tell us about your project — location, scope, timeline, any specific requirements..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-900 text-sm focus:outline-none focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/10 transition-all placeholder-gray-300 resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-brand-yellow text-gray-900 font-bold py-4 px-8 rounded-xl hover:bg-yellow-300 transition-all duration-200 shadow-soft hover:shadow-soft-hover hover:-translate-y-0.5 text-base">
                                <i data-lucide="send" class="w-5 h-5"></i>
                                Send Quote Request
                            </button>

                            <p class="text-center text-xs text-gray-400">
                                <i data-lucide="lock" class="w-3 h-3 inline-block mr-1"></i>
                                Your information is secure and will never be shared.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════ TOAST ══════ --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-8 translate-x-4"
            x-transition:enter-end="opacity-100 translate-y-0 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 translate-x-0"
            x-transition:leave-end="opacity-0 translate-y-4 translate-x-4"
            class="fixed bottom-6 right-6 z-[9999] max-w-sm w-full" style="display:none">
            <div class="bg-brand-teal text-white rounded-2xl shadow-soft-lg px-6 py-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-yellow flex items-center justify-center flex-shrink-0">
                    <i data-lucide="check" class="w-5 h-5 text-gray-900"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm mb-0.5">Quote Request Sent!</p>
                    <p class="text-white/70 text-xs leading-relaxed">{{ session('success') }}</p>
                </div>
                <button @click="show = false"
                    class="text-white/40 hover:text-white transition-colors mt-0.5 flex-shrink-0">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="h-1 bg-brand-yellow/30 rounded-full mt-1 mx-2 overflow-hidden">
                <div class="h-full bg-brand-yellow rounded-full"
                    style="animation: toast-progress 6s linear forwards;"></div>
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

    {{--
        @push('scripts') replaces the old <x-slot name="scripts"> pattern.
        The old pattern printed the slot content as a raw escaped string via
        {{ $scripts ?? '' }} in the layout — it never executed as JavaScript.
        @push / @stack is the correct Laravel mechanism for injecting
        page-specific <script> blocks into a layout's @stack('scripts') point.
    --}}
    @push('scripts')
        <script>
            lucide.createIcons();

            new Swiper('.projects-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                loop: true,
                speed: 600,
                grabCursor: true,
                freeMode: {
                    enabled: true,
                    momentum: true
                },
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        spaceBetween: 24
                    },
                    1024: {
                        spaceBetween: 28
                    },
                },
            });
        </script>
    @endpush

</x-layout>
