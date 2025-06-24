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
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-hijau-700 rounded-full flex items-center justify-center hover:bg-hijau-600 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
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
                        @auth
                            <li><a href="{{ route('social.feed') }}" class="text-hijau-200 hover:text-white transition duration-200">Feed</a></li>
                        @endauth
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
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <a href="mailto:info@lapaktani.com" class="hover:text-white transition duration-200">info@lapaktani.com</a>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <a href="tel:+6281234567890" class="hover:text-white transition duration-200">+62 812-3456-7890</a>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Jember, Jawa Timur</span>
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
    <script src="{{ asset('js/social.js') }}"></script>
    <script src="{{ asset('js/posts.js') }}"></script>
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