<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-hijau-600">Lapak Tani</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('products') }}"
                   class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">
                    Produk
                </a>

                <a href="{{ route('education') }}"
                   class="nav-link {{ request()->routeIs('education*') ? 'active' : '' }}">
                    Edukasi
                </a>

                <a href="{{ route('petani.directory') }}"
                   class="nav-link {{ request()->routeIs('petani.directory') ? 'active' : '' }}">
                    Petani
                </a>

                @auth
                    <a href="{{ route('social.feed') }}"
                       class="nav-link {{ request()->routeIs('social.*') ? 'active' : '' }}">
                        Feed
                    </a>
                @endauth

                <!-- Dropdown Menu -->
                <div class="relative group">
                    <button class="nav-link flex items-center">
                        Lainnya
                        <svg class="w-3 h-3 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                Tentang Kami
                            </a>
                            <a href="{{ route('how-it-works') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                Cara Kerja
                            </a>
                            <a href="{{ route('testimonials') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                Testimoni
                            </a>
                            <a href="{{ route('blog') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                Blog
                            </a>
                            <a href="{{ route('faq') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                FAQ
                            </a>
                            <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                Kontak
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Search -->
            <div class="flex items-center">
                <!-- Search Icon -->
                <button id="search-toggle" class="p-2 text-gray-700 hover:text-hijau-600 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <!-- Expandable Search Box -->
                <div id="search-box" class="hidden absolute top-full left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="relative">
                            <input type="text" id="global-search"
                                   placeholder="Cari produk, artikel, petani..."
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>

                            <!-- Search Results -->
                            <div id="search-results" class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden z-50 max-h-96 overflow-y-auto">
                                <div id="search-loading" class="p-4 text-center text-gray-500 hidden">
                                    <svg class="animate-spin h-5 w-5 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                                    </svg>
                                    Mencari...
                                </div>
                                <div id="search-content">
                                    <!-- Search results will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Auth Links -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-hijau-600 font-medium">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-hijau-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-hijau-700 transition duration-200">
                        Daftar
                    </a>
                @else
                    <!-- Konsumen Icons -->
                    @if(auth()->user()->isKonsumen())
                        <div class="flex items-center space-x-2">
                            <!-- Wishlist -->
                            <a href="{{ route('konsumen.wishlist.index') }}"
                               class="relative text-gray-700 hover:text-hijau-600 transition duration-200"
                               title="Wishlist">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                @if(auth()->user()->wishlistItems()->count() > 0)
                                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ auth()->user()->wishlistItems()->count() }}
                                    </span>
                                @endif
                            </a>

                            <!-- Cart -->
                            <a href="{{ route('konsumen.cart.index') }}"
                               class="relative text-gray-700 hover:text-hijau-600 transition duration-200"
                               title="Keranjang">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
                                </svg>
                                @if(auth()->user()->cartItems()->count() > 0)
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ auth()->user()->cartItems()->count() }}
                                    </span>
                                @endif
                            </a>

                            <!-- Orders -->
                            <a href="{{ route('konsumen.orders.index') }}"
                               class="relative text-gray-700 hover:text-hijau-600 transition duration-200"
                               title="Pesanan">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                @php
                                    $pendingOrders = auth()->user()->orders()->where('status', 'pending')->count();
                                @endphp
                                @if($pendingOrders > 0)
                                    <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $pendingOrders }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    @endif

                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-hijau-600 transition duration-200">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-2">
                                <a href="{{ route('social.profile', auth()->id()) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                    Profil Saya
                                </a>
                                @if(auth()->user()->isPetani())
                                    <a href="{{ route('petani.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                        Dashboard Petani
                                    </a>
                                @endif
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-gray-700 hover:text-hijau-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-2">
            <!-- Mobile Navigation Links -->
            <a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a>
            <a href="{{ route('products') }}" class="mobile-nav-link">Produk</a>
            <a href="{{ route('education') }}" class="mobile-nav-link">Edukasi</a>
            <a href="{{ route('petani.directory') }}" class="mobile-nav-link">Direktori Petani</a>
            <a href="{{ route('about') }}" class="mobile-nav-link">Tentang Kami</a>
            <a href="{{ route('how-it-works') }}" class="mobile-nav-link">Cara Kerja</a>
            <a href="{{ route('contact') }}" class="mobile-nav-link">Kontak</a>

            @auth
                <a href="{{ route('social.feed') }}" class="mobile-nav-link">Feed</a>
                @if(auth()->user()->isKonsumen())
                    <a href="{{ route('konsumen.wishlist.index') }}" class="mobile-nav-link">Wishlist</a>
                    <a href="{{ route('konsumen.cart.index') }}" class="mobile-nav-link">Keranjang</a>
                    <a href="{{ route('konsumen.orders.index') }}" class="mobile-nav-link">Pesanan</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<style>
.nav-link {
    @apply px-3 py-2 text-sm font-medium text-gray-700 hover:text-hijau-600 transition duration-200;
}

.nav-link.active {
    @apply text-hijau-600;
}

.mobile-nav-link {
    @apply block px-4 py-3 text-sm font-medium text-gray-700 hover:text-hijau-600 hover:bg-hijau-50 rounded-lg transition-colors duration-200;
}
</style>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Search toggle
    const searchToggle = document.getElementById('search-toggle');
    const searchBox = document.getElementById('search-box');
    const searchInput = document.getElementById('global-search');

    if (searchToggle && searchBox) {
        searchToggle.addEventListener('click', function() {
            searchBox.classList.toggle('hidden');
            if (!searchBox.classList.contains('hidden')) {
                searchInput.focus();
            }
        });

        // Close search when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchToggle.contains(e.target) && !searchBox.contains(e.target)) {
                searchBox.classList.add('hidden');
            }
        });

        // Close search on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchBox.classList.add('hidden');
            }
        });
    }
});
</script>
