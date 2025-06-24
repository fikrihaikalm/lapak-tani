<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sayuran Hijau',
                'description' => 'Sayuran berdaun hijau segar seperti bayam, kangkung, sawi',
                'icon' => '🥬',
                'color' => '#16a34a',
                'sort_order' => 1,
            ],
            [
                'name' => 'Buah-buahan',
                'description' => 'Buah segar dari kebun petani lokal',
                'icon' => '🍎',
                'color' => '#dc2626',
                'sort_order' => 2,
            ],
            [
                'name' => 'Umbi-umbian',
                'description' => 'Kentang, ubi, singkong, dan umbi lainnya',
                'icon' => '🥔',
                'color' => '#a16207',
                'sort_order' => 3,
            ],
            [
                'name' => 'Cabai & Rempah',
                'description' => 'Cabai, bawang, jahe, kunyit, dan rempah-rempah',
                'icon' => '🌶️',
                'color' => '#dc2626',
                'sort_order' => 4,
            ],
            [
                'name' => 'Beras & Padi',
                'description' => 'Beras berkualitas dari petani lokal',
                'icon' => '🌾',
                'color' => '#eab308',
                'sort_order' => 5,
            ],
            [
                'name' => 'Jagung',
                'description' => 'Jagung manis dan jagung pipil',
                'icon' => '🌽',
                'color' => '#eab308',
                'sort_order' => 6,
            ],
            [
                'name' => 'Kacang-kacangan',
                'description' => 'Kacang tanah, kacang hijau, kedelai',
                'icon' => '🥜',
                'color' => '#a16207',
                'sort_order' => 7,
            ],
            [
                'name' => 'Sayuran Buah',
                'description' => 'Tomat, terong, timun, labu',
                'icon' => '🍅',
                'color' => '#dc2626',
                'sort_order' => 8,
            ],
            [
                'name' => 'Herbal & Obat',
                'description' => 'Tanaman herbal dan obat tradisional',
                'icon' => '🌿',
                'color' => '#16a34a',
                'sort_order' => 9,
            ],
            [
                'name' => 'Produk Olahan',
                'description' => 'Produk olahan dari hasil pertanian',
                'icon' => '🥫',
                'color' => '#7c3aed',
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
