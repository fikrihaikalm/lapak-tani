<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    public function run(): void
    {
        $userTypes = [
            [
                'name' => 'Konsumen',
                'slug' => 'konsumen',
                'description' => 'Pengguna yang membeli produk dari petani',
                'permissions' => [
                    'view_products',
                    'add_to_cart',
                    'create_orders',
                    'view_orders',
                    'follow_users',
                    'like_posts',
                    'comment_posts',
                ],
                'color' => '#3b82f6',
                'icon' => '🛒',
                'sort_order' => 1,
            ],
            [
                'name' => 'Petani',
                'slug' => 'petani',
                'description' => 'Petani yang menjual produk pertanian',
                'permissions' => [
                    'create_products',
                    'manage_products',
                    'view_orders',
                    'manage_orders',
                    'create_posts',
                    'create_education',
                    'manage_education',
                    'view_analytics',
                    'follow_users',
                    'like_posts',
                    'comment_posts',
                ],
                'color' => '#16a34a',
                'icon' => '🌱',
                'sort_order' => 2,
            ],
            [
                'name' => 'Moderator',
                'slug' => 'moderator',
                'description' => 'Moderator yang mengawasi konten dan aktivitas',
                'permissions' => [
                    'moderate_posts',
                    'moderate_comments',
                    'moderate_products',
                    'moderate_education',
                    'view_reports',
                    'manage_reports',
                    'view_analytics',
                ],
                'color' => '#7c3aed',
                'icon' => '🛡️',
                'sort_order' => 3,
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator dengan akses penuh',
                'permissions' => [
                    'manage_users',
                    'manage_user_types',
                    'manage_categories',
                    'manage_settings',
                    'view_analytics',
                    'manage_reports',
                    'moderate_posts',
                    'moderate_comments',
                    'moderate_products',
                    'moderate_education',
                    'create_products',
                    'manage_products',
                    'view_orders',
                    'manage_orders',
                    'create_posts',
                    'create_education',
                    'manage_education',
                ],
                'color' => '#dc2626',
                'icon' => '👑',
                'sort_order' => 4,
            ],
        ];

        foreach ($userTypes as $userType) {
            UserType::create($userType);
        }
    }
}
