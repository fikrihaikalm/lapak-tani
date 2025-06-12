@extends('layouts.dashboard')

@section('title', 'Kelola Edukasi - Admin')
@section('page-title', 'Kelola Edukasi')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Konten Edukasi</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola konten edukasi pertanian</p>
        </div>
        <a href="{{ route('admin.education.create') }}" class="btn-primary">
            Tambah Konten
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($educations as $education)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ $education->image_url ?: 'https://images.pexels.com/photos/2132227/pexels-photo-2132227.jpeg' }}" 
                                 alt="{{ $education->title }}" 
                                 class="w-10 h-10 rounded-lg object-cover">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $education->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($education->content, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $education->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ ucfirst($education->user->role) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $education->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('education.show', $education->id) }}" 
                           class="text-hijau-600 hover:text-hijau-900" target="_blank">
                            Lihat
                        </a>
                        @if($education->user_id === auth()->id())
                        <a href="{{ route('admin.education.edit', $education->id) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>
                        @endif
                        <button data-delete="{{ route('admin.education.destroy', $education->id) }}" 
                                class="text-red-600 hover:text-red-900">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">Belum Ada Konten</h3>
                        <p class="text-sm text-gray-500">Mulai dengan menambahkan konten edukasi pertama.</p>
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