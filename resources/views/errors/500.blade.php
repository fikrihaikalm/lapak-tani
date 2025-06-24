<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | Lapak Tani</title>
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
<body class="bg-gradient-to-br from-red-50 to-orange-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <!-- Animated Illustration -->
        <div class="mb-8">
            <div class="relative">
                <!-- Wilted Plant -->
                <div class="inline-block animate-pulse">
                    <i class="bi bi-exclamation-triangle text-8xl text-red-500"></i>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-4 -left-4 animate-bounce">
                    <span class="text-2xl">🥀</span>
                </div>
                <div class="absolute -top-2 -right-6 animate-bounce delay-300">
                    <span class="text-xl">⚠️</span>
                </div>
                <div class="absolute -bottom-2 -left-6 animate-bounce delay-500">
                    <span class="text-lg">🔧</span>
                </div>
            </div>
        </div>

        <!-- Error Content -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-red-100">
            <h1 class="text-6xl font-bold text-red-500 mb-4">500</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ups! Ada Masalah di Kebun</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Sepertinya ada gangguan di sistem kami. Tim teknisi sedang bekerja keras 
                untuk memperbaiki masalah ini. Mohon coba lagi dalam beberapa saat.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.location.reload()" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Coba Lagi
                </button>
                
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-red-500 font-semibold rounded-lg border-2 border-red-500 hover:bg-red-50 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Contact Info -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-4">Jika masalah berlanjut, hubungi tim support:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="mailto:support@lapaktani.com" class="text-red-500 hover:text-red-600 hover:underline">📧 support@lapaktani.com</a>
                    <a href="tel:+6281234567890" class="text-red-500 hover:text-red-600 hover:underline">📱 +62 812-3456-7890</a>
                </div>
            </div>
        </div>

        <!-- Status Message -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 italic">
                🔧 Tim kami sedang bekerja 24/7 untuk memberikan layanan terbaik
            </p>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-red-300 rounded-full animate-ping opacity-20"></div>
        <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-orange-400 rounded-full animate-ping opacity-20 delay-1000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-1 h-1 bg-red-500 rounded-full animate-ping opacity-20 delay-2000"></div>
    </div>
</body>
</html>
