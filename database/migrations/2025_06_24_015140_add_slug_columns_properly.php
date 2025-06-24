<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add slug to educations table only (products already has it)
        Schema::table('educations', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Populate slugs for existing products (if empty)
        $products = \App\Models\Product::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($products as $product) {
            $slug = \Illuminate\Support\Str::slug($product->name);
            $originalSlug = $slug;
            $count = 1;

            while (\App\Models\Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $product->update(['slug' => $slug]);
        }

        // Populate slugs for existing educations
        $educations = \App\Models\Education::all();
        foreach ($educations as $education) {
            $slug = \Illuminate\Support\Str::slug($education->title);
            $originalSlug = $slug;
            $count = 1;

            while (\App\Models\Education::where('slug', $slug)->where('id', '!=', $education->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $education->update(['slug' => $slug]);
        }

        // Make slug unique after populating
        Schema::table('educations', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
