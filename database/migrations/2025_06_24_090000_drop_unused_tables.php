<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop post_comments table (comments feature removed)
        Schema::dropIfExists('post_comments');
    }

    public function down(): void
    {
        // Recreate post_comments table if needed to rollback
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->timestamps();
        });
    }
};
