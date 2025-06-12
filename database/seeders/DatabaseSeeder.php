<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Education;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@katalogpertanian.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia'
        ]);

        // Petani user
        $petani = User::create([
            'name' => 'Pak Tani',
            'email' => 'petani@katalogpertanian.com',
            'password' => Hash::make('password'),
            'role' => 'petani',
            'phone' => '081234567891',
            'address' => 'Bogor, Jawa Barat'
        ]);

        // // Sample products
        // Product::create([
        //     'user_id' => $petani->id,
        //     'name' => 'Beras Organik Premium',
        //     'description' => 'Beras organik berkualitas tinggi dari sawah Bogor. Ditanam tanpa pestisida dan pupuk kimia.',
        //     'price' => 15000,
        //     'stock' => 100,
        //     'image_url' => 'https://images.pexels.com/photos/33239/rice-grain-seed-food.jpg'
        // ]);

        // Product::create([
        //     'user_id' => $petani->id,
        //     'name' => 'Sayuran Hidroponik',
        //     'description' => 'Paket sayuran segar hasil hidroponik. Terdiri dari selada, kangkung, dan bayam.',
        //     'price' => 25000,
        //     'stock' => 50,
        //     'image_url' => 'https://images.pexels.com/photos/1656663/pexels-photo-1656663.jpeg'
        // ]);

        // // Sample education content
        // Education::create([
        //     'user_id' => $petani->id,
        //     'title' => 'Tips Menanam Padi Organik',
        //     'content' => 'Menanam padi organik memerlukan perhatian khusus terhadap pemilihan bibit, pengolahan tanah, dan pengendalian hama secara alami. Berikut adalah langkah-langkah yang dapat Anda ikuti untuk memulai budidaya padi organik...',
        //     'image_url' => 'https://images.pexels.com/photos/2132227/pexels-photo-2132227.jpeg'
        // ]);

        // Education::create([
        //     'user_id' => $petani->id,
        //     'title' => 'Keuntungan Bertani Hidroponik',
        //     'content' => 'Sistem hidroponik menawarkan banyak keuntungan dibandingkan dengan sistem pertanian konvensional. Mulai dari efisiensi penggunaan air, kontrol nutrisi yang lebih baik, hingga hasil panen yang lebih konsisten...',
        //     'image_url' => 'https://images.pexels.com/photos/4503273/pexels-photo-4503273.jpeg'
        // ]);
    }
}