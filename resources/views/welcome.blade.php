<x-layout>
    <!-- Hero Section -->
    <section class="px-6 py-20 max-w-5xl mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-brand-navy mb-6 tracking-tight leading-tight">
            We are here to help!<br>
            <span class="text-brand-navy/80 block mt-3 text-2xl md:text-4xl font-medium">From start to finish.</span>
        </h1>
        <p class="text-brand-navy/70 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto mb-10">
            Delivering bespoke trade services to clients at all levels with a touch of excellence at affordable prices.
        </p>
        <a href="#services"
            class="inline-flex items-center gap-2 bg-brand-navy text-brand-white px-8 py-3.5 rounded-md font-semibold hover:bg-slate-800 transition-all shadow-soft hover:shadow-soft-hover">
            Explore Our Services
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </section>

    <!-- About Us Section -->
    <section id="about" class="bg-brand-white py-20 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-brand-yellow font-bold tracking-wider uppercase text-sm mb-2 block">Who We Are</span>
                <h2 class="text-3xl md:text-4xl font-bold text-brand-navy mb-6">Standard is everything.</h2>
                <p class="text-brand-navy/70 leading-relaxed mb-6">
                    Whether you are looking for property refurbishment, professional cleaning, or real estate
                    development, we approach every project with the same core philosophy: achieving the highest possible
                    standard.
                </p>
                <p class="text-brand-navy/70 leading-relaxed">
                    No matter what your needs may be, all are welcome. We pair industry expertise with affordable
                    pricing to ensure your project is completed flawlessly.
                </p>
            </div>
            <div class="rounded-xl overflow-hidden shadow-soft">
                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80"
                    alt="Professional Services" class="w-full h-[400px] object-cover">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="px-6 py-20 max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-brand-navy mb-4">Our Services</h2>
            <div class="w-16 h-1 bg-brand-yellow mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1: Removals -->
            <div
                class="group relative bg-brand-white rounded-xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 min-h-[220px] flex items-center justify-center border border-gray-100">
                <!-- Background Image (Visible on Hover) -->
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                </div>
                <div
                    class="absolute inset-0 bg-brand-navy/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                </div>

                <!-- Content -->
                <div class="relative z-20 text-center p-6 w-full">
                    <i data-lucide="truck"
                        class="w-8 h-8 text-brand-yellow mx-auto mb-4 group-hover:text-brand-white transition-colors duration-300"></i>
                    <h3
                        class="text-xl font-semibold text-brand-navy group-hover:text-brand-white transition-colors duration-300 mb-2">
                        Removals & HandyMan</h3>
                    <p
                        class="text-sm text-brand-light/90 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        Local or long distance. Small, big, or fragile items. Low price assured.
                    </p>
                </div>
            </div>

            <!-- Card 2: Car Valeting -->
            <div
                class="group relative bg-brand-white rounded-xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 min-h-[220px] flex items-center justify-center border border-gray-100">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                </div>
                <div
                    class="absolute inset-0 bg-brand-navy/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                </div>

                <div class="relative z-20 text-center p-6 w-full">
                    <i data-lucide="car"
                        class="w-8 h-8 text-brand-yellow mx-auto mb-4 group-hover:text-brand-white transition-colors duration-300"></i>
                    <h3
                        class="text-xl font-semibold text-brand-navy group-hover:text-brand-white transition-colors duration-300">
                        Car Valeting / Wash</h3>
                </div>
            </div>

            <!-- Card 3: Interior Decor -->
            <div
                class="group relative bg-brand-white rounded-xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 min-h-[220px] flex items-center justify-center border border-gray-100">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1505691938895-1758d7def511?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                </div>
                <div
                    class="absolute inset-0 bg-brand-navy/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                </div>

                <div class="relative z-20 text-center p-6 w-full">
                    <i data-lucide="paint-roller"
                        class="w-8 h-8 text-brand-yellow mx-auto mb-4 group-hover:text-brand-white transition-colors duration-300"></i>
                    <h3
                        class="text-xl font-semibold text-brand-navy group-hover:text-brand-white transition-colors duration-300">
                        Interior Decor / Refurb</h3>
                </div>
            </div>

            <!-- Card 4: Real Estate -->
            <div
                class="group relative bg-brand-white rounded-xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 min-h-[220px] flex items-center justify-center border border-gray-100">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                </div>
                <div
                    class="absolute inset-0 bg-brand-navy/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                </div>

                <div class="relative z-20 text-center p-6 w-full">
                    <i data-lucide="building"
                        class="w-8 h-8 text-brand-yellow mx-auto mb-4 group-hover:text-brand-white transition-colors duration-300"></i>
                    <h3
                        class="text-xl font-semibold text-brand-navy group-hover:text-brand-white transition-colors duration-300">
                        Real Estate Development</h3>
                </div>
            </div>

            <!-- Card 5: Cleaning -->
            <div
                class="group relative bg-brand-white rounded-xl overflow-hidden shadow-soft hover:shadow-soft-hover transition-all duration-300 min-h-[220px] flex items-center justify-center border border-gray-100 md:col-span-2 lg:col-span-1">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                </div>
                <div
                    class="absolute inset-0 bg-brand-navy/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                </div>

                <div class="relative z-20 text-center p-6 w-full">
                    <i data-lucide="sparkles"
                        class="w-8 h-8 text-brand-yellow mx-auto mb-4 group-hover:text-brand-white transition-colors duration-300"></i>
                    <h3
                        class="text-xl font-semibold text-brand-navy group-hover:text-brand-white transition-colors duration-300">
                        Private / Commercial Cleaning</h3>
                </div>
            </div>

        </div>
    </section>

    <!-- Get a Quote / Contact Section -->
    <section id="contact" class="bg-brand-white py-20 px-6 border-t border-gray-100 relative">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-brand-navy mb-4">Get a Quote</h2>
                <p class="text-brand-navy/70">Let us know what you need help with, and our team will get back to you
                    with a tailored solution.</p>
            </div>

            <!-- Display Validation Errors if any -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('quote.submit') }}" method="POST"
                class="space-y-6 bg-brand-light p-8 md:p-10 rounded-xl shadow-soft">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-brand-navy mb-2">Full Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-yellow focus:ring focus:ring-brand-yellow/50 transition-colors"
                            placeholder="John Doe">
                    </div>
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-brand-navy mb-2">Email Address <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-yellow focus:ring focus:ring-brand-yellow/50 transition-colors"
                            placeholder="john@example.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone Input (NEW) -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-brand-navy mb-2">Phone Number <span
                                class="text-red-500">*</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-yellow focus:ring focus:ring-brand-yellow/50 transition-colors"
                            placeholder="+44 7700 900077">
                    </div>

                    <!-- Service Selection -->
                    <div>
                        <label for="service" class="block text-sm font-medium text-brand-navy mb-2">Service Required
                            <span class="text-red-500">*</span></label>
                        <select id="service" name="service" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-yellow focus:ring focus:ring-brand-yellow/50 transition-colors">
                            <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select a service...
                            </option>
                            <option value="Removals & HandyMan"
                                {{ old('service') == 'Removals & HandyMan' ? 'selected' : '' }}>Removals & HandyMan
                            </option>
                            <option value="Car Valeting / Wash"
                                {{ old('service') == 'Car Valeting / Wash' ? 'selected' : '' }}>Car Valeting / Wash
                            </option>
                            <option value="Interior Decor / Refurb"
                                {{ old('service') == 'Interior Decor / Refurb' ? 'selected' : '' }}>Interior Decor /
                                Refurb</option>
                            <option value="Real Estate Development"
                                {{ old('service') == 'Real Estate Development' ? 'selected' : '' }}>Real Estate
                                Development</option>
                            <option value="Private / Commercial Cleaning"
                                {{ old('service') == 'Private / Commercial Cleaning' ? 'selected' : '' }}>Private /
                                Commercial Cleaning</option>
                        </select>
                    </div>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm font-medium text-brand-navy mb-2">Project Details <span
                            class="text-red-500">*</span></label>
                    <textarea id="message" name="message" rows="4" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-yellow focus:ring focus:ring-brand-yellow/50 transition-colors"
                        placeholder="Tell us a bit about your project...">{{ old('message') }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-brand-navy text-brand-white font-semibold py-3.5 rounded-md hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-navy transition-all shadow-md flex justify-center items-center gap-2">
                    Send Request
                    <i data-lucide="send" class="w-4 h-4 text-brand-yellow"></i>
                </button>
            </form>
        </div>

        <!-- Success Pop-up (Alpine.js Toast) -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10"
                class="fixed bottom-6 right-6 bg-brand-navy border border-brand-yellow text-brand-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 z-50 max-w-sm">

                <i data-lucide="check-circle-2" class="text-brand-yellow w-8 h-8 flex-shrink-0"></i>
                <div class="flex-grow">
                    <h4 class="font-bold text-brand-yellow">Success!</h4>
                    <p class="text-sm text-brand-light mt-1">{{ session('success') }}</p>
                </div>
                <button @click="show = false"
                    class="text-slate-400 hover:text-white self-start mt-1 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        @endif
    </section>

</x-layout>
