# 📋 **MIGRATION GUIDE - LAPAK TANI**

## 🚀 **UNTUK FRESH INSTALL (Clone dari GitHub)**

### **1. Setup Database**
```bash
# 1. Copy environment file
cp .env.example .env

# 2. Edit .env file - set database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapak_tani
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 3. Generate app key
php artisan key:generate

# 4. Create storage link
php artisan storage:link
```

### **2. Run Migrations (URUTAN PENTING!)**
```bash
# Jalankan semua migrations dalam urutan ini:
php artisan migrate

# Atau jika ingin fresh install:
php artisan migrate:fresh
```

### **3. Seed Database (OPSIONAL)**
```bash
# Seed data awal (user types, categories, sample data)
php artisan db:seed

# Atau seed specific seeder:
php artisan db:seed --class=UserTypeSeeder
php artisan db:seed --class=ProductCategorySeeder
```

## 📁 **DAFTAR MIGRATIONS YANG DIPERLUKAN**

### **Core Laravel Migrations:**
1. `2014_10_12_000000_create_users_table.php` - Tabel users dasar
2. `2014_10_12_100000_create_password_reset_tokens_table.php` - Reset password
3. `2019_08_19_000000_create_failed_jobs_table.php` - Failed jobs
4. `2019_12_14_000001_create_personal_access_tokens_table.php` - API tokens

### **Lapak Tani Core Migrations:**
5. `2025_06_10_224208_create-products_table.php` - Tabel produk
6. `2025_06_10_230431_create_education_table.php` - Tabel edukasi
7. `2025_06_23_000001_create_new_tables_for_enhanced_features.php` - Fitur sosial & e-commerce
8. `2025_06_23_000002_add_columns_to_existing_tables.php` - Kolom tambahan

### **Enhancement Migrations:**
9. `2025_06_24_005344_create_product_categories_table.php` - Kategori produk
10. `2025_06_24_010230_add_foreign_keys_to_products_table.php` - Foreign keys produk
11. `2025_06_24_015140_add_slug_columns_properly.php` - SEO slugs
12. `2025_06_24_030000_create_financial_records_table.php` - Catatan keuangan
13. `2025_06_24_060000_create_user_types_table.php` - Sistem user types
14. `2025_06_24_070000_add_slug_to_users_table.php` - User slugs
15. `2025_06_24_080000_drop_product_reviews_table.php` - Hapus tabel review (tidak dipakai)

## 🗄️ **TABEL YANG AKAN DIBUAT**

### **User Management:**
- `users` - Data pengguna
- `user_types` - Jenis pengguna (Konsumen, Petani, dll)
- `follows` - Sistem follow/following

### **E-Commerce:**
- `products` - Produk pertanian
- `product_categories` - Kategori produk
- `carts` - Keranjang belanja
- `orders` - Pesanan
- `order_items` - Item pesanan
- `wishlists` - Wishlist

### **Social Features:**
- `posts` - Postingan sosial
- `post_likes` - Like postingan
- `post_comments` - Komentar postingan

### **Content:**
- `educations` - Konten edukasi

### **Financial:**
- `financial_records` - Catatan keuangan petani

## ⚠️ **PENTING UNTUK DEVELOPER**

### **Jangan Hapus Migrations Ini:**
- Semua 15 migrations di atas WAJIB ada
- Urutan migrations sudah benar berdasarkan dependencies
- Jika ada error, cek foreign key constraints

### **Untuk Update Existing Database:**
```bash
# Cek status migrations
php artisan migrate:status

# Rollback jika perlu
php artisan migrate:rollback

# Migrate ulang
php artisan migrate
```

### **Troubleshooting:**
1. **Foreign key error**: Pastikan tabel parent sudah ada
2. **Column exists error**: Cek apakah migration sudah pernah dijalankan
3. **Permission error**: Pastikan user database punya permission CREATE/ALTER

## 🎯 **SEEDERS YANG TERSEDIA**

1. `UserTypeSeeder` - Data user types (Konsumen, Petani, Moderator, Admin)
2. `ProductCategorySeeder` - Kategori produk pertanian
3. `UpdateUserSlugsSeeder` - Update slug untuk user existing

## 📝 **NOTES**
- Database engine: MySQL/MariaDB
- Charset: utf8mb4
- Collation: utf8mb4_unicode_ci
- Semua tabel menggunakan timestamps
- Foreign keys dengan cascade delete untuk data integrity
