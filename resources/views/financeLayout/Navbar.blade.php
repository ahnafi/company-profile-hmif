<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo/Title -->
            <div class="flex-shrink-0">
                <h1 class="text-xl font-bold text-gray-800">Keuangan HMIF</h1>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('cash.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cash.index') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                        Kas
                    </a>
                    <a href="{{ route('cash.history') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cash.history') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                        Riwayat Kas
                    </a>
                    <a href="{{ route('deposit.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('deposit.index') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                        Deposit
                    </a>
                    <a href="{{ route('deposit.history') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('deposit.history') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                        Riwayat Deposit
                    </a>

                    @auth
                        <!-- User Authenticated - Show dashboard link based on role -->
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('filament.adminhmif.pages.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Admin
                            </a>
                        @elseif(auth()->user()->hasRole('bendahara'))
                            <a href="{{ route('filament.finance.pages.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Bendahara
                            </a>
                        @elseif(auth()->user()->hasRole('iltek'))
                            <a href="{{ route('filament.iltekFinance.pages.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Iltek
                            </a>
                        @elseif(auth()->user()->hasRole('kreus'))
                            <a href="{{ route('filament.kreusFinance.pages.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Kreus
                            </a>
                        @elseif(auth()->user()->hasRole('mikat'))
                            <a href="{{ route('filament.mikatFinance.pages.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Mikat
                            </a>
                        @endif
                    @else
                        <!-- User Not Authenticated - Show login dropdown -->
                        <div class="relative group">
                            <button
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200 flex items-center">
                                Admin
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('filament.adminhmif.auth.login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600">Admin
                                    HMIF</a>
                                <a href="{{ route('filament.finance.auth.login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600">Bendahara</a>
                                <a href="{{ route('filament.iltekFinance.auth.login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600">Kas
                                    Iltek</a>
                                <a href="{{ route('filament.kreusFinance.auth.login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600">Kas
                                    Kreus</a>
                                <a href="{{ route('filament.mikatFinance.auth.login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600">Kas
                                    Mikat</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500 transition duration-200">
                    <span class="sr-only">Open main menu</span>
                    <svg id="menu-icon" class="block h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="hidden h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50">
            <a href="{{ route('cash.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cash.index') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                Kas
            </a>
            <a href="{{ route('cash.history') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cash.history') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                Riwayat Kas
            </a>
            <a href="{{ route('deposit.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('deposit.index') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                Deposit
            </a>
            <a href="{{ route('deposit.history') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('deposit.history') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-red-100 hover:text-red-600' }} transition duration-200">
                Riwayat Deposit
            </a>

            @auth
                <!-- User Authenticated - Show dashboard link based on role -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-3 py-2 text-sm font-semibold text-gray-500 uppercase tracking-wide">Dashboard</div>

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('filament.adminhmif.pages.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Admin
                            </div>
                        </a>
                    @elseif(auth()->user()->hasRole('bendahara'))
                        <a href="{{ route('filament.finance.pages.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Bendahara
                            </div>
                        </a>
                    @elseif(auth()->user()->hasRole('iltek'))
                        <a href="{{ route('filament.iltekFinance.pages.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Iltek
                            </div>
                        </a>
                    @elseif(auth()->user()->hasRole('kreus'))
                        <a href="{{ route('filament.kreusFinance.pages.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Kreus
                            </div>
                        </a>
                    @elseif(auth()->user()->hasRole('mikat'))
                        <a href="{{ route('filament.mikatFinance.pages.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard Mikat
                            </div>
                        </a>
                    @endif
                </div>
            @else
                <!-- User Not Authenticated - Show login links -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-3 py-2 text-sm font-semibold text-gray-500 uppercase tracking-wide">Admin Login</div>
                    <a href="{{ route('filament.adminhmif.auth.login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">Admin
                        HMIF</a>
                    <a href="{{ route('filament.finance.auth.login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">Bendahara</a>
                    <a href="{{ route('filament.iltekFinance.auth.login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">Kas
                        Iltek</a>
                    <a href="{{ route('filament.kreusFinance.auth.login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">Kas
                        Kreus</a>
                    <a href="{{ route('filament.mikatFinance.auth.login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-100 hover:text-red-600 transition duration-200">Kas
                        Mikat</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    mobileMenuButton.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>