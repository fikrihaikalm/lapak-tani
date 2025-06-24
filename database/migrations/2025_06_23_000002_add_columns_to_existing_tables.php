<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add columns to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('address');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('farm_name')->nullable()->after('bio');
            $table->decimal('rating', 3, 2)->default(0)->after('farm_name');
            $table->integer('total_reviews')->default(0)->after('rating');
            $table->boolean('is_verified')->default(false)->after('total_reviews');
            $table->timestamp('last_active_at')->nullable()->after('is_verified');
        });

        // Add basic columns to educations table (simplified)
        Schema::table('educations', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('content');
            $table->integer('views_count')->default(0)->after('is_featured');
        });

        // Add columns to products table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('description');
            $table->string('unit')->default('kg')->after('stock');
            $table->decimal('weight', 8, 2)->nullable()->after('unit');
            $table->boolean('is_organic')->default(false)->after('weight');
            $table->boolean('is_featured')->default(false)->after('is_organic');
            $table->decimal('rating', 3, 2)->default(0)->after('is_featured');
            $table->integer('total_reviews')->default(0)->after('rating');
            $table->integer('total_sold')->default(0)->after('total_reviews');
            $table->json('additional_images')->nullable()->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'category_id', 'unit', 'weight', 'is_organic', 'is_featured',
                'rating', 'total_reviews', 'total_sold', 'additional_images'
            ]);
        });

        Schema::table('educations', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'views_count']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar', 'bio', 'farm_name', 'rating', 'total_reviews',
                'is_verified', 'last_active_at'
            ]);
        });
    }
};
