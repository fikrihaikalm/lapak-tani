<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove type and expires_at columns from posts table (stories feature removed)
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['type', 'expires_at']);
        });

        // Remove rating and total_reviews columns from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['rating', 'total_reviews']);
        });

        // Remove rating column from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }

    public function down(): void
    {
        // Add back the columns if needed to rollback
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('type', ['post', 'story'])->default('post');
            $table->timestamp('expires_at')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->default(0);
        });
    }
};
