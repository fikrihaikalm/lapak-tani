@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Syarat & Ketentuan</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Ketentuan penggunaan platform Lapak Tani yang perlu Anda ketahui
            </p>
        </div>
    </div>
</div>

<!-- Content -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <p class="text-gray-600 mb-8">
                <strong>Terakhir diperbarui:</strong> {{ date('d F Y') }}
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Penerimaan Ketentuan</h2>
            <p class="text-gray-700 mb-6">
                Dengan mengakses dan menggunakan platform Lapak Tani, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan ketentuan ini, mohon untuk tidak menggunakan layanan kami.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Definisi</h2>
            <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                <li><strong>Platform:</strong> Website dan aplikasi Lapak Tani</li>
                <li><strong>Petani:</strong> Pengguna yang menjual produk pertanian</li>
                <li><strong>Konsumen:</strong> Pengguna yang membeli produk pertanian</li>
                <li><strong>Produk:</strong> Hasil pertanian yang dijual di platform</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Registrasi dan Akun</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>3.1. Anda harus berusia minimal 17 tahun untuk menggunakan layanan ini.</p>
                <p>3.2. Informasi yang Anda berikan harus akurat dan terkini.</p>
                <p>3.3. Anda bertanggung jawab menjaga keamanan akun dan kata sandi.</p>
                <p>3.4. Satu orang hanya boleh memiliki satu akun.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Ketentuan untuk Petani</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>4.1. Produk yang dijual harus merupakan hasil pertanian sendiri atau yang Anda miliki secara sah.</p>
                <p>4.2. Informasi produk harus akurat termasuk deskripsi, harga, dan ketersediaan.</p>
                <p>4.3. Produk harus memenuhi standar kualitas dan keamanan pangan.</p>
                <p>4.4. Petani wajib memproses pesanan dalam waktu maksimal 24 jam.</p>
                <p>4.5. Pengiriman produk harus sesuai dengan waktu yang dijanjikan.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Ketentuan untuk Konsumen</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>5.1. Konsumen wajib memberikan informasi pengiriman yang akurat.</p>
                <p>5.2. Pembayaran harus dilakukan sesuai dengan metode yang disepakati.</p>
                <p>5.3. Konsumen wajib mengkonfirmasi penerimaan produk dalam waktu 3x24 jam.</p>
                <p>5.4. Komplain harus disampaikan maksimal 24 jam setelah penerimaan produk.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Transaksi dan Pembayaran</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>6.1. Semua transaksi dilakukan langsung antara petani dan konsumen.</p>
                <p>6.2. Lapak Tani tidak memproses pembayaran secara langsung.</p>
                <p>6.3. Metode pembayaran disepakati antara petani dan konsumen.</p>
                <p>6.4. Lapak Tani tidak bertanggung jawab atas sengketa pembayaran.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Konten dan Hak Kekayaan Intelektual</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>7.1. Anda mempertahankan hak atas konten yang Anda unggah.</p>
                <p>7.2. Dengan mengunggah konten, Anda memberikan lisensi kepada Lapak Tani untuk menggunakan konten tersebut.</p>
                <p>7.3. Konten tidak boleh melanggar hak cipta atau hak kekayaan intelektual pihak lain.</p>
                <p>7.4. Konten harus sesuai dengan norma dan tidak mengandung unsur SARA.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Larangan</h2>
            <div class="text-gray-700 mb-6">
                <p class="mb-3">Pengguna dilarang:</p>
                <ul class="list-disc list-inside space-y-2">
                    <li>Menjual produk ilegal atau berbahaya</li>
                    <li>Memberikan informasi palsu atau menyesatkan</li>
                    <li>Melakukan spam atau aktivitas yang mengganggu</li>
                    <li>Menggunakan platform untuk tujuan yang melanggar hukum</li>
                    <li>Mencoba mengakses akun pengguna lain tanpa izin</li>
                </ul>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Penghentian Layanan</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>9.1. Lapak Tani berhak menghentikan atau menangguhkan akun yang melanggar ketentuan.</p>
                <p>9.2. Pengguna dapat menghentikan akun kapan saja dengan memberitahu kami.</p>
                <p>9.3. Data akun yang dihentikan akan dihapus sesuai kebijakan privasi.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Batasan Tanggung Jawab</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>10.1. Lapak Tani berperan sebagai platform penghubung antara petani dan konsumen.</p>
                <p>10.2. Kami tidak bertanggung jawab atas kualitas, keamanan, atau legalitas produk.</p>
                <p>10.3. Kami tidak bertanggung jawab atas kerugian yang timbul dari transaksi.</p>
                <p>10.4. Tanggung jawab kami terbatas pada penyediaan platform teknologi.</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Perubahan Ketentuan</h2>
            <p class="text-gray-700 mb-6">
                Lapak Tani berhak mengubah syarat dan ketentuan ini kapan saja. Perubahan akan diberitahukan melalui platform dan berlaku setelah dipublikasikan. Penggunaan berkelanjutan platform setelah perubahan dianggap sebagai penerimaan terhadap ketentuan baru.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Hukum yang Berlaku</h2>
            <p class="text-gray-700 mb-6">
                Syarat dan ketentuan ini diatur oleh hukum Republik Indonesia. Setiap sengketa akan diselesaikan melalui pengadilan yang berwenang di Indonesia.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Kontak</h2>
            <p class="text-gray-700 mb-6">
                Jika Anda memiliki pertanyaan tentang syarat dan ketentuan ini, silakan hubungi kami di:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700">
                    <strong>Email:</strong> legal@lapaktani.com<br>
                    <strong>Telepon:</strong> +62 822 2974 0385r>
                    <strong>Alamat:</strong> Kampus Tegalboto, Jl. Kalimantan No.37 Krajan Timur, Sumbersari, Kec. Sumbersari Kabupaten Jember, Jawa Timur 68121
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
