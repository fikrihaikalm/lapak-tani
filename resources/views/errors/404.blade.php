<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Lapak Tani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hijau': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-hijau-50 to-green-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <!-- Animated Illustration -->
        <div class="mb-8">
            <div class="relative">
                <!-- Main Plant -->
                <div class="inline-block animate-bounce">
                    <i class="bi bi-exclamation-triangle text-8xl text-hijau-600"></i>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-4 -left-4 animate-pulse">
                    <span class="text-2xl">🌱</span>
                </div>
                <div class="absolute -top-2 -right-6 animate-pulse delay-300">
                    <span class="text-xl">🍃</span>
                </div>
                <div class="absolute -bottom-2 -left-6 animate-pulse delay-500">
                    <span class="text-lg">🌿</span>
                </div>
            </div>
        </div>

        <!-- Error Content -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-hijau-100">
            <h1 class="text-6xl font-bold text-hijau-600 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Oops! Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Sepertinya halaman yang Anda cari telah "dipanen" atau mungkin belum ditanam. 
                Mari kembali ke kebun utama dan temukan produk segar lainnya!
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-hijau-600 to-hijau-700 text-white font-semibold rounded-lg hover:from-hijau-700 hover:to-hijau-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="bi bi-house mr-2"></i>
                    Kembali ke Beranda
                </a>
                
                <a href="{{ route('products') }}"
                   class="inline-flex items-center px-6 py-3 bg-white text-hijau-600 font-semibold rounded-lg border-2 border-hijau-600 hover:bg-hijau-50 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="bi bi-bag mr-2"></i>
                    Lihat Produk
                </a>
            </div>

            <!-- Additional Links -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-4">Atau coba halaman lainnya:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('education') }}" class="text-hijau-600 hover:text-hijau-700 hover:underline">📚 Edukasi</a>
                    <a href="{{ route('petani.directory') }}" class="text-hijau-600 hover:text-hijau-700 hover:underline">👨‍🌾 Direktori Petani</a>
                    @auth
                        <a href="{{ route('profile.show') }}" class="text-hijau-600 hover:text-hijau-700 hover:underline">👤 Profil</a>
                    @endauth
                    <a href="{{ route('about') }}" class="text-hijau-600 hover:text-hijau-700 hover:underline">ℹ️ Tentang Kami</a>
                </div>
            </div>
        </div>

        <!-- Fun Fact -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 italic">
                💡 Tahukah Anda? Tanaman tomat sebenarnya adalah buah, bukan sayuran!
            </p>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-hijau-300 rounded-full animate-ping opacity-20"></div>
        <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-green-400 rounded-full animate-ping opacity-20 delay-1000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-1 h-1 bg-hijau-500 rounded-full animate-ping opacity-20 delay-2000"></div>
    </div>
</body>
</html>
