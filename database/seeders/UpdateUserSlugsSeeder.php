<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UpdateUserSlugsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($users as $user) {
            $slug = Str::slug($user->name);
            
            // Ensure uniqueness
            $originalSlug = $slug;
            $count = 1;
            while (User::where('slug', $slug)->where('id', '!=', $user->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $user->update(['slug' => $slug]);
            $this->command->info("Updated slug for user: {$user->name} -> {$slug}");
        }
        
        $this->command->info("Updated " . $users->count() . " user slugs.");
    }
}
