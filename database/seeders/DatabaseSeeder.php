<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Education;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Education categories removed - using simplified system

        // Create product categories
        $productCategories = [
            ['name' => 'Sayuran Hijau', 'color' => '#16a34a', 'description' => 'Sayuran berdaun hijau segar', 'icon' => '🥬'],
            ['name' => 'Buah-buahan', 'color' => '#f59e0b', 'description' => 'Buah segar dari kebun', 'icon' => '🍎'],
            ['name' => 'Umbi-umbian', 'color' => '#8b5cf6', 'description' => 'Umbi dan akar-akaran', 'icon' => '🥔'],
            ['name' => 'Rempah-rempah', 'color' => '#dc2626', 'description' => 'Rempah dan bumbu dapur', 'icon' => '🌶️'],
            ['name' => 'Biji-bijian', 'color' => '#eab308', 'description' => 'Biji dan kacang-kacangan', 'icon' => '🌾'],
            ['name' => 'Produk Olahan', 'color' => '#06b6d4', 'description' => 'Produk hasil olahan pertanian', 'icon' => '🥫'],
        ];

        foreach ($productCategories as $category) {
            \App\Models\ProductCategory::create($category);
        }

        // Petani users
        $petani1 = User::create([
            'name' => 'Pak Tani Sukses',
            'email' => 'petani@lapaktani.com',
            'password' => Hash::make('password'),
            'user_type' => 'petani',
            'phone' => '081234567891',
            'address' => 'Bogor, Jawa Barat',
            'farm_name' => 'Kebun Segar Pak Tani',
            'bio' => 'Petani berpengalaman 15 tahun dalam budidaya sayuran organik',
            'is_verified' => true,
            'rating' => 4.8,
            'total_reviews' => 25,
        ]);

        $petani2 = User::create([
            'name' => 'Bu Sari',
            'email' => 'sari@lapaktani.com',
            'password' => Hash::make('password'),
            'user_type' => 'petani',
            'phone' => '081234567892',
            'address' => 'Malang, Jawa Timur',
            'farm_name' => 'Taman Sayur Bu Sari',
            'bio' => 'Spesialis tanaman hidroponik dan sayuran organik',
            'is_verified' => true,
            'rating' => 4.9,
            'total_reviews' => 18,
        ]);

        // Konsumen users
        $konsumen1 = User::create([
            'name' => 'Andi Pembeli',
            'email' => 'andi@lapaktani.com',
            'password' => Hash::make('password'),
            'user_type' => 'konsumen',
            'phone' => '081234567893',
            'address' => 'Jakarta Selatan, DKI Jakarta',
        ]);

        $konsumen2 = User::create([
            'name' => 'Siti Konsumen',
            'email' => 'siti@lapaktani.com',
            'password' => Hash::make('password'),
            'user_type' => 'konsumen',
            'phone' => '081234567894',
            'address' => 'Bandung, Jawa Barat',
        ]);

        // Sample products
        $products = [
            [
                'user_id' => $petani1->id,
                'name' => 'Beras Organik Premium',
                'description' => 'Beras organik berkualitas tinggi dari sawah Bogor. Ditanam tanpa pestisida dan pupuk kimia.',
                'category_id' => 5, // Biji-bijian
                'price' => 15000,
                'stock' => 100,
                'unit' => 'kg',
                'weight' => 1.0,
                'is_organic' => true,
                'is_featured' => true,
                'rating' => 4.8,
                'total_reviews' => 15,
                'total_sold' => 85,
            ],
            [
                'user_id' => $petani1->id,
                'name' => 'Sayuran Hidroponik Mix',
                'description' => 'Paket sayuran segar hasil hidroponik. Terdiri dari selada, kangkung, dan bayam.',
                'category_id' => 1, // Sayuran Hijau
                'price' => 25000,
                'stock' => 50,
                'unit' => 'paket',
                'weight' => 0.5,
                'is_organic' => true,
                'rating' => 4.9,
                'total_reviews' => 12,
                'total_sold' => 38,
            ],
            [
                'user_id' => $petani2->id,
                'name' => 'Tomat Cherry Organik',
                'description' => 'Tomat cherry segar dan manis, ditanam secara organik tanpa pestisida.',
                'category_id' => 2, // Buah-buahan
                'price' => 18000,
                'stock' => 75,
                'unit' => 'kg',
                'weight' => 1.0,
                'is_organic' => true,
                'rating' => 4.7,
                'total_reviews' => 8,
                'total_sold' => 42,
            ],
            [
                'user_id' => $petani2->id,
                'name' => 'Cabai Rawit Merah',
                'description' => 'Cabai rawit merah segar dengan tingkat kepedasan tinggi, cocok untuk bumbu masakan.',
                'category_id' => 4, // Rempah-rempah
                'price' => 35000,
                'stock' => 30,
                'unit' => 'kg',
                'weight' => 1.0,
                'rating' => 4.6,
                'total_reviews' => 6,
                'total_sold' => 24,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Sample educations (simplified)
        $educations = [
            [
                'user_id' => $petani1->id,
                'title' => 'Cara Menanam Padi Organik yang Benar',
                'content' => 'Menanam padi organik memerlukan teknik khusus untuk menghasilkan beras berkualitas tinggi tanpa menggunakan pestisida kimia. Berikut adalah langkah-langkah yang perlu diperhatikan: 1. Pemilihan bibit unggul, 2. Persiapan lahan yang baik, 3. Penggunaan pupuk organik, 4. Pengendalian hama alami.',
                'is_featured' => true,
                'views_count' => 150,
            ],
            [
                'user_id' => $petani2->id,
                'title' => 'Mengendalikan Hama Tanpa Pestisida Kimia',
                'content' => 'Pengendalian hama secara alami dapat dilakukan dengan berbagai cara yang ramah lingkungan. Metode ini tidak hanya efektif tetapi juga aman untuk kesehatan. Beberapa cara yang bisa dilakukan: 1. Menggunakan tanaman pengusir hama, 2. Pemanfaatan musuh alami, 3. Rotasi tanaman.',
                'is_featured' => true,
                'views_count' => 120,
            ],
            [
                'user_id' => $petani1->id,
                'title' => 'Teknologi Hidroponik untuk Pemula',
                'content' => 'Hidroponik adalah teknik bercocok tanam tanpa menggunakan tanah sebagai media tanam. Teknik ini sangat cocok untuk lahan terbatas. Keuntungan hidroponik: 1. Hemat air, 2. Pertumbuhan lebih cepat, 3. Hasil lebih bersih, 4. Tidak tergantung musim.',
                'views_count' => 200,
            ],
        ];

        foreach ($educations as $educationData) {
            Education::create($educationData);
        }

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