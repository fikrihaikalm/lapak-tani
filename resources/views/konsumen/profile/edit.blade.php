@extends('layouts.app')

@section('title', 'Edit Profile - Lapak Tani')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-hijau-600 hover:text-hijau-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Profile
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
            <p class="text-gray-600 mt-1">Update informasi profile Anda</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar Section -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Foto Profile</label>
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <img id="avatar-preview" src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-4 border-gray-200">
                        <button type="button" onclick="triggerAvatarUpload()" class="absolute bottom-0 right-0 bg-hijau-600 text-white rounded-full p-2 hover:bg-hijau-700 transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                        <button type="button" onclick="triggerAvatarUpload()" class="btn-secondary">
                            Ganti Foto
                        </button>
                        <p class="text-sm text-gray-500 mt-1">JPG, PNG atau GIF (max. 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="form-input">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                           class="form-input">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                           class="form-input" placeholder="081234567890">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" id="location" name="location" value="{{ old('location', auth()->user()->location) }}"
                           class="form-input" placeholder="Kota, Provinsi">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(auth()->user()->isPetani())
                    <div>
                        <label for="farm_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kebun/Farm</label>
                        <input type="text" id="farm_name" name="farm_name" value="{{ old('farm_name', auth()->user()->farm_name) }}"
                               class="form-input" placeholder="Kebun Segar Pak Tani">
                        @error('farm_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                <textarea id="address" name="address" rows="3" class="form-textarea" 
                          placeholder="Masukkan alamat lengkap Anda">{{ old('address', auth()->user()->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea id="bio" name="bio" rows="4" class="form-textarea" 
                          placeholder="Ceritakan tentang diri Anda atau kebun Anda...">{{ old('bio', auth()->user()->bio) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Change Section -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Password</h3>
                <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="form-input">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <input type="password" id="password" name="password" class="form-input">
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
</div>

<script src="{{ asset('js/profile-form.js') }}"></script>
@endsection
