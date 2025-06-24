<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Katalog Pertanian Lokal')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    @include('partials.navbar')



    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Notifications -->
    @include('partials.notifications')

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-hijau-800 to-hijau-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">Lapak Tani</h2>
                        <p class="text-hijau-200 text-sm">Platform Pertanian Digital</p>
                    </div>
                    <p class="text-hijau-100 mb-6 leading-relaxed">
                        Platform yang menghubungkan petani lokal dengan konsumen, sekaligus menyediakan edukasi pertanian untuk menciptakan ekosistem pertanian yang berkelanjutan.
                    </p>

                    <!-- Social Media -->
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <i class="bi bi-instagram text-lg"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <i class="bi bi-facebook text-lg"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <i class="bi bi-youtube text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-hijau-200 hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('products') }}" class="text-hijau-200 hover:text-white transition duration-200">Produk</a></li>
                        <li><a href="{{ route('education') }}" class="text-hijau-200 hover:text-white transition duration-200">Edukasi</a></li>
                        <li><a href="{{ route('petani.directory') }}" class="text-hijau-200 hover:text-white transition duration-200">Direktori Petani</a></li>
                    </ul>
                </div>

                <!-- Company & Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Informasi</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-hijau-200 hover:text-white transition duration-200">Tentang Kami</a></li>
                        <li><a href="{{ route('how-it-works') }}" class="text-hijau-200 hover:text-white transition duration-200">Cara Kerja</a></li>
                        <li><a href="{{ route('testimonials') }}" class="text-hijau-200 hover:text-white transition duration-200">Testimoni</a></li>
                        <li><a href="{{ route('faq') }}" class="text-hijau-200 hover:text-white transition duration-200">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-hijau-200 hover:text-white transition duration-200">Kontak</a></li>
                    </ul>

                    <div class="mt-6">
                        <h4 class="text-sm font-semibold mb-2 text-white">Hubungi Kami</h4>
                        <div class="space-y-2 text-sm text-hijau-200">
                            <div class="flex items-center">
                                <i class="bi bi-envelope-fill w-4 h-4 mr-2"></i>
                                <a href="mailto:info@lapaktani.com" class="hover:text-white transition duration-200">info@lapaktani.com</a>
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-telephone-fill w-4 h-4 mr-2"></i>
                                <a href="tel:+6282229740385" class="hover:text-white transition duration-200">+62 822-2974-0385</a>
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-geo-alt-fill w-4 h-4 mr-2"></i>
                                <span>Kampus Tegalboto, Jember</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-hijau-700 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-hijau-200 text-sm mb-4 md:mb-0">
                        <p>&copy; {{ date('Y') }} Lapak Tani. Semua hak cipta dilindungi.</p>
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="{{ route('privacy') }}" class="text-hijau-200 hover:text-white transition duration-200">Kebijakan Privasi</a>
                        <a href="{{ route('terms') }}" class="text-hijau-200 hover:text-white transition duration-200">Syarat & Ketentuan</a>
                        <a href="{{ route('help') }}" class="text-hijau-200 hover:text-white transition duration-200">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Core JavaScript Components -->
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    @auth
        @if(auth()->user()->user_type === 'konsumen')
            <script src="{{ asset('js/cart.js') }}"></script>
            <script src="{{ asset('js/wishlist.js') }}"></script>
        @endif
    @endauth

    <!-- Global Variables -->
    <script>
        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        @auth
            window.userType = '{{ auth()->user()->user_type }}';
        @endauth
    </script>


</body>
</html>