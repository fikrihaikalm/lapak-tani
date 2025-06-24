@extends('layouts.app')

@section('title', 'Edit Profil - Lapak Tani')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-hijau-600 hover:text-hijau-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali ke Profil
        </a>
    </div>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi profil Anda</p>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Dasar</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                           class="form-input @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                           class="form-input @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                           class="form-input @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" id="location" name="location" value="{{ old('location', auth()->user()->location) }}" 
                           class="form-input @error('location') border-red-500 @enderror">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            @if(auth()->user()->isPetani())
                <div class="mt-6">
                    <label for="farm_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Usaha Tani</label>
                    <input type="text" id="farm_name" name="farm_name" value="{{ old('farm_name', auth()->user()->farm_name) }}" 
                           class="form-input @error('farm_name') border-red-500 @enderror">
                    @error('farm_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="mt-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea id="bio" name="bio" rows="4" 
                          class="form-input @error('bio') border-red-500 @enderror">{{ old('bio', auth()->user()->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="3" 
                          class="form-input @error('address') border-red-500 @enderror">{{ old('address', auth()->user()->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Avatar -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Foto Profil</h2>
            
            <div class="flex items-center space-x-6">
                <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-20 h-20 rounded-full">
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*" 
                           class="form-input @error('avatar') border-red-500 @enderror">
                    @error('avatar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Ubah Password</h2>
            <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" 
                           class="form-input @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input">
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('profile.show') }}" class="btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
