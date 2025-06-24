@extends('layouts.app')

@section('title', 'Pengikut ' . $user->name . ' - Lapak Tani')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('social.profile', $user->id) }}" class="text-hijau-600 hover:text-hijau-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="flex items-center space-x-3">
                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Pengikut {{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $followers->total() }} pengikut</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <a href="{{ route('social.followers', $user->id) }}" 
                   class="border-hijau-500 text-hijau-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Pengikut
                </a>
                <a href="{{ route('social.following', $user->id) }}" 
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Mengikuti
                </a>
            </nav>
        </div>
    </div>

    <!-- Followers List -->
    @if($followers->count() > 0)
        <div class="space-y-4">
            @foreach($followers as $follower)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $follower->avatar_url }}" 
                                 alt="{{ $follower->name }}" 
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    <a href="{{ route('social.profile', $follower->id) }}" class="hover:text-hijau-600">
                                        {{ $follower->name }}
                                    </a>
                                </h3>
                                @if($follower->farm_name)
                                    <p class="text-sm text-gray-500">{{ $follower->farm_name }}</p>
                                @endif
                                <p class="text-xs text-gray-400">
                                    Mengikuti sejak {{ $follower->pivot->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        
                        @auth
                            @if(auth()->id() !== $follower->id)
                                <div>
                                    @if(auth()->user()->isFollowing($follower))
                                        <button onclick="unfollowUser({{ $follower->id }})" 
                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                                            Berhenti Mengikuti
                                        </button>
                                    @else
                                        <button onclick="followUser({{ $follower->id }})" 
                                                class="px-4 py-2 bg-hijau-600 text-white rounded-lg hover:bg-hijau-700 transition duration-200">
                                            Ikuti
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $followers->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Belum Ada Pengikut</h2>
                <p class="text-gray-600">{{ $user->name }} belum memiliki pengikut.</p>
            </div>
        </div>
    @endif
</div>

<script>
function followUser(userId) {
    fetch(`/follow/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
            location.reload();
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan');
    });
}

function unfollowUser(userId) {
    fetch(`/unfollow/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
            location.reload();
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan');
    });
}
</script>
@endsection
