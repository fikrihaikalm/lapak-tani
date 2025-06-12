<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Petani\DashboardController as PetaniDashboardController;
use App\Http\Controllers\Petani\ProductController as PetaniProductController;
use App\Http\Controllers\Petani\EducationController as PetaniEducationController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [HomeController::class, 'products'])->name('products');
Route::get('/edukasi', [HomeController::class, 'education'])->name('education');
Route::get('/edukasi/{id}', [HomeController::class, 'educationShow'])->name('education.show');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/produk', [AdminProductController::class, 'index'])->name('products.index');
    Route::delete('/produk/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/edukasi', [AdminEducationController::class, 'index'])->name('education.index');
    Route::get('/edukasi/tambah', [AdminEducationController::class, 'create'])->name('education.create');
    Route::post('/edukasi', [AdminEducationController::class, 'store'])->name('education.store');
    Route::get('/edukasi/{id}/edit', [AdminEducationController::class, 'edit'])->name('education.edit');
    Route::put('/edukasi/{id}', [AdminEducationController::class, 'update'])->name('education.update');
    Route::delete('/edukasi/{id}', [AdminEducationController::class, 'destroy'])->name('education.destroy');
});

// Petani routes
Route::middleware(['auth', 'petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [PetaniDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/produk', [PetaniProductController::class, 'index'])->name('products.index');
    Route::get('/produk/tambah', [PetaniProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [PetaniProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{id}/edit', [PetaniProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{id}', [PetaniProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{id}', [PetaniProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/edukasi', [PetaniEducationController::class, 'index'])->name('education.index');
    Route::get('/edukasi/tambah', [PetaniEducationController::class, 'create'])->name('education.create');
    Route::post('/edukasi', [PetaniEducationController::class, 'store'])->name('education.store');
    Route::get('/edukasi/{id}/edit', [PetaniEducationController::class, 'edit'])->name('education.edit');
    Route::put('/edukasi/{id}', [PetaniEducationController::class, 'update'])->name('education.update');
    Route::delete('/edukasi/{id}', [PetaniEducationController::class, 'destroy'])->name('education.destroy');
});