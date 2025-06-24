@extends('layouts.app')

@section('title', $user->name . ' - Lapak Tani')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <div class="flex items-start space-x-6">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full">
                    
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            @if($user->is_verified)
                                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                        
                        @if($user->farm_name)
                            <p class="text-lg text-gray-600 mb-2">{{ $user->farm_name }}</p>
                        @endif
                        
                        @if($user->bio)
                            <p class="text-gray-700 mb-4">{{ $user->bio }}</p>
                        @endif
                        
                        <!-- Stats -->
                        <div class="flex items-center space-x-6 mb-4">
                            @if($user->isPetani())
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-900">{{ $stats['posts_count'] }}</p>
                                    <p class="text-sm text-gray-500">Posts</p>
                                </div>
                            @endif
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['followers_count'] }}</p>
                                <p class="text-sm text-gray-500">Followers</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['following_count'] }}</p>
                                <p class="text-sm text-gray-500">Following</p>
                            </div>
                            @if($user->isPetani())
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-900">{{ $stats['products_count'] }}</p>
                                    <p class="text-sm text-gray-500">Produk</p>
                                </div>
                            @endif
                        </div>

                        <!-- Rating for Petani -->
                        @if($user->isPetani() && $user->rating > 0)
                            <div class="flex items-center space-x-2 mb-4">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $user->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-600">{{ $user->formatted_rating }} ({{ $user->total_reviews }} review)</span>
                            </div>
                        @endif
                        
                        <!-- Action Buttons -->
                        @auth
                            @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="btn-primary">
                                    Edit Profile
                                </a>
                            @else
                                <div class="flex space-x-3">
                                    <button type="button" class="btn-primary" onclick="SocialManager.toggleFollow({{ $user->id }}, this)">
                                        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                    </button>

                                    @if($user->isPetani())
                                        <a href="{{ route('products') }}?petani={{ $user->id }}" class="btn-secondary">
                                            Lihat Produk
                                        </a>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6">
                    @if($user->isPetani())
                        <button type="button" class="tab-button active" onclick="SocialManager.switchTab('posts', this)">
                            Posts
                        </button>
                        <button type="button" class="tab-button" onclick="SocialManager.switchTab('products', this)">
                            Produk
                        </button>
                        <button type="button" class="tab-button" onclick="SocialManager.switchTab('education', this)">
                            Edukasi
                        </button>
                    @elseif($user->isKonsumen() && auth()->check() && auth()->id() === $user->id)
                        <button type="button" class="tab-button active" onclick="SocialManager.switchTab('orders', this)">
                            Pesanan
                        </button>
                        <button type="button" class="tab-button" onclick="SocialManager.switchTab('wishlist', this)">
                            Wishlist
                        </button>
                    @else
                        <button type="button" class="tab-button active" onclick="SocialManager.switchTab('followers', this)">
                            Followers
                        </button>
                    @endif
                    <button type="button" class="tab-button" onclick="SocialManager.switchTab('followers', this)">
                        Followers
                    </button>
                    <button type="button" class="tab-button" onclick="SocialManager.switchTab('following', this)">
                        Following
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div id="tab-content">
            <!-- Posts Tab -->
            <div id="posts-tab" class="tab-content active">
                <div class="space-y-6">
                    @forelse($posts as $post)
                        <div class="bg-white rounded-lg shadow">
                            <!-- Post Header -->
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $post->user->name }}</h4>
                                        <p class="text-xs text-gray-400">{{ $post->time_ago }}</p>
                                    </div>
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
                                <div class="flex items-center space-x-6">
                                    @auth
                                        <button type="button" class="flex items-center space-x-2 text-gray-500 hover:text-red-500"
                                                onclick="SocialManager.likePost({{ $post->id }}, this)">
                                            <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : '' }}" 
                                                 fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" 
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                            <span class="likes-count">{{ $post->likes_count }}</span>
                                        </button>
                                    @else
                                        <div class="flex items-center space-x-2 text-gray-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                            <span>{{ $post->likes_count }}</span>
                                        </div>
                                    @endauth
                                    
                                    <div class="flex items-center space-x-2 text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span>{{ $post->comments_count }}</span>
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
                            <p class="text-gray-500">{{ $user->name }} belum membuat post apapun</p>
                        </div>
                    @endforelse
                </div>

                @if($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Products Tab -->
            @if($user->isPetani())
                <div id="products-tab" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($user->products as $product)
                            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-hijau-600">{{ $product->formatted_price }}</span>
                                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4m0 0l-4-4m4 4V3"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Produk</h3>
                                <p class="text-gray-500">{{ $user->name }} belum menambahkan produk apapun</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Education Tab -->
                <div id="education-tab" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($user->educations as $education)
                            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                                <img src="{{ $education->image_url }}" alt="{{ $education->title }}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $education->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $education->excerpt }}</p>
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('education.show', $education->id) }}" class="text-hijau-600 hover:text-hijau-700 font-medium">
                                            Baca Selengkapnya →
                                        </a>
                                        <span class="text-sm text-gray-500">{{ $education->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Konten Edukasi</h3>
                                <p class="text-gray-500">{{ $user->name }} belum membuat konten edukasi apapun</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Orders Tab for Konsumen -->
            @if($user->isKonsumen() && auth()->check() && auth()->id() === $user->id)
                <div id="orders-tab" class="tab-content hidden">
                    <div class="space-y-4">
                        @forelse($orders ?? [] as $order)
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="font-semibold text-gray-900">#{{ $order->order_number }}</h3>
                                        <p class="text-sm text-gray-500">{{ $order->petani->name }} • {{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $order->status_badge }}">
                                        {{ $order->status_label }}
                                    </span>
                                </div>

                                <div class="space-y-2 mb-4">
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between text-sm">
                                            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                            <span>{{ $item->formatted_subtotal }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                    <span class="font-semibold">Total: {{ $order->formatted_total }}</span>
                                    <div class="space-x-2">
                                        <a href="{{ route('konsumen.orders.show', $order->id) }}" class="btn-secondary btn-sm">
                                            Detail
                                        </a>
                                        @if($order->status === 'pending')
                                            <a href="https://wa.me/{{ $order->petani->phone }}?text={{ urlencode($order->whatsapp_message) }}"
                                               target="_blank" class="btn-primary btn-sm">
                                                Hubungi Petani
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-lg shadow p-12 text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
                                <p class="text-gray-500 mb-4">Mulai berbelanja produk segar dari petani lokal</p>
                                <a href="{{ route('products') }}" class="btn-primary">
                                    Mulai Belanja
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Wishlist Tab for Konsumen -->
                <div id="wishlist-tab" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($wishlist ?? [] as $item)
                            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $item->product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->product->description, 100) }}</p>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-lg font-bold text-hijau-600">{{ $item->product->formatted_price }}</span>
                                        <span class="text-sm text-gray-500">Stok: {{ $item->product->stock }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="btn-primary btn-sm flex-1" onclick="CartManager.addToCart({{ $item->product->id }})">
                                            Tambah ke Keranjang
                                        </button>
                                        <button type="button" class="btn-secondary btn-sm" onclick="WishlistManager.remove({{ $item->product->id }})">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Wishlist Kosong</h3>
                                <p class="text-gray-500 mb-4">Tambahkan produk favorit Anda ke wishlist</p>
                                <a href="{{ route('products') }}" class="btn-primary">
                                    Jelajahi Produk
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.tab-button {
    @apply py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300;
}

.tab-button.active {
    @apply border-hijau-500 text-hijau-600;
}

.tab-content {
    @apply block;
}

.tab-content.hidden {
    @apply hidden;
}
</style>


@endsection
