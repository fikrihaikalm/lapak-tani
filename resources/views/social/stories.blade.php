@extends('layouts.app')

@section('title', 'Stories - ' . $user->name)

@section('content')
<div class="min-h-screen bg-black relative overflow-hidden">
    <!-- Back Button -->
    <div class="absolute top-4 left-4 z-50">
        <a href="{{ route('social.feed') }}" class="inline-flex items-center text-white hover:text-gray-300 transition duration-200">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Story Progress Bar -->
    <div class="absolute top-4 left-1/2 transform -translate-x-1/2 z-40 w-full max-w-md px-4">
        <div class="flex space-x-1">
            @foreach($stories as $index => $story)
                <div class="flex-1 h-1 bg-gray-600 rounded-full overflow-hidden">
                    <div id="progress-{{ $index }}" class="h-full bg-white transition-all duration-300 ease-linear" style="width: 0%"></div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- User Info -->
    <div class="absolute top-12 left-1/2 transform -translate-x-1/2 z-40 flex items-center space-x-3 text-white">
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full border-2 border-white">
        <div>
            <p class="font-semibold">{{ $user->name }}</p>
            <p class="text-sm text-gray-300" id="story-time">{{ $stories->first()->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <!-- Story Container -->
    <div class="relative w-full h-screen flex items-center justify-center">
        @foreach($stories as $index => $story)
            <div id="story-{{ $index }}" class="story-slide absolute inset-0 {{ $index === 0 ? 'active' : 'hidden' }}">
                @if($story->images && count($story->images) > 0)
                    <img src="{{ Storage::url($story->images[0]) }}" alt="Story" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-purple-600 to-blue-600 flex items-center justify-center">
                        <div class="text-center text-white px-8">
                            <h2 class="text-2xl font-bold mb-4">{{ $story->content }}</h2>
                        </div>
                    </div>
                @endif
                
                <!-- Story Content Overlay -->
                @if($story->content && $story->images && count($story->images) > 0)
                    <div class="absolute bottom-20 left-0 right-0 px-6">
                        <div class="bg-black bg-opacity-50 rounded-lg p-4">
                            <p class="text-white text-lg">{{ $story->content }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Navigation Areas -->
        <div class="absolute inset-0 flex">
            <!-- Previous Story Area -->
            <div class="w-1/3 h-full cursor-pointer" onclick="previousStory()"></div>
            
            <!-- Pause Area -->
            <div class="w-1/3 h-full cursor-pointer" onclick="togglePause()"></div>
            
            <!-- Next Story Area -->
            <div class="w-1/3 h-full cursor-pointer" onclick="nextStory()"></div>
        </div>
    </div>

    <!-- Pause Indicator -->
    <div id="pause-indicator" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
        <div class="bg-black bg-opacity-70 rounded-full p-4">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
</div>

<script>
let currentStoryIndex = 0;
let stories = @json($stories);
let isPaused = false;
let progressInterval;
let storyTimeout;

const STORY_DURATION = 5000; // 5 seconds per story

function initializeStories() {
    showStory(0);
    startProgress();
}

function showStory(index) {
    // Hide all stories
    document.querySelectorAll('.story-slide').forEach(slide => {
        slide.classList.add('hidden');
        slide.classList.remove('active');
    });
    
    // Show current story
    const currentSlide = document.getElementById(`story-${index}`);
    if (currentSlide) {
        currentSlide.classList.remove('hidden');
        currentSlide.classList.add('active');
    }
    
    // Update time
    const timeElement = document.getElementById('story-time');
    if (stories[index]) {
        timeElement.textContent = new Date(stories[index].created_at).toLocaleString();
    }
    
    // Reset all progress bars
    document.querySelectorAll('[id^="progress-"]').forEach((bar, i) => {
        if (i < index) {
            bar.style.width = '100%';
        } else if (i === index) {
            bar.style.width = '0%';
        } else {
            bar.style.width = '0%';
        }
    });
}

function startProgress() {
    if (isPaused) return;
    
    const progressBar = document.getElementById(`progress-${currentStoryIndex}`);
    if (!progressBar) return;
    
    let width = 0;
    const increment = 100 / (STORY_DURATION / 50); // Update every 50ms
    
    progressInterval = setInterval(() => {
        if (isPaused) return;
        
        width += increment;
        progressBar.style.width = width + '%';
        
        if (width >= 100) {
            clearInterval(progressInterval);
            nextStory();
        }
    }, 50);
}

function nextStory() {
    clearInterval(progressInterval);
    clearTimeout(storyTimeout);
    
    if (currentStoryIndex < stories.length - 1) {
        currentStoryIndex++;
        showStory(currentStoryIndex);
        startProgress();
    } else {
        // End of stories, go back to feed
        window.location.href = '{{ route("social.feed") }}';
    }
}

function previousStory() {
    clearInterval(progressInterval);
    clearTimeout(storyTimeout);
    
    if (currentStoryIndex > 0) {
        currentStoryIndex--;
        showStory(currentStoryIndex);
        startProgress();
    }
}

function togglePause() {
    isPaused = !isPaused;
    const pauseIndicator = document.getElementById('pause-indicator');
    
    if (isPaused) {
        pauseIndicator.classList.remove('hidden');
        clearInterval(progressInterval);
    } else {
        pauseIndicator.classList.add('hidden');
        startProgress();
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    switch(e.key) {
        case 'ArrowLeft':
            previousStory();
            break;
        case 'ArrowRight':
        case ' ':
            e.preventDefault();
            nextStory();
            break;
        case 'Escape':
            window.location.href = '{{ route("social.feed") }}';
            break;
    }
});

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeStories();
});

// Auto-advance stories
storyTimeout = setTimeout(() => {
    if (!isPaused) {
        nextStory();
    }
}, STORY_DURATION);
</script>
@endsection
