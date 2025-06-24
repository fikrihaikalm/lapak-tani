# 📁 Views Structure Documentation

## 🎯 **STRUKTUR FOLDER VIEWS YANG TELAH DIORGANISIR**

### ✅ **STRUKTUR BARU (SETELAH REORGANISASI):**

```
resources/views/
├── layouts/                    # Layout templates
│   ├── app.blade.php          # Main app layout (public pages)
│   ├── dashboard.blade.php    # Dashboard layout (konsumen/petani)
│   └── register-halaman.blade.php # Registration layout
│
├── partials/                  # Reusable components
│   ├── navbar.blade.php       # Navigation bar
│   └── notifications.blade.php # Toast notifications
│
├── auth/                      # Authentication pages
│   ├── login.blade.php        # Login form
│   └── register.blade.php     # Registration form
│
├── home.blade.php            # Homepage
│
├── konsumen/                 # Consumer-specific features
│   ├── profile/              # Consumer profile management
│   │   └── edit.blade.php    # Edit consumer profile
│   ├── cart/                 # Shopping cart
│   │   └── index.blade.php   # Cart listing
│   ├── orders/               # Order management
│   │   ├── index.blade.php   # Order history
│   │   └── show.blade.php    # Order details
│   ├── wishlist/             # Wishlist management
│   │   └── index.blade.php   # Wishlist items
│   └── checkout.blade.php    # Checkout process
│
├── petani/                   # Farmer-specific features
│   ├── dashboard.blade.php   # Farmer dashboard
│   ├── profile/              # Farmer profile management
│   │   └── edit.blade.php    # Edit farmer profile
│   ├── products/             # Product management
│   │   ├── index.blade.php   # Product listing
│   │   ├── create.blade.php  # Add new product
│   │   └── edit.blade.php    # Edit product
│   ├── orders/               # Order management for farmers
│   │   ├── index.blade.php   # Incoming orders
│   │   └── show.blade.php    # Order details
│   ├── education/            # Education content management
│   │   ├── index.blade.php   # Education listing
│   │   ├── create.blade.php  # Create education content
│   │   └── edit.blade.php    # Edit education content
│   └── financial/            # Financial management
│       ├── index.blade.php   # Financial records
│       └── create.blade.php  # Add financial record
│
├── public-pages/             # Public accessible pages
│   ├── products/             # Public product catalog
│   │   ├── index.blade.php   # Product catalog
│   │   └── show.blade.php    # Product detail page
│   ├── education/            # Public education content
│   │   ├── index.blade.php   # Education articles
│   │   └── show.blade.php    # Article detail page
│   ├── petani-directory.blade.php # Farmer directory
│   ├── about.blade.php       # About us page
│   ├── contact.blade.php     # Contact page
│   ├── help.blade.php        # Help center
│   ├── faq.blade.php         # FAQ page
│   ├── how-it-works.blade.php # How it works
│   ├── terms.blade.php       # Terms of service
│   ├── privacy.blade.php     # Privacy policy
│   └── testimonials.blade.php # Customer testimonials
│
├── social/                   # Social features (shared)
│   ├── feed.blade.php        # Social media feed
│   ├── profile.blade.php     # Universal profile view
│   ├── followers.blade.php   # Followers listing
│   ├── following.blade.php   # Following listing
│   └── stories.blade.php     # Stories view
│
├── profile/                  # Legacy profile (to be removed)
│   └── edit.blade.php        # Old profile edit
│
└── errors/                   # Error pages
    ├── 404.blade.php         # Page not found
    └── 500.blade.php         # Server error
```

## 🔧 **PERUBAHAN YANG DILAKUKAN:**

### ✅ **File Movements:**
1. **`products/` → `public-pages/products/`** - Product catalog untuk publik
2. **`education/` → `public-pages/education/`** - Education content untuk publik
3. **`public/` → `public-pages/`** - Semua halaman publik
4. **Profile separation** - Copy ke `konsumen/profile/` dan `petani/profile/`

### ✅ **Controller Updates:**
1. **HomeController** - Update view paths ke `public-pages.*`
2. **PublicController** - Update view paths ke `public-pages.*`

### ✅ **Benefits:**
1. **Clear Separation** - Role-based organization
2. **Logical Grouping** - Related features together
3. **Scalable Structure** - Easy to add new features
4. **Maintainable** - Clear file locations

## 🎯 **PRINSIP ORGANISASI:**

### **1. Role-Based Separation:**
- `konsumen/` - Features khusus konsumen
- `petani/` - Features khusus petani
- `public-pages/` - Halaman yang bisa diakses semua orang

### **2. Feature Grouping:**
- Setiap feature punya folder sendiri
- Related actions dalam satu folder
- Consistent naming convention

### **3. Shared Components:**
- `layouts/` - Template yang digunakan bersama
- `partials/` - Component yang reusable
- ~~`social/` - Features sosial yang shared~~ (REMOVED)

## 📋 **TODO NEXT:**

### **🔄 Cleanup Tasks:**
1. **Remove** `profile/edit.blade.php` (legacy)
2. **Update** remaining controllers if any
3. **Test** all routes and views
4. **Document** any missing view paths

### **🚀 Future Improvements:**
1. **Add** `components/` folder for Blade components
2. **Create** `emails/` folder for email templates
3. **Organize** `partials/` by feature
4. **Add** `admin/` folder if admin features needed

## 🎉 **RESULT:**

Struktur views sekarang lebih terorganisir, mudah dipahami, dan scalable untuk pengembangan future features!
