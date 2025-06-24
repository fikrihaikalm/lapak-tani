# Lapak Tani Database Migrations

## For Fresh Installation

If you're setting up Lapak Tani for the first time, you only need these core migrations:

### Core Laravel Migrations:
- `2014_10_12_000000_create_users_table.php`
- `2014_10_12_100000_create_password_reset_tokens_table.php`
- `2019_08_19_000000_create_failed_jobs_table.php`
- `2019_12_14_000001_create_personal_access_tokens_table.php`

### Lapak Tani Core Tables:
- `2025_06_10_224208_create-products_table.php`
- `2025_06_10_230431_create_education_table.php`

### Complete Schema (All Features):
- `2025_06_24_120000_create_lapak_tani_complete_schema.php`

## For Fresh Installation - Run These Commands:

```bash
# Drop all tables and recreate with clean migrations
php artisan migrate:fresh --seed

# Or if you want to start completely fresh:
php artisan migrate:reset
php artisan migrate --path=database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php
php artisan migrate --path=database/migrations/2019_08_19_000000_create_failed_jobs_table.php
php artisan migrate --path=database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php
php artisan migrate --path=database/migrations/2025_06_10_224208_create-products_table.php
php artisan migrate --path=database/migrations/2025_06_10_230431_create_education_table.php
php artisan migrate --path=database/migrations/2025_06_24_120000_create_lapak_tani_complete_schema.php
php artisan db:seed
```

## Development History Migrations (Can be ignored for fresh install):

These migrations were created during development and can be safely ignored for new installations:

- `2025_06_23_000001_create_new_tables_for_enhanced_features.php`
- `2025_06_23_000002_add_columns_to_existing_tables.php`
- `2025_06_24_005344_create_product_categories_table.php`
- `2025_06_24_010230_add_foreign_keys_to_products_table.php`
- `2025_06_24_015140_add_slug_columns_properly.php`
- `2025_06_24_030000_create_financial_records_table.php`
- `2025_06_24_060000_create_user_types_table.php`
- `2025_06_24_070000_add_slug_to_users_table.php`
- `2025_06_24_080000_drop_product_reviews_table.php`
- `2025_06_24_090000_drop_unused_tables.php`
- `2025_06_24_100000_remove_unused_columns.php`
- `2025_06_24_110000_add_location_to_users_table.php`

## Database Schema Overview

### Users & Authentication:
- `users` - User accounts (petani & konsumen)
- `user_types` - Flexible user type system
- `password_reset_tokens` - Password reset functionality
- `personal_access_tokens` - API authentication

### Products & Categories:
- `products` - Product listings
- `product_categories` - Product categorization

### Education System:
- `educations` - Educational content
- `education_categories` - Education categorization

### Social Features:
- `posts` - User posts/updates
- `post_likes` - Post likes
- `follows` - User following system

### E-commerce:
- `cart_items` - Shopping cart
- `wishlist_items` - User wishlists
- `orders` - Order management
- `order_items` - Order line items

### Financial:
- `financial_records` - Financial tracking for farmers

## Notes:

1. The complete schema migration includes all necessary tables and relationships
2. All foreign key constraints are properly set up
3. Indexes are optimized for performance
4. The schema supports both petani (farmers) and konsumen (consumers) user types
5. Social features, e-commerce, and financial tracking are fully integrated
