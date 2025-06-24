@extends('layouts.app')

@section('title', 'Feed - Lapak Tani')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Stories Section -->
        @if($stories->count() > 0)
            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Stories</h3>
                <div class="flex space-x-4 overflow-x-auto">
                    @foreach($stories as $userId => $userStories)
                        @php $user = $userStories->first()->user; @endphp
                        <div class="flex-shrink-0 text-center cursor-pointer" onclick="viewStory({{ $userId }})">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 p-1">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full rounded-full border-2 border-white">
                            </div>
                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($user->name, 10) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

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

                            <div class="flex justify-between items-center mt-4">
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="type" value="post" checked class="form-radio">
                                        <span class="ml-2 text-sm text-gray-700">Post</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="type" value="story" class="form-radio">
                                        <span class="ml-2 text-sm text-gray-700">Story (24 jam)</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn-primary">
                                    Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <!-- Stories Section -->
        @if($stories->count() > 0)
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Stories</h3>
                <div class="flex space-x-4 overflow-x-auto pb-2">
                    @foreach($stories as $userId => $userStories)
                        @php $user = $userStories->first()->user; @endphp
                        <a href="{{ route('social.stories', $user->id) }}" class="flex-shrink-0">
                            <div class="relative">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                     class="w-16 h-16 rounded-full border-4 border-gradient-to-r from-purple-400 to-pink-400 object-cover">
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <p class="text-xs text-center mt-2 text-gray-600 max-w-16 truncate">{{ $user->name }}</p>
                        </a>
                    @endforeach
                </div>
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
                                        onclick="likePost({{ $post->id }}, this)">
                                    <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : '' }}" 
                                         fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" 
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span class="likes-count">{{ $post->likes_count }}</span>
                                </button>
                                
                                <button type="button" class="flex items-center space-x-2 text-gray-500 hover:text-blue-500" 
                                        onclick="toggleComments({{ $post->id }})">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span>{{ $post->comments_count }}</span>
                                </button>
                            </div>
                            
                            <a href="{{ route('social.profile', $post->user->id) }}" class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                                Lihat Profil
                            </a>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div id="comments-{{ $post->id }}" class="hidden border-t border-gray-200">
                        <div class="p-6">
                            <!-- Comment Form -->
                            <form onsubmit="submitComment(event, {{ $post->id }})" class="mb-4">
                                <div class="flex space-x-3">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
                                    <div class="flex-1">
                                        <input type="text" name="comment" placeholder="Tulis komentar..." 
                                               class="form-input" required>
                                    </div>
                                    <button type="submit" class="btn-primary">
                                        Kirim
                                    </button>
                                </div>
                            </form>

                            <!-- Comments List -->
                            <div id="comments-list-{{ $post->id }}" class="space-y-3">
                                @foreach($post->comments as $comment)
                                    <div class="flex space-x-3">
                                        <img src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full">
                                        <div class="flex-1">
                                            <div class="bg-gray-100 rounded-lg px-3 py-2">
                                                <p class="font-medium text-sm text-gray-900">{{ $comment->user->name }}</p>
                                                <p class="text-gray-700">{{ $comment->comment }}</p>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">{{ $comment->time_ago }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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

<script>
function likePost(postId, button) {
    fetch('/posts/like', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ post_id: postId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const icon = button.querySelector('svg');
            const countSpan = button.querySelector('.likes-count');
            
            if (data.action === 'liked') {
                icon.classList.add('text-red-500');
                icon.setAttribute('fill', 'currentColor');
            } else {
                icon.classList.remove('text-red-500');
                icon.setAttribute('fill', 'none');
            }
            
            countSpan.textContent = data.likes_count;
        }
    });
}

function toggleComments(postId) {
    const commentsDiv = document.getElementById(`comments-${postId}`);
    commentsDiv.classList.toggle('hidden');
}

function submitComment(event, postId) {
    event.preventDefault();
    
    const form = event.target;
    const commentInput = form.querySelector('input[name="comment"]');
    const comment = commentInput.value.trim();
    
    if (!comment) return;
    
    fetch('/posts/comment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            post_id: postId,
            comment: comment
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const commentsList = document.getElementById(`comments-list-${postId}`);
            const newComment = `
                <div class="flex space-x-3">
                    <img src="${data.comment.user_avatar}" alt="${data.comment.user_name}" class="w-8 h-8 rounded-full">
                    <div class="flex-1">
                        <div class="bg-gray-100 rounded-lg px-3 py-2">
                            <p class="font-medium text-sm text-gray-900">${data.comment.user_name}</p>
                            <p class="text-gray-700">${data.comment.comment}</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">${data.comment.time_ago}</p>
                    </div>
                </div>
            `;
            commentsList.insertAdjacentHTML('beforeend', newComment);
            commentInput.value = '';
        }
    });
}

function previewPostImages(input) {
    const preview = document.getElementById('post-image-preview');
    const container = document.getElementById('preview-container');

    // Clear previous previews
    container.innerHTML = '';

    if (input.files && input.files.length > 0) {
        // Limit to 5 images
        const files = Array.from(input.files).slice(0, 5);

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-20 object-cover rounded border border-gray-300">
                    <button type="button" onclick="removePostPreview(this, ${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                        ×
                    </button>
                `;
                container.appendChild(div);
            }

            reader.readAsDataURL(file);
        });

        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}

function removePostPreview(button, index) {
    const input = document.getElementById('images');
    const preview = document.getElementById('post-image-preview');
    const container = document.getElementById('preview-container');

    // Remove the preview element
    button.parentElement.remove();

    // If no more previews, hide the container
    if (container.children.length === 0) {
        preview.classList.add('hidden');
        input.value = '';
    }
}

function removePostPreviews() {
    const input = document.getElementById('images');
    const preview = document.getElementById('post-image-preview');
    const container = document.getElementById('preview-container');

    input.value = '';
    container.innerHTML = '';
    preview.classList.add('hidden');
}
</script>
@endsection
