@extends('layouts.register-halaman')

@section('title', 'Masuk - Lapak Tani')

@section('content')
<!-- Back Button -->
<div class="mb-4">
    <a href="{{ route('home') }}" class="inline-flex items-center text-hijau-600 hover:text-hijau-700 transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Beranda
    </a>
</div>

<div class="bg-white rounded-2xl shadow-xl w-full lg:h-full lg:overflow-y-auto">
    <div class="p-6 lg:p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-hijau-600 to-hijau-700 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                Masuk ke Akun Anda
            </h2>
            <p class="text-gray-600">
                Selamat datang kembali di Lapak Tani
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-hijau-600 hover:text-hijau-500 transition duration-200">
                    Daftar di sini
                </a>
            </p>
        </div>

        <!-- Form -->
        <form class="space-y-6" action="{{ route('login') }}" method="POST" data-ajax="true">
            @csrf

            <!-- Grid Layout untuk Form -->
            <div class="space-y-6">
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
                           placeholder="Masukkan password Anda">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit" class="w-full bg-gradient-to-r from-hijau-600 to-hijau-700 text-white py-4 px-6 rounded-lg font-medium text-lg hover:from-hijau-700 hover:to-hijau-800 focus:outline-none focus:ring-2 focus:ring-hijau-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Masuk Sekarang
                    </span>
                </button>
            </div>

            <!-- Footer -->
            <div class="text-center pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    Lupa password?
                    <a href="#" class="text-hijau-600 hover:text-hijau-500">Reset di sini</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection