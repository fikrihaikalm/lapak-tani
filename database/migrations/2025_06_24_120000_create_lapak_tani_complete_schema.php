<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // User Types Table
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->json('permissions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Update Users Table
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type')->default('konsumen')->after('email');
            $table->string('phone')->nullable()->after('password');
            $table->string('location')->nullable()->after('phone');
            $table->text('address')->nullable()->after('location');
            $table->string('avatar')->nullable()->after('address');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('farm_name')->nullable()->after('bio');
            $table->boolean('is_verified')->default(false)->after('farm_name');
            $table->timestamp('last_active_at')->nullable()->after('is_verified');
            $table->string('slug')->unique()->nullable()->after('last_active_at');
        });

        // Product Categories Table
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Update Products Table
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('slug')->constrained('product_categories')->onDelete('set null');
            $table->decimal('weight', 8, 2)->nullable()->after('price');
            $table->string('unit')->default('kg')->after('weight');
            $table->boolean('is_organic')->default(false)->after('unit');
            $table->boolean('is_featured')->default(false)->after('is_organic');
            $table->integer('total_sold')->default(0)->after('is_featured');
        });

        // Education Categories Table
        Schema::create('education_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color')->default('#10B981');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Update Education Table
        Schema::table('educations', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('education_categories')->onDelete('set null');
            $table->string('slug')->unique()->after('title');
            $table->text('excerpt')->nullable()->after('content');
            $table->string('featured_image')->nullable()->after('excerpt');
            $table->boolean('is_featured')->default(false)->after('featured_image');
            $table->integer('views_count')->default(0)->after('is_featured');
        });

        // Posts Table
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->json('images')->nullable();
            $table->integer('likes_count')->default(0);
            $table->timestamps();
        });

        // Post Likes Table
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'post_id']);
        });

        // Follows Table
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['follower_id', 'following_id']);
        });

        // Cart Items Table
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
            
            $table->unique(['user_id', 'product_id']);
        });

        // Wishlist Items Table
        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'product_id']);
        });

        // Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->text('shipping_address');
            $table->text('notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });

        // Order Items Table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        // Financial Records Table
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['income', 'expense']);
            $table->decimal('amount', 10, 2);
            $table->string('description');
            $table->string('category')->nullable();
            $table->date('transaction_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_records');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('wishlist_items');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('posts');
        
        Schema::table('educations', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'slug', 'excerpt', 'featured_image', 'is_featured', 'views_count']);
        });
        
        Schema::dropIfExists('education_categories');
        
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'weight', 'unit', 'is_organic', 'is_featured', 'total_sold']);
        });
        
        Schema::dropIfExists('product_categories');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_type', 'phone', 'location', 'address', 'avatar', 'bio', 'farm_name', 'is_verified', 'last_active_at', 'slug']);
        });
        
        Schema::dropIfExists('user_types');
    }
};
