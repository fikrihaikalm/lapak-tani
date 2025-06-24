<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Petani\DashboardController as PetaniDashboardController;
use App\Http\Controllers\Petani\ProductController as PetaniProductController;
use App\Http\Controllers\Petani\EducationController as PetaniEducationController;
use App\Http\Controllers\Petani\FinancialController as PetaniFinancialController;
use App\Http\Controllers\Petani\OrderController as PetaniOrderController;


use App\Http\Controllers\Konsumen\CartController;
use App\Http\Controllers\Konsumen\OrderController;
use App\Http\Controllers\Konsumen\WishlistController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [HomeController::class, 'products'])->name('products');
Route::get('/edukasi', [HomeController::class, 'education'])->name('education');
Route::get('/edukasi/{education:slug}', [HomeController::class, 'educationShow'])->name('education.show');
Route::get('/produk/{product:slug}', [HomeController::class, 'productShow'])->name('product.show');

// Public pages
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('about');
Route::get('/cara-kerja', [PublicController::class, 'howItWorks'])->name('how-it-works');
Route::get('/testimoni', [PublicController::class, 'testimonials'])->name('testimonials');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');
Route::post('/kontak', [PublicController::class, 'submitContact'])->name('contact.submit');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/kebijakan-privasi', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/syarat-ketentuan', [PublicController::class, 'terms'])->name('terms');

Route::get('/direktori-petani', [PublicController::class, 'petaniDirectory'])->name('petani.directory');
Route::get('/cari', [PublicController::class, 'search'])->name('search');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Global search
Route::post('/search', [SearchController::class, 'search'])->name('search');

// Social features (authenticated users)
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Social routes
    Route::get('/feed', [SocialController::class, 'feed'])->name('social.feed');
    Route::post('/posts', [SocialController::class, 'createPost'])->name('social.posts.create');
    Route::post('/posts/like', [SocialController::class, 'likePost'])->name('social.posts.like');
    Route::post('/posts/comment', [SocialController::class, 'commentPost'])->name('social.posts.comment');
    Route::post('/follow', [SocialController::class, 'followUser'])->name('social.follow');
    Route::get('/profile/{user:slug}', [SocialController::class, 'userProfile'])->name('social.profile');
    Route::get('/stories/{user}', [SocialController::class, 'viewStories'])->name('social.stories');

    // Follow system
    Route::post('/follow/{user}', [\App\Http\Controllers\FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [\App\Http\Controllers\FollowController::class, 'unfollow'])->name('unfollow');
    Route::get('/profile/{user}/followers', [\App\Http\Controllers\FollowController::class, 'followers'])->name('social.followers');
    Route::get('/profile/{user}/following', [\App\Http\Controllers\FollowController::class, 'following'])->name('social.following');
});

// Konsumen routes
Route::middleware(['auth', 'konsumen'])->prefix('konsumen')->name('konsumen.')->group(function () {
    Route::get('/dashboard', function() {
        return redirect()->route('social.profile', auth()->user()->slug);
    })->name('dashboard');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout routes
    Route::get('/checkout', [\App\Http\Controllers\Konsumen\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [\App\Http\Controllers\Konsumen\CheckoutController::class, 'process'])->name('checkout.process');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

    // Order routes
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::put('/pesanan/{id}/batal', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// Petani routes
Route::middleware(['auth', 'petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [PetaniDashboardController::class, 'index'])->name('dashboard');

    // Product routes
    Route::get('/produk', [PetaniProductController::class, 'index'])->name('products.index');
    Route::get('/produk/tambah', [PetaniProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [PetaniProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{id}/edit', [PetaniProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{id}', [PetaniProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{id}', [PetaniProductController::class, 'destroy'])->name('products.destroy');

    // Education routes
    Route::get('/edukasi', [PetaniEducationController::class, 'index'])->name('education.index');
    Route::get('/edukasi/tambah', [PetaniEducationController::class, 'create'])->name('education.create');
    Route::post('/edukasi', [PetaniEducationController::class, 'store'])->name('education.store');
    Route::get('/edukasi/{id}/edit', [PetaniEducationController::class, 'edit'])->name('education.edit');
    Route::put('/edukasi/{id}', [PetaniEducationController::class, 'update'])->name('education.update');
    Route::delete('/edukasi/{id}', [PetaniEducationController::class, 'destroy'])->name('education.destroy');

    // Financial routes
    Route::get('/keuangan', [PetaniFinancialController::class, 'index'])->name('financial.index');
    Route::get('/keuangan/tambah', [PetaniFinancialController::class, 'create'])->name('financial.create');
    Route::post('/keuangan', [PetaniFinancialController::class, 'store'])->name('financial.store');
    Route::delete('/keuangan/{id}', [PetaniFinancialController::class, 'destroy'])->name('financial.destroy');

    // Order routes
    Route::get('/pesanan', [PetaniOrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{id}', [PetaniOrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan/{id}/status', [PetaniOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});