@extends('layouts.app')

@section('title', 'FAQ - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Frequently Asked Questions</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Temukan jawaban atas pertanyaan yang sering diajukan tentang Lapak Tani
            </p>
        </div>
    </div>
</div>

<!-- Search FAQ -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="relative">
            <input type="text" id="faq-search" placeholder="Cari pertanyaan..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Categories -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- General Questions -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Pertanyaan Umum</h2>
        <div class="space-y-4">
            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apa itu Lapak Tani?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Lapak Tani adalah platform digital yang menghubungkan petani lokal dengan konsumen, sekaligus menyediakan konten edukasi pertanian. Platform ini memungkinkan petani menjual produk mereka langsung ke konsumen tanpa perantara.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah gratis untuk bergabung?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Ya, pendaftaran di Lapak Tani sepenuhnya gratis baik untuk petani maupun konsumen. Kami tidak mengenakan biaya berlangganan atau biaya pendaftaran.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara kerja platform ini?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Petani mendaftarkan produk mereka di platform, konsumen dapat melihat dan memesan produk yang diinginkan. Setelah pembayaran dikonfirmasi, petani akan mengirim produk langsung ke konsumen. Platform juga menyediakan fitur edukasi dan komunitas untuk berbagi pengetahuan pertanian.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- For Farmers -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Untuk Petani</h2>
        <div class="space-y-4">
            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara menjadi petani di platform ini?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Daftar akun dengan memilih "Petani" saat registrasi. Lengkapi profil Anda dengan informasi kebun dan foto. Setelah itu, Anda dapat mulai menambahkan produk untuk dijual.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah ada biaya untuk menjual produk?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Tidak ada biaya untuk mendaftarkan produk. Kami hanya mengenakan komisi kecil (5%) dari setiap transaksi yang berhasil untuk biaya operasional platform.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana sistem pembayaran untuk petani?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Pembayaran akan ditransfer ke rekening petani dalam 1-3 hari kerja setelah konsumen mengkonfirmasi penerimaan produk. Kami mendukung transfer bank dan e-wallet.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apa itu badge "Petani Terverifikasi" dan bagaimana cara mendapatkannya?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Badge "Petani Terverifikasi" adalah tanda bahwa petani tersebut telah terpercaya dan berpengalaman. Badge ini diberikan secara otomatis kepada petani yang telah berhasil menyelesaikan <strong>20 pesanan atau lebih</strong> dengan status "delivered" (diterima konsumen). Badge ini menunjukkan kredibilitas dan kualitas layanan petani kepada calon pembeli.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- For Consumers -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Untuk Konsumen</h2>
        <div class="space-y-4">
            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara berbelanja di Lapak Tani?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Daftar sebagai konsumen, jelajahi produk yang tersedia, tambahkan ke keranjang, dan lakukan checkout. Anda dapat membayar melalui berbagai metode pembayaran yang tersedia.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Metode pembayaran apa saja yang tersedia?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Kami menerima pembayaran melalui transfer bank, kartu kredit/debit, dan e-wallet seperti GoPay, OVO, dan DANA. Semua transaksi dijamin aman.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bagaimana jika produk yang diterima tidak sesuai?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Kami memiliki kebijakan pengembalian untuk produk yang tidak sesuai atau rusak. Hubungi customer service dalam 24 jam setelah penerimaan untuk proses pengembalian atau penggantian.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Technical -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Teknis & Keamanan</h2>
        <div class="space-y-4">
            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah data saya aman?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Ya, kami menggunakan enkripsi SSL dan standar keamanan tinggi untuk melindungi data pribadi dan transaksi Anda. Data tidak akan dibagikan kepada pihak ketiga tanpa persetujuan.</p>
                </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow border border-gray-200">
                <button class="faq-question w-full text-left p-6 focus:outline-none focus:ring-2 focus:ring-hijau-500" onclick="toggleFAQ(this)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Apakah ada aplikasi mobile?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-6 pb-6">
                    <p class="text-gray-700">Saat ini kami menyediakan website yang responsif dan dapat diakses melalui browser mobile. Aplikasi mobile sedang dalam tahap pengembangan dan akan segera diluncurkan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Support -->
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tidak Menemukan Jawaban?</h2>
        <p class="text-lg text-gray-600 mb-8">
            Tim customer service kami siap membantu Anda 24/7
        </p>
        <div class="space-x-4">
            <a href="{{ route('contact') }}" class="bg-hijau-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-hijau-700 transition duration-200">
                Hubungi Support
            </a>
            <a href="https://wa.me/6281234567890" class="border-2 border-hijau-600 text-hijau-600 font-semibold py-3 px-8 rounded-lg hover:bg-hijau-600 hover:text-white transition duration-200">
                WhatsApp
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/faq.js') }}"></script>
@endpush
@endsection
