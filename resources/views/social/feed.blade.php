@extends('layouts.app')

@section('title', 'Feed - Lapak Tani')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        


        <!-- Create Post Section -->
        @if(auth()->user()->isPetani())
            <div class="bg-white rounded-lg shadow mb-6 p-6">
                <form action="{{ route('social.posts.create') }}" method="POST" enctype="multipart/form-data" data-ajax="true">
                    @csrf
                    <div class="flex items-start space-x-4">
                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <textarea name="content" rows="3" class="form-textarea" 
                                      placeholder="Bagikan update tentang kebun atau hasil panen Anda..."></textarea>
                            
                            <div class="mt-4">
                                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar</label>
                                <input type="file" name="images[]" id="images" multiple accept="image/*" class="form-input" onchange="previewPostImages(this)">
                                <p class="text-sm text-gray-500 mt-1">Maksimal 5 gambar</p>

                                <!-- Image Preview -->
                                <div id="post-image-preview" class="mt-4 hidden">
                                    <div class="grid grid-cols-2 md:grid-cols-5 gap-2" id="preview-container">
                                        <!-- Preview images will be inserted here -->
                                    </div>
                                    <button type="button" onclick="removePostPreviews()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                        Hapus Semua Gambar
                                    </button>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn-primary">
                                    Bagikan Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif



        <!-- Posts Feed -->
        <div class="space-y-6">
            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow">
                    <!-- Post Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $post->user->name }}</h4>
                                    @if($post->user->farm_name)
                                        <p class="text-sm text-gray-500">{{ $post->user->farm_name }}</p>
                                    @endif
                                    <p class="text-xs text-gray-400">{{ $post->time_ago }}</p>
                                </div>
                                @if($post->user->is_verified)
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            <button type="button" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="p-6">
                        <p class="text-gray-900 mb-4">{{ $post->content }}</p>
                        
                        @if($post->images && count($post->images) > 0)
                            <div class="grid {{ count($post->images) > 1 ? 'grid-cols-2' : 'grid-cols-1' }} gap-2 mb-4">
                                @foreach($post->images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Post image" class="rounded-lg object-cover {{ count($post->images) === 1 ? 'h-96' : 'h-48' }} w-full">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Post Actions -->
                    <div class="px-6 py-3 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <button type="button" class="flex items-center space-x-2 text-gray-500 hover:text-red-500"
                                        onclick="SocialManager.likePost({{ $post->id }}, this)">
                                    <i class="bi {{ $post->isLikedBy(auth()->user()) ? 'bi-heart-fill text-red-500' : 'bi-heart' }}"></i>
                                    <span class="likes-count">{{ $post->likes_count }}</span>
                                </button>
                                

                            </div>
                            
                            <a href="{{ route('social.profile', $post->user->id) }}" class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                                Lihat Profil
                            </a>
                        </div>
                    </div>


                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Post</h3>
                    <p class="text-gray-500 mb-6">Follow petani untuk melihat update mereka di feed</p>
                    <a href="{{ route('petani.directory') }}" class="btn-primary">
                        Jelajahi Petani
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/posts.js') }}"></script>
@endpush
@endsection
