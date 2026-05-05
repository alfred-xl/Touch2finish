<x-layout>
    <x-slot name="title">{{ $service['title'] }} | Touch2finish</x-slot>

    {{-- ═══════════════════════════════════════════════════════ HERO ══════ --}}
    <section class="relative min-h-[50vh] flex items-end bg-brand-teal overflow-hidden">

        {{-- Background image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="w-full h-full object-cover">
        </div>

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-brand-teal via-brand-teal/70 to-brand-teal/20"></div>

        {{-- Dot pattern --}}
        <div class="absolute inset-0 z-5 opacity-10 pointer-events-none">
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

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-white/50 text-xs font-medium mb-6">
                <a href="/" class="hover:text-brand-yellow transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="/#services" class="hover:text-brand-yellow transition-colors">Services</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-white/80">{{ $service['title'] }}</span>
            </nav>

            {{-- Icon badge + heading --}}
            <div
                class="inline-flex items-center gap-2 bg-brand-yellow/20 border border-brand-yellow/40 text-brand-yellow px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase mb-5">
                <i data-lucide="{{ $service['icon'] }}" class="w-3.5 h-3.5"></i>
                Premium Service
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight">
                {{ $service['title'] }}
            </h1>
        </div>
    </section>

    {{-- ═══════════════════════════════════════ TWO-COLUMN CONTENT ══════ --}}
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

                {{-- ── Left: write-up + process (2 cols) ── --}}
                <div class="lg:col-span-2">

                    <span
                        class="inline-block text-brand-yellow font-bold tracking-widest uppercase text-xs mb-3 bg-brand-teal/10 px-3 py-1 rounded-full">
                        About This Service
                    </span>

                    {{-- Heading: teal is intentional brand accent on white bg --}}
                    <h2 class="text-2xl md:text-3xl font-black text-brand-teal mb-6 leading-tight">
                        The Touch2finish Approach<br>
                        to {{ Str::before($service['title'], ' &') ?: $service['title'] }}
                    </h2>

                    {{-- Body prose: charcoal, not teal --}}
                    <div class="text-gray-600 text-base leading-relaxed space-y-5">
                        {!! nl2br(e($service['writeup'])) !!}
                    </div>

                    {{-- Process steps --}}
                    <div class="mt-12">
                        {{-- Step heading: teal accent --}}
                        <h3 class="text-xl font-black text-brand-teal mb-6">Our Process</h3>

                        <div class="space-y-3">
                            @foreach ([['step' => '01', 'title' => 'Initial Consultation', 'desc' => 'We begin with a thorough understanding of your requirements, timeline, and expectations.'], ['step' => '02', 'title' => 'Tailored Quotation', 'desc' => 'You receive a detailed, transparent, no-obligation quote with no hidden costs.'], ['step' => '03', 'title' => 'Expert Execution', 'desc' => 'Our skilled team gets to work, keeping you informed at every stage of the project.'], ['step' => '04', 'title' => 'Quality Sign-Off', 'desc' => 'We complete a thorough quality check and only sign off once you are fully satisfied.']] as $step)
                                <div
                                    class="flex items-start gap-5 p-5 rounded-xl hover:bg-brand-light transition-colors duration-200">
                                    {{-- Step number bubble: teal bg/border as brand accent --}}
                                    <div
                                        class="w-12 h-12 rounded-xl bg-brand-teal/5 border border-brand-teal/10 flex items-center justify-center flex-shrink-0">
                                        <span class="text-brand-teal font-black text-sm">{{ $step['step'] }}</span>
                                    </div>
                                    <div>
                                        {{-- Step title: dark charcoal --}}
                                        <p class="font-bold text-gray-800 text-sm">{{ $step['title'] }}</p>
                                        {{-- Step desc: mid charcoal --}}
                                        <p class="text-gray-500 text-sm mt-0.5 leading-relaxed">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ── Right: sticky sidebar (1 col) ── --}}
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28 space-y-5">

                        {{-- Key Benefits card — teal background, white text: no changes needed here --}}
                        <div class="bg-brand-teal rounded-2xl p-7 shadow-soft-lg text-white">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-brand-yellow/20 flex items-center justify-center">
                                    <i data-lucide="{{ $service['icon'] }}" class="w-5 h-5 text-brand-yellow"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold tracking-widest uppercase text-white/50">Why Choose
                                        Us</p>
                                    <h3 class="font-black text-sm text-white">Key Benefits</h3>
                                </div>
                            </div>
                            <ul class="space-y-4">
                                @foreach ($service['benefits'] as $benefit)
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="w-6 h-6 rounded-full bg-brand-yellow flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-gray-900"></i>
                                        </div>
                                        <span class="text-sm text-white/85 leading-relaxed">{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Quick Quote card --}}
                        <div class="bg-brand-light rounded-2xl p-6 border border-gray-100">
                            {{-- Label: charcoal, not teal --}}
                            <p class="font-black text-gray-900 text-sm mb-1">Ready to get started?</p>
                            <p class="text-gray-500 text-xs mb-4">Get a free, no-obligation quote tailored to your
                                project.</p>
                            <a href="/#contact"
                                class="w-full inline-flex items-center justify-center gap-2 bg-brand-yellow text-gray-900 font-bold py-3 rounded-xl hover:bg-yellow-300 transition-all duration-200 text-sm">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                Request a Quote
                            </a>
                            <div class="flex items-center gap-2 mt-4 text-xs text-gray-400">
                                <i data-lucide="clock" class="w-3 h-3 text-gray-300"></i>
                                Response within 24 hours
                            </div>
                        </div>

                        {{-- Call card --}}
                        <div class="bg-white rounded-2xl p-5 shadow-soft border border-gray-100">
                            <p class="text-[10px] font-bold tracking-widest uppercase text-gray-400 mb-3">Talk to a
                                Specialist</p>
                            <a href="tel:+447456490400" class="flex items-center gap-3 group">
                                <div
                                    class="w-10 h-10 rounded-xl bg-brand-teal/5 flex items-center justify-center group-hover:bg-brand-yellow transition-colors duration-200">
                                    <i data-lucide="phone" class="w-4 h-4 text-brand-teal"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">+44 7456 490 400</p>
                                    <p class="text-gray-400 text-xs">Available Mon–Sat, 8am–7pm</p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════ YELLOW CTA BANNER ══════ --}}
    <section class="bg-brand-yellow py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-teal/10 mb-6">
                <i data-lucide="{{ $service['icon'] }}" class="w-8 h-8 text-brand-teal"></i>
            </div>
            {{-- On yellow bg, teal heading is correct brand usage --}}
            <h2 class="text-3xl md:text-4xl font-black text-brand-teal mb-4">
                Ready for the <span class="underline decoration-brand-teal/30 decoration-4">highest standard?</span>
            </h2>
            {{-- Body on yellow: dark charcoal reads better than teal/70 --}}
            <p class="text-gray-700 text-base mb-8 max-w-lg mx-auto leading-relaxed">
                Get in touch today for your free, no-obligation quote on {{ $service['title'] }}.
                Our team responds within 24 hours.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/#contact"
                    class="inline-flex items-center gap-2 bg-brand-teal text-white font-bold px-8 py-4 rounded-xl hover:bg-brand-teal/90 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-base">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Get a Free Quote
                </a>
                <a href="tel:+447456490400"
                    class="inline-flex items-center gap-2 bg-white/60 text-gray-900 font-bold px-8 py-4 rounded-xl hover:bg-white transition-all duration-200 text-base">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                    Call Us Now
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════ OTHER SERVICES STRIP ══════ --}}
    <section class="py-16 px-6 bg-brand-light">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                {{-- Section heading: teal accent on light bg --}}
                <h3 class="text-xl font-black text-brand-teal">Explore Our Other Services</h3>
            </div>
            <div class="flex flex-wrap justify-center gap-3">
                @php
                    $allServices = [
                        ['slug' => 'removals-handyman', 'title' => 'Removals & HandyMan', 'icon' => 'truck'],
                        ['slug' => 'car-valeting', 'title' => 'Car Valeting & Wash', 'icon' => 'car'],
                        ['slug' => 'interior-decor', 'title' => 'Interior Decor & Refurb', 'icon' => 'paint-roller'],
                        ['slug' => 'real-estate', 'title' => 'Real Estate Development', 'icon' => 'building-2'],
                        ['slug' => 'cleaning', 'title' => 'Cleaning Services', 'icon' => 'sparkles'],
                    ];
                @endphp
                @foreach ($allServices as $s)
                    @if ($s['slug'] !== $service['slug'])
                        <a href="/services/{{ $s['slug'] }}"
                            class="inline-flex items-center gap-2 bg-white text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-xl shadow-soft hover:shadow-soft-hover hover:bg-brand-teal hover:text-white transition-all duration-200">
                            <i data-lucide="{{ $s['icon'] }}" class="w-4 h-4"></i>
                            {{ $s['title'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

</x-layout>
