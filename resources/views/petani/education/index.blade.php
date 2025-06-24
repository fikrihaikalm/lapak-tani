@extends('layouts.dashboard')

@section('title', 'Edukasi Saya - Petani')
@section('page-title', 'Konten Edukasi Saya')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Konten Edukasi Saya</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola konten edukasi yang Anda buat</p>
        </div>
        <a href="{{ route('petani.education.create') }}" class="btn-primary">
            Buat Konten
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($educations as $education)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ $education->image_path ? asset('storage/' . $education->image_path) : 'https://via.placeholder.com/40' }}"
                                 alt="{{ $education->title }}" 
                                 class="w-10 h-10 rounded-lg object-cover">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $education->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($education->content, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $education->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('education.show', $education->id) }}" 
                           class="text-hijau-600 hover:text-hijau-900" target="_blank">
                            Lihat
                        </a>
                        <a href="{{ route('petani.education.edit', $education->id) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>
                        <button data-delete="{{ route('petani.education.destroy', $education->id) }}" 
                                class="text-red-600 hover:text-red-900">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center">
                        <i class="bi bi-book text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">Belum Ada Konten</h3>
                        <p class="text-sm text-gray-500 mb-4">Mulai dengan membuat konten edukasi pertama Anda.</p>
                        <a href="{{ route('petani.education.create') }}" class="btn-primary">
                            Buat Konten Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($educations->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $educations->links() }}
    </div>
    @endif
</div>
@endsection