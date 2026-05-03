<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Touch2finish | Bespoke Trade Services</title>

    <!-- Geist Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-brand-light text-brand-navy antialiased font-sans flex flex-col min-h-screen">

    <header class="sticky top-0 bg-brand-white border-b border-gray-200 py-4 px-6 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <!-- Header Logo Area -->
            <a href="/" class="flex items-center gap-2 group">
                <!-- Touch Logo -->
                <svg class="w-6 h-6 text-brand-navy group-hover:text-brand-yellow transition-colors" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                </svg>
                <span class="text-xl font-bold tracking-tight">Touch2finish</span>
            </a>
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm">
                <a href="/" class="hover:text-brand-yellow transition-colors">Home</a>
                <a href="#about" class="hover:text-brand-yellow transition-colors">About Us</a>
                <a href="#services" class="hover:text-brand-yellow transition-colors">Services</a>
                <a href="#contact"
                    class="bg-brand-yellow text-brand-navy px-6 py-2.5 rounded-md font-semibold hover:bg-yellow-400 transition-colors shadow-sm">Get
                    a Quote</a>
            </nav>

            <button id="mobile-menu-btn" class="md:hidden focus:outline-none hover:text-brand-yellow transition-colors">
                <i id="menu-icon" data-lucide="menu" class="w-7 h-7"></i>
            </button>
        </div>

        <!-- Mobile Dropdown Nav -->
        <nav id="mobile-menu"
            class="hidden flex-col gap-4 font-medium text-sm pt-4 pb-2 border-t border-gray-200 mt-4 md:hidden">
            <a href="/" class="hover:text-brand-yellow transition-colors">Home</a>
            <a href="#about" class="hover:text-brand-yellow transition-colors">About Us</a>
            <a href="#services" class="hover:text-brand-yellow transition-colors">Services</a>
            <a href="#contact"
                class="bg-brand-yellow text-brand-navy px-6 py-2.5 rounded-md font-semibold hover:bg-yellow-400 transition-colors shadow-sm text-center">Get
                a Quote</a>
        </nav>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-brand-navy text-brand-light py-16 px-6 mt-12">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 mb-12 border-b border-slate-700 pb-12">
            <div>
                <!-- Footer Brand Area -->
                <h3 class="text-2xl font-bold text-brand-white tracking-tight mb-4 flex items-center gap-2">
                    <!-- Touch Logo -->
                    <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                    </svg>
                    Touch2finish
                </h3>
                <p class="text-sm leading-relaxed max-w-sm text-slate-300">
                    We are here to help! From start to finish, to achieve the highest standard. Standard is everything.
                </p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-brand-white mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm text-slate-300">
                    <li><a href="/" class="hover:text-brand-yellow transition-colors">Home</a></li>
                    <li><a href="#services" class="hover:text-brand-yellow transition-colors">Our Services</a></li>
                    <li><a href="#about" class="hover:text-brand-yellow transition-colors">About Us</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-brand-white mb-6">Contact Us</h4>
                <ul class="space-y-4 text-sm text-slate-300">
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-5 h-5 text-brand-yellow"></i>
                        <a href="mailto:info@touch2finish.co.uk"
                            class="hover:text-brand-yellow transition-colors">info@touch2finish.co.uk</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-5 h-5 text-brand-yellow"></i>
                        +44 7456 490400
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="max-w-6xl mx-auto text-center text-xs text-slate-400 flex flex-col md:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} Touch2finish. All rights reserved.</p>
            <div class="space-x-6">
                <a href="#" class="hover:text-brand-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-brand-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    <script>
        lucide.createIcons();

        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');

        btn.addEventListener('click', () => {
            const isOpen = !menu.classList.contains('hidden');
            menu.classList.toggle('hidden', isOpen);
            menu.classList.toggle('flex', !isOpen);

            // Swap icon between menu and X
            icon.setAttribute('data-lucide', isOpen ? 'menu' : 'x');
            lucide.createIcons();
        });

        // Close menu when a nav link is clicked
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                menu.classList.remove('flex');
                icon.setAttribute('data-lucide', 'menu');
                lucide.createIcons();
            });
        });
    </script>
</body>

</html>
