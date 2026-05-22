<x-layout>

    <x-slot name="seo">
        @php
            // FIX: Ensure $service['image'] is always an absolute URL for JSON-LD.
            // asset() images are already absolute. Unsplash URLs are also absolute.
            // This guard handles any edge case where a bare path slips through.
            $absoluteImage = Str::startsWith($service['image'], ['http://', 'https://'])
                ? $service['image']
                : asset($service['image']);

            $serviceSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $service['title'],
                'description' => Str::limit(strip_tags($service['writeup']), 200),
                'provider' => [
                    '@type' => 'LocalBusiness',
                    '@id' => url('/') . '#business',
                    'name' => 'Touch2finish',
                    'url' => url('/'),
                    'telephone' => '+44-7456-490400',
                    'email' => 'info@touch2finish.co.uk',
                    'areaServed' => 'United Kingdom',
                ],
                'url' => url()->current(),
                'image' => $absoluteImage, // FIX: always absolute
                'areaServed' => ['@type' => 'Country', 'name' => 'United Kingdom'],
                'offers' => [
                    '@type' => 'Offer',
                    'availability' => 'https://schema.org/InStock',
                    'priceCurrency' => 'GBP',
                    'url' => url('/#contact'),
                ],
            ];
        @endphp
        @include('partials.seo', [
            'title' => $service['title'] . ' | Touch2finish',
            'description' =>
                'Touch2finish provides premium ' .
                strtolower($service['title']) .
                ' services across the UK. ' .
                Str::limit(strip_tags($service['writeup']), 120) .
                ' Get a free quote today.',
            'canonical' => url()->current(),
            'ogImage' => $absoluteImage, // FIX: always absolute
            'schema' => $serviceSchema,
        ])
    </x-slot>

    {{-- ═══════════════════════════════════════════════════════════ HERO ══════ --}}
    <section class="relative min-h-[52vh] flex items-end bg-[#071B3B] overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ $absoluteImage }}" alt="{{ $service['title'] }} — professional service by Touch2finish"
                class="w-full h-full object-cover" loading="eager" fetchpriority="high">
        </div>

        <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#071B3B] via-[#071B3B]/75 to-[#071B3B]/20"
            aria-hidden="true"></div>

        <div class="absolute inset-0 z-[5] opacity-[0.06] pointer-events-none" aria-hidden="true">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="1.5" cy="1.5" r="1.5" fill="white" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)" />
            </svg>
        </div>

        <div class="relative z-20 max-w-7xl mx-auto px-6 py-16 w-full">
            <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-white/45 text-xs font-medium mb-6">
                <a href="/" class="hover:text-[#E2AE49] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
                <a href="/#services" class="hover:text-[#E2AE49] transition-colors">Services</a>
                <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
                <span class="text-white/75" aria-current="page">{{ $service['title'] }}</span>
            </nav>
            <div class="gold-badge mb-5">
                <i data-lucide="{{ $service['icon'] }}" class="w-3.5 h-3.5" aria-hidden="true"></i>
                Premium Service
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight text-balance">
                {{ $service['title'] }}
            </h1>
        </div>
    </section>

    {{-- ═════════════════════════════════════════════ TWO-COLUMN CONTENT ══════ --}}
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

                <div class="lg:col-span-2">
                    <span class="eyebrow">About This Service</span>
                    <h2 class="section-heading mt-2 mb-6">
                        The Touch2finish Approach<br>
                        to {{ Str::before($service['title'], ' &') ?: $service['title'] }}
                    </h2>
                    <div class="text-[#485465] text-base leading-relaxed space-y-5">
                        {!! nl2br(e($service['writeup'])) !!}
                    </div>

                    <div class="mt-12">
                        <h3 class="text-xl font-black text-[#071B3B] mb-6">Our Process</h3>
                        <div class="space-y-3">
                            @foreach ([['step' => '01', 'title' => 'Initial Consultation', 'desc' => 'We begin with a thorough understanding of your requirements, timeline, and expectations.'], ['step' => '02', 'title' => 'Tailored Quotation', 'desc' => 'You receive a detailed, transparent, no-obligation quote with no hidden costs.'], ['step' => '03', 'title' => 'Expert Execution', 'desc' => 'Our skilled team gets to work, keeping you informed at every stage of the project.'], ['step' => '04', 'title' => 'Quality Sign-Off', 'desc' => 'We complete a thorough quality check and only sign off once you are fully satisfied.']] as $step)
                                <div
                                    class="flex items-start gap-5 p-5 rounded-2xl hover:bg-[#F4F7F8] transition-colors duration-200 border border-transparent hover:border-[#CBD9DC]/40">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                        style="background:rgba(21,125,154,0.07);border:1px solid rgba(21,125,154,0.15)">
                                        <span class="text-[#157D9A] font-black text-sm">{{ $step['step'] }}</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#071B3B] text-sm">{{ $step['title'] }}</p>
                                        <p class="text-[#485465]/70 text-sm mt-0.5 leading-relaxed">{{ $step['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28 space-y-5">
                        <div class="bg-[#071B3B] rounded-2xl p-7 text-white"
                            style="box-shadow:0 20px 48px -8px rgba(7,27,59,0.35)">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                    style="background:rgba(226,174,73,0.20)">
                                    <i data-lucide="{{ $service['icon'] }}" class="w-5 h-5 text-[#E2AE49]"
                                        aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold tracking-widest uppercase text-white/40">Why Choose
                                        Us</p>
                                    <h3 class="font-black text-sm text-white">Key Benefits</h3>
                                </div>
                            </div>
                            <ul class="space-y-4">
                                @foreach ($service['benefits'] as $benefit)
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="w-6 h-6 rounded-full bg-[#E2AE49] flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-white"
                                                aria-hidden="true"></i>
                                        </div>
                                        <span class="text-sm text-white/75 leading-relaxed">{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bg-[#F4F7F8] rounded-2xl p-6 border border-[#CBD9DC]/40">
                            <p class="font-black text-[#071B3B] text-sm mb-1">Ready to get started?</p>
                            <p class="text-[#485465]/60 text-xs mb-4">Get a free, no-obligation quote for your project
                                today.</p>
                            <a href="/#contact" class="btn-primary w-full justify-center text-sm py-3">
                                <i data-lucide="file-text" class="w-4 h-4" aria-hidden="true"></i>
                                Get a Free Quote
                            </a>
                            <div class="mt-4 pt-4 border-t border-[#CBD9DC]/40 space-y-3">
                                <a href="tel:+447456490400"
                                    class="flex items-center gap-3 text-sm text-[#485465] hover:text-[#157D9A] transition-colors">
                                    <i data-lucide="phone" class="w-4 h-4 text-[#157D9A] flex-shrink-0"
                                        aria-hidden="true"></i>
                                    +44 7456 490 400
                                </a>
                                <a href="mailto:info@touch2finish.co.uk"
                                    class="flex items-center gap-3 text-sm text-[#485465] hover:text-[#157D9A] transition-colors">
                                    <i data-lucide="mail" class="w-4 h-4 text-[#157D9A] flex-shrink-0"
                                        aria-hidden="true"></i>
                                    info@touch2finish.co.uk
                                </a>
                            </div>
                        </div>

                        <a href="/#services"
                            class="flex items-center justify-center gap-2 text-sm font-semibold text-[#485465]/60 hover:text-[#157D9A] transition-colors py-2">
                            <i data-lucide="arrow-left" class="w-4 h-4" aria-hidden="true"></i>
                            View All Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═════════════════════════════════════════════════════════ CTA BAND ══════ --}}
    <section class="bg-[#157D9A] py-16 px-6" aria-labelledby="service-cta-heading">
        <div class="max-w-4xl mx-auto text-center">
            <h2 id="service-cta-heading" class="text-2xl md:text-3xl font-black text-white mb-4 text-balance">
                Ready for a premium {{ strtolower($service['title']) }} experience?
            </h2>
            <p class="text-white/70 mb-8 max-w-xl mx-auto">
                Get your free, no-obligation quote within 24 hours. Standard is everything — and that starts from your
                very first enquiry.
            </p>
            <a href="/#contact" class="btn-primary text-base px-10 py-4">
                <i data-lucide="file-text" class="w-5 h-5" aria-hidden="true"></i>
                Get Your Free Quote
            </a>
        </div>
    </section>

    @push('scripts')
        <script>
            if (window.lucide) lucide.createIcons();
        </script>
    @endpush

</x-layout>
