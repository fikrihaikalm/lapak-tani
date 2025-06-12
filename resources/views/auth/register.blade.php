@extends('layouts.app')

@section('title', 'Daftar - Katalog Pertanian')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-hijau-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                Daftar Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Atau
                <a href="{{ route('login') }}" class="font-medium text-hijau-600 hover:text-hijau-500">
                    masuk ke akun yang sudah ada
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST" data-ajax="true">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required 
                           class="form-input mt-1" 
                           placeholder="Masukkan nama lengkap Anda">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required 
                           class="form-input mt-1" 
                           placeholder="Masukkan email Anda">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input id="phone" name="phone" type="text" 
                           class="form-input mt-1" 
                           placeholder="Masukkan nomor telepon Anda">
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="address" name="address" rows="3" 
                              class="form-textarea mt-1" 
                              placeholder="Masukkan alamat lengkap Anda"></textarea>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                           class="form-input mt-1" 
                           placeholder="Masukkan password (minimal 8 karakter)">
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="form-input mt-1" 
                           placeholder="Ulangi password Anda">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full btn-primary">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection