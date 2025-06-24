@extends('layouts.register-halaman')

@section('title', 'Daftar - Lapak Tani')

@section('content')
<div class="bg-white rounded-2xl shadow-xl w-full lg:h-full lg:overflow-y-auto">
    <div class="p-6 lg:p-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-gradient-to-r from-hijau-600 to-hijau-700 rounded-full flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                </svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">
            Daftar Akun Baru
        </h2>
        <p class="text-gray-600">
            Bergabunglah dengan komunitas petani dan konsumen
        </p>
        <p class="text-sm text-gray-500 mt-2">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-hijau-600 hover:text-hijau-500 transition duration-200">
                Masuk di sini
            </a>
        </p>
    </div>

    <!-- Form -->
    <form class="space-y-6" action="{{ route('register') }}" method="POST" data-ajax="true">
        @csrf

        <!-- Grid Layout untuk Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Nama Lengkap -->
            <div class="lg:col-span-3">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Nama Lengkap
                    </span>
                </label>
                <input id="name" name="name" type="text" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="Masukkan nama lengkap Anda">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Email
                    </span>
                </label>
                <input id="email" name="email" type="email" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="email@contoh.com">
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        Nomor Telepon
                    </span>
                </label>
                <input id="phone" name="phone" type="text"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="081234567890">
            </div>

            <!-- Daftar Sebagai -->
            <div class="lg:col-span-3">
                <label for="user_type" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6h2v6H9z" clip-rule="evenodd"/>
                        </svg>
                        Daftar Sebagai
                    </span>
                </label>
                <select id="user_type" name="user_type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200">
                    <option value="">Pilih jenis akun</option>
                    <option value="konsumen">🛒 Konsumen (Pembeli)</option>
                    <option value="petani">🌱 Petani (Penjual)</option>
                </select>
                <p class="text-sm text-gray-500 mt-2">Pilih "Konsumen" untuk membeli produk atau "Petani" untuk menjual produk pertanian.</p>
            </div>

            <!-- Nama Kebun (Hidden by default) -->
            <div id="farm_name_field" class="hidden lg:col-span-3">
                <label for="farm_name" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Nama Kebun/Usaha Tani
                    </span>
                </label>
                <input id="farm_name" name="farm_name" type="text"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="Contoh: Kebun Segar Pak Tani">
                <p class="text-sm text-gray-500 mt-2">Opsional. Nama kebun atau usaha tani Anda.</p>
            </div>

            <!-- Alamat -->
            <div class="lg:col-span-3">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Alamat
                    </span>
                </label>
                <textarea id="address" name="address" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                          placeholder="Masukkan alamat lengkap Anda"></textarea>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        Password
                    </span>
                </label>
                <input id="password" name="password" type="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="Minimal 8 karakter">
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Konfirmasi Password
                    </span>
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 transition duration-200"
                       placeholder="Ulangi password Anda">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit" class="w-full bg-gradient-to-r from-hijau-600 to-hijau-700 text-white py-4 px-6 rounded-lg font-medium text-lg hover:from-hijau-700 hover:to-hijau-800 focus:outline-none focus:ring-2 focus:ring-hijau-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Daftar Sekarang
                </span>
            </button>
        </div>

        <!-- Footer -->
        <div class="text-center pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-500">
                Dengan mendaftar, Anda menyetujui
                <a href="#" class="text-hijau-600 hover:text-hijau-500">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-hijau-600 hover:text-hijau-500">Kebijakan Privasi</a> kami.
            </p>
        </div>
    </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userTypeSelect = document.getElementById('user_type');
    const farmNameField = document.getElementById('farm_name_field');
    const farmNameInput = document.getElementById('farm_name');

    userTypeSelect.addEventListener('change', function() {
        if (this.value === 'petani') {
            farmNameField.classList.remove('hidden');
            farmNameField.style.display = 'block';
        } else {
            farmNameField.classList.add('hidden');
            farmNameField.style.display = 'none';
            farmNameInput.value = '';
        }
    });

    // Form validation
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mendaftar...
            </span>
        `;
    });
});
</script>
@endsection