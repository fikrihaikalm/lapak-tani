@extends('layouts.app')

@section('title', 'Bantuan - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Pusat Bantuan</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Temukan jawaban atas pertanyaan Anda tentang Lapak Tani
            </p>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative">
            <input type="text" 
                   placeholder="Cari bantuan..." 
                   class="w-full px-4 py-3 pl-12 pr-4 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-search text-gray-400"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Bantuan Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="#getting-started" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-hijau-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-book text-xl text-hijau-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Memulai</h3>
                    <p class="text-sm text-gray-600">Panduan untuk pengguna baru</p>
                </div>
            </a>

            <a href="#buying" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-bag text-xl text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Berbelanja</h3>
                    <p class="text-sm text-gray-600">Cara membeli produk</p>
                </div>
            </a>

            <a href="#selling" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-currency-dollar text-xl text-yellow-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Berjualan</h3>
                    <p class="text-sm text-gray-600">Cara menjual produk</p>
                </div>
            </a>

            <a href="#account" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-person text-xl text-purple-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Akun</h3>
                    <p class="text-sm text-gray-600">Pengaturan akun</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- FAQ Sections -->
<div class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Getting Started -->
        <div id="getting-started" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Memulai dengan Lapak Tani</h2>
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara mendaftar di Lapak Tani?</h3>
                            <i class="bi bi-chevron-down text-gray-500 transform transition-transform"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Klik tombol "Daftar" di pojok kanan atas, pilih jenis akun (Petani atau Konsumen), isi formulir dengan data yang valid, dan verifikasi email Anda.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Apa perbedaan akun Petani dan Konsumen?</h3>
                            <i class="bi bi-chevron-down text-gray-500 transform transition-transform"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Akun Petani dapat menjual produk, mengelola toko, dan mengakses fitur edukasi pertanian. Akun Konsumen dapat berbelanja, menyimpan wishlist, dan mengikuti petani favorit.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buying -->
        <div id="buying" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Berbelanja di Lapak Tani</h2>
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara memesan produk?</h3>
                            <i class="bi bi-chevron-down text-gray-500 transform transition-transform"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Pilih produk yang diinginkan, tambahkan ke keranjang, isi alamat pengiriman, dan klik "Pesan via WhatsApp" untuk melanjutkan komunikasi dengan petani.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Metode pembayaran apa saja yang tersedia?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Pembayaran dilakukan langsung dengan petani melalui transfer bank, e-wallet, atau COD sesuai kesepakatan. Lapak Tani tidak memproses pembayaran secara langsung.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selling -->
        <div id="selling" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Berjualan di Lapak Tani</h2>
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara menambahkan produk?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Masuk ke dashboard petani, klik "Tambah Produk", isi informasi produk lengkap dengan foto, deskripsi, harga, dan stok, lalu publikasikan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara mendapatkan badge "Terverifikasi"?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Badge "Terverifikasi" diberikan otomatis setelah Anda berhasil menyelesaikan 20 pesanan dengan status "delivered". Badge ini menunjukkan kredibilitas dan pengalaman Anda sebagai petani.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account -->
        <div id="account" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Pengaturan Akun</h2>
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara mengubah informasi profil?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Klik foto profil di pojok kanan atas, pilih "Edit Profil", ubah informasi yang diinginkan, dan simpan perubahan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="faq-question w-full text-left p-6 focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara menghapus akun?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6">
                        <p class="text-gray-700">Hubungi tim support kami melalui email support@lapaktani.com dengan subjek "Hapus Akun" dan sertakan alasan penghapusan. Proses penghapusan akan dilakukan dalam 7 hari kerja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Support -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Masih Butuh Bantuan?</h2>
        <p class="text-gray-600 mb-8">Tim support kami siap membantu Anda 24/7</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="w-12 h-12 bg-hijau-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-envelope text-xl text-hijau-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600 text-sm mb-3">support@lapaktani.com</p>
                <p class="text-xs text-gray-500">Respon dalam 24 jam</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-telephone text-xl text-blue-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-600 text-sm mb-3">+62 333 123 4567</p>
                <p class="text-xs text-gray-500">Senin-Jumat 08:00-17:00</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.106"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">WhatsApp</h3>
                <p class="text-gray-600 text-sm mb-3">+62 812 3456 7890</p>
                <p class="text-xs text-gray-500">Respon cepat</p>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFAQ(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('svg');
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        answer.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection
