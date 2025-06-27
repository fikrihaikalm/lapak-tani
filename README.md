# 🌱 Lapak Tani - Platform Pertanian Lokal

<p align="center">
  <img src="public/logo.png" alt="Lapak Tani Logo" width="200">
</p>

<p align="center">
  <strong>Platform digital yang menghubungkan petani lokal dengan konsumen, sekaligus menyediakan edukasi pertanian untuk menciptakan ekosistem pertanian yang berkelanjutan.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0+-orange?style=flat-square&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-cyan?style=flat-square&logo=tailwindcss" alt="TailwindCSS">
</p>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Tim Pengembang](#-tim-pengembang)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Arsitektur Sistem](#-arsitektur-sistem)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Struktur Database](#-struktur-database)
- [API Documentation](#-api-documentation)
- [Lisensi](#-lisensi)

---

## 🌾 Tentang Proyek

**Lapak Tani** adalah platform digital berbasis web yang dikembangkan sebagai solusi untuk mengatasi permasalahan klasik yang dihadapi petani lokal di Indonesia. Platform ini menggabungkan fungsi marketplace dan edukasi pertanian dalam satu ekosistem yang terintegrasi.

### 🎯 Latar Belakang

Indonesia sebagai negara agraris memiliki potensi besar dalam bidang pertanian, namun petani lokal masih menghadapi berbagai tantangan:

- **Keterbatasan akses pasar**: Petani bergantung pada tengkulak dengan margin keuntungan yang kecil
- **Minimnya literasi digital**: Kurangnya platform edukasi pertanian yang interaktif dan mudah diakses
- **Rendahnya minat generasi muda**: Sektor pertanian dianggap kuno dan kurang menguntungkan

### 💡 Solusi

Lapak Tani hadir sebagai jembatan digital yang:

1. **Menghubungkan langsung** petani dengan konsumen tanpa perantara
2. **Menyediakan platform edukasi** pertanian yang menarik dan interaktif
3. **Memberdayakan petani** dengan tools digital untuk memasarkan produk secara mandiri
4. **Meningkatkan partisipasi generasi muda** dalam sektor pertanian berbasis teknologi

---

## 👥 Tim Pengembang

Proyek ini dikembangkan oleh mahasiswa Teknik Informatika dalam mata kuliah Pemrograman Berbasis Website:

| Nama | NIM | Role |
|------|-----|------|
| **Muhammad Fikri Haikal** | 232410103050 | Ketua Tim |
| **Ahmad Hisyam Ramadhan** | 232410103063 | Anggota |
| **Royhan Awwabi** | 232410103067 | Anggota |

---

## ✨ Fitur Utama

### 🛒 Untuk Konsumen

- **Katalog Produk Pertanian**: Browse produk segar langsung dari petani lokal
- **Keranjang Belanja**: Sistem cart yang mendukung multiple petani dalam satu transaksi
- **Wishlist**: Simpan produk favorit untuk pembelian di kemudian hari
- **Checkout Terintegrasi**: Proses pemesanan yang mudah dengan integrasi WhatsApp
- **Riwayat Pesanan**: Tracking status pesanan dari pending hingga delivered
- **Profil Konsumen**: Manajemen data pribadi dan preferensi

### 🌱 Untuk Petani

- **Dashboard Petani**: Overview statistik penjualan, produk, dan pendapatan
- **Manajemen Produk**: CRUD produk dengan upload gambar dan kategorisasi
- **Manajemen Pesanan**: Tracking dan update status pesanan dari konsumen
- **Konten Edukasi**: Berbagi tips, pengalaman, dan pengetahuan pertanian
- **Laporan Keuangan**: Pencatatan dan analisis pendapatan dari penjualan
- **Verifikasi Otomatis**: Status verified setelah 20 transaksi sukses

### 🎓 Fitur Edukasi

- **Artikel Pertanian**: Konten edukatif yang dibuat oleh petani berpengalaman
- **Kategori Edukasi**: Organisasi konten berdasarkan topik pertanian
- **Sistem Slug**: URL-friendly untuk SEO dan kemudahan akses
- **Responsive Design**: Akses optimal di berbagai perangkat

### 🔧 Fitur Teknis

- **Role-based Access Control**: Pembagian akses berdasarkan tipe pengguna
- **Real-time Notifications**: Toast notifications untuk feedback user
- **Image Management**: Upload dan resize otomatis gambar produk
- **WhatsApp Integration**: Komunikasi langsung antara petani dan konsumen
- **Search & Filter**: Pencarian produk dan konten edukasi
- **Responsive UI**: Desain mobile-first dengan Tailwind CSS

---

## 🛠 Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - PHP Framework dengan arsitektur MVC
- **PHP 8.1+** - Server-side scripting language
- **MySQL 8.0+** - Relational database management system
- **Laravel Eloquent ORM** - Database abstraction layer

### Frontend
- **Blade Templating Engine** - Laravel's templating system
- **Tailwind CSS 3.x** - Utility-first CSS framework
- **JavaScript (Vanilla)** - Client-side interactivity
- **Vite** - Frontend build tool

### Tools & Libraries
- **Laravel Sanctum** - API authentication
- **Laravel Storage** - File management system
- **WhatsApp Web API** - Direct communication integration
- **Faker** - Test data generation
- **PHPUnit** - Testing framework

### Development Tools
- **Composer** - PHP dependency manager
- **NPM** - Node.js package manager
- **Git** - Version control system
- **Enterprise Architect** - UML modeling tool

---

## 🏗 Arsitektur Sistem

### Model-View-Controller (MVC)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── HomeController.php
│   │   ├── Petani/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── EducationController.php
│   │   │   ├── OrderController.php
│   │   │   └── FinancialController.php
│   │   └── Konsumen/
│   │       ├── CartController.php
│   │       ├── OrderController.php
│   │       └── WishlistController.php
│   └── Middleware/
│       ├── RoleMiddleware.php
│       └── AuthMiddleware.php
├── Models/
│   ├── User.php
│   ├── Product.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Cart.php
│   ├── Wishlist.php
│   ├── Education.php
│   ├── FinancialRecord.php
│   └── ProductCategory.php
└── Helpers/
    └── PhoneHelper.php
```

### Database Schema

Sistem menggunakan 9 tabel utama dengan relasi yang terstruktur:

- **users** - Data pengguna (petani & konsumen)
- **products** - Katalog produk pertanian
- **orders** - Data pesanan
- **order_items** - Detail item pesanan
- **carts** - Keranjang belanja
- **wishlists** - Daftar keinginan
- **educations** - Konten edukasi
- **financial_records** - Laporan keuangan petani
- **product_categories** - Kategori produk

---

## 🚀 Instalasi

### Prasyarat

Pastikan sistem Anda memiliki:

- **PHP 8.1** atau lebih tinggi
- **Composer** (PHP dependency manager)
- **Node.js & NPM** (untuk frontend assets)
- **MySQL 8.0** atau lebih tinggi
- **Git** (untuk version control)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/lapak-tani.git
   cd lapak-tani
   ```

2. **Install Dependencies**
   ```bash
   # Install PHP dependencies
   composer install

   # Install Node.js dependencies
   npm install
   ```

3. **Environment Setup**
   ```bash
   # Copy environment file
   cp .env.example .env

   # Generate application key
   php artisan key:generate
   ```

4. **Database Configuration**

   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lapak_tani
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Database Migration & Seeding**
   ```bash
   # Create database tables
   php artisan migrate

   # Seed sample data (optional)
   php artisan db:seed
   ```

6. **Storage Setup**
   ```bash
   # Create symbolic link for storage
   php artisan storage:link

   # Set proper permissions
   chmod -R 775 storage bootstrap/cache
   ```

7. **Build Frontend Assets**
   ```bash
   # Development build
   npm run dev

   # Production build
   npm run build
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://localhost:8000`

### Konfigurasi Tambahan

#### File Upload Configuration
Pastikan direktori storage memiliki permission yang tepat:
```bash
sudo chown -R www-data:www-data storage/
sudo chmod -R 755 storage/
```

#### WhatsApp Integration
Untuk mengaktifkan integrasi WhatsApp, pastikan format nomor telepon menggunakan helper yang tersedia di `app/Helpers/PhoneHelper.php`.

---

## 📖 Penggunaan

### Untuk Konsumen

1. **Registrasi/Login**
   - Akses halaman `/register` untuk membuat akun baru
   - Pilih tipe akun "Konsumen"
   - Login melalui `/login`

2. **Browse Produk**
   - Kunjungi halaman `/produk` untuk melihat katalog
   - Gunakan filter dan pencarian untuk menemukan produk
   - Klik produk untuk melihat detail lengkap

3. **Berbelanja**
   - Tambahkan produk ke keranjang atau wishlist
   - Akses keranjang melalui icon di navbar
   - Lakukan checkout dengan mengisi alamat pengiriman
   - Konfirmasi pesanan melalui WhatsApp

4. **Tracking Pesanan**
   - Lihat riwayat pesanan di menu "Pesanan Saya"
   - Track status dari pending hingga delivered

### Untuk Petani

1. **Setup Profil**
   - Registrasi dengan tipe akun "Petani"
   - Lengkapi profil dengan informasi farm_name dan lokasi
   - Upload foto profil dan deskripsi

2. **Manajemen Produk**
   - Akses dashboard petani
   - Tambah produk baru dengan foto dan deskripsi
   - Atur stok, harga, dan kategori produk
   - Update informasi produk secara berkala

3. **Kelola Pesanan**
   - Monitor pesanan masuk di dashboard
   - Update status pesanan (confirmed → shipped → delivered)
   - Komunikasi dengan konsumen via WhatsApp

4. **Konten Edukasi**
   - Buat artikel edukasi pertanian
   - Bagikan tips dan pengalaman
   - Bangun reputasi sebagai petani expert

5. **Laporan Keuangan**
   - Catat pendapatan dan pengeluaran
   - Lihat analisis penjualan bulanan
   - Export laporan untuk keperluan administrasi

---

## 🗄 Struktur Database

### Entity Relationship Diagram (ERD)

Sistem database Lapak Tani dirancang dengan relasi yang optimal untuk mendukung fitur marketplace dan edukasi:

#### Tabel Utama

**users**
- Primary key: `id`
- Fields: `name`, `email`, `user_type`, `phone`, `address`, `farm_name`, `is_verified`
- Relasi: One-to-Many dengan `products`, `orders`, `educations`

**products**
- Primary key: `id`
- Foreign key: `user_id` (petani), `category_id`
- Fields: `name`, `slug`, `price`, `stock`, `is_organic`, `is_featured`
- Relasi: Belongs-to `users`, Many-to-Many dengan `carts`, `wishlists`

**orders**
- Primary key: `id`
- Foreign keys: `user_id` (konsumen), `petani_id`
- Fields: `order_number`, `total_amount`, `status`, `shipping_address`
- Relasi: Has-Many `order_items`

#### Relasi 

```sql
-- User memiliki banyak produk (untuk petani)
users.id → products.user_id

-- User memiliki banyak pesanan (untuk konsumen)
users.id → orders.user_id

-- Petani menerima banyak pesanan
users.id → orders.petani_id

-- Order memiliki banyak item
orders.id → order_items.order_id

-- Produk bisa ada di banyak keranjang
products.id → carts.product_id
```

### Migrasi Database

File migrasi tersedia di `database/migrations/` dengan urutan:

1. `create_users_table` - Tabel pengguna dasar
2. `create_products_table` - Katalog produk
3. `create_new_tables_for_enhanced_features` - Fitur lanjutan
4. `create_financial_records_table` - Laporan keuangan
5. `add_slug_columns_properly` - SEO optimization

---

## 📡 API Documentation

### Authentication Endpoints

```http
POST /login
POST /register
POST /logout
```

### Public Endpoints

```http
GET /                    # Homepage
GET /produk             # Product catalog
GET /produk/{slug}      # Product detail
GET /edukasi            # Education content
GET /edukasi/{slug}     # Education detail
POST /search            # Global search
```

### Konsumen Endpoints

```http
GET /konsumen/cart              # View cart
POST /konsumen/cart/add         # Add to cart
PUT /konsumen/cart/update       # Update cart item
DELETE /konsumen/cart/remove    # Remove from cart

GET /konsumen/wishlist          # View wishlist
POST /konsumen/wishlist/toggle  # Toggle wishlist

GET /konsumen/orders            # Order history
GET /konsumen/orders/{id}       # Order detail
POST /konsumen/checkout         # Create order
```

### Petani Endpoints

```http
GET /petani/dashboard           # Dashboard overview
GET /petani/products            # Product management
POST /petani/products           # Create product
PUT /petani/products/{id}       # Update product
DELETE /petani/products/{id}    # Delete product

GET /petani/orders              # Incoming orders
POST /petani/orders/{id}/status # Update order status

GET /petani/educations          # Education content
POST /petani/educations         # Create education
PUT /petani/educations/{id}     # Update education

GET /petani/keuangan           # Financial records
POST /petani/keuangan          # Add financial record
```

### Response Format

Semua API response menggunakan format JSON standar:

```json
{
  "success": true,
  "message": "Operation successful",
  "data": {
    // Response data
  }
}
```

Error response:
```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    // Validation errors
  }
}
```
---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

```
MIT License

Copyright (c) 2025 Tim Lapak Tani

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

<p align="center">
  <sub>Proyek Mata Kuliah Pemrograman Berbasis Website<br>
   Informatika - 2025</sub>
</p>
