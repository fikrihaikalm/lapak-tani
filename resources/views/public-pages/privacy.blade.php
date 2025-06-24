@extends('layouts.app')

@section('title', 'Kebijakan Privasi - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Kebijakan Privasi</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Komitmen kami dalam melindungi privasi dan data pribadi Anda
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

            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Pendahuluan</h2>
            <p class="text-gray-700 mb-6">
                Lapak Tani menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan kepada kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Informasi yang Kami Kumpulkan</h2>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-3">2.1. Informasi yang Anda Berikan</h3>
            <ul class="list-disc list-inside text-gray-700 mb-4 space-y-2">
                <li>Nama lengkap dan informasi kontak</li>
                <li>Alamat email dan nomor telepon</li>
                <li>Alamat pengiriman dan penagihan</li>
                <li>Informasi profil dan preferensi</li>
                <li>Konten yang Anda unggah (foto produk, deskripsi, dll.)</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mb-3">2.2. Informasi yang Dikumpulkan Otomatis</h3>
            <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                <li>Alamat IP dan informasi perangkat</li>
                <li>Data penggunaan dan aktivitas di platform</li>
                <li>Cookie dan teknologi pelacakan serupa</li>
                <li>Log akses dan riwayat transaksi</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Cara Kami Menggunakan Informasi</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>3.1. <strong>Penyediaan Layanan:</strong> Memfasilitasi transaksi antara petani dan konsumen</p>
                <p>3.2. <strong>Komunikasi:</strong> Mengirim notifikasi, update, dan informasi penting</p>
                <p>3.3. <strong>Keamanan:</strong> Mencegah penipuan dan aktivitas yang mencurigakan</p>
                <p>3.4. <strong>Peningkatan Layanan:</strong> Menganalisis penggunaan untuk meningkatkan platform</p>
                <p>3.5. <strong>Pemasaran:</strong> Mengirim informasi promosi (dengan persetujuan Anda)</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Berbagi Informasi</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>4.1. <strong>Dengan Pengguna Lain:</strong> Informasi profil publik dan produk</p>
                <p>4.2. <strong>Penyedia Layanan:</strong> Partner teknologi yang membantu operasional platform</p>
                <p>4.3. <strong>Kewajiban Hukum:</strong> Jika diwajibkan oleh hukum atau otoritas berwenang</p>
                <p>4.4. <strong>Perlindungan Hak:</strong> Untuk melindungi hak, properti, atau keamanan</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Keamanan Data</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>5.1. Kami menggunakan enkripsi SSL untuk melindungi data yang ditransmisikan</p>
                <p>5.2. Server kami dilindungi dengan firewall dan sistem keamanan berlapis</p>
                <p>5.3. Akses ke data pribadi dibatasi hanya untuk karyawan yang berwenang</p>
                <p>5.4. Kami melakukan audit keamanan secara berkala</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Hak Anda</h2>
            <div class="text-gray-700 mb-6">
                <p class="mb-3">Anda memiliki hak untuk:</p>
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Akses:</strong> Meminta salinan data pribadi yang kami miliki</li>
                    <li><strong>Koreksi:</strong> Memperbarui atau memperbaiki informasi yang tidak akurat</li>
                    <li><strong>Penghapusan:</strong> Meminta penghapusan data pribadi Anda</li>
                    <li><strong>Portabilitas:</strong> Meminta transfer data ke penyedia layanan lain</li>
                    <li><strong>Keberatan:</strong> Menolak pemrosesan data untuk tujuan tertentu</li>
                    <li><strong>Pembatasan:</strong> Membatasi cara kami memproses data Anda</li>
                </ul>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookie dan Teknologi Pelacakan</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>7.1. Kami menggunakan cookie untuk meningkatkan pengalaman pengguna</p>
                <p>7.2. Cookie membantu kami mengingat preferensi dan pengaturan Anda</p>
                <p>7.3. Anda dapat mengatur browser untuk menolak cookie, namun beberapa fitur mungkin tidak berfungsi optimal</p>
                <p>7.4. Kami juga menggunakan Google Analytics untuk analisis penggunaan website</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Penyimpanan Data</h2>
            <div class="text-gray-700 mb-6 space-y-3">
                <p>8.1. Data pribadi disimpan selama akun Anda aktif</p>
                <p>8.2. Setelah penghapusan akun, data akan dihapus dalam 30 hari</p>
                <p>8.3. Beberapa data mungkin disimpan lebih lama untuk keperluan hukum</p>
                <p>8.4. Data transaksi disimpan sesuai dengan ketentuan perpajakan</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Transfer Data Internasional</h2>
            <p class="text-gray-700 mb-6">
                Data Anda terutama disimpan di server yang berlokasi di Indonesia. Jika ada transfer data ke luar negeri, kami akan memastikan tingkat perlindungan yang memadai sesuai dengan standar internasional.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Privasi Anak</h2>
            <p class="text-gray-700 mb-6">
                Layanan kami tidak ditujukan untuk anak di bawah 17 tahun. Kami tidak secara sengaja mengumpulkan informasi pribadi dari anak-anak. Jika Anda mengetahui bahwa anak Anda telah memberikan informasi pribadi kepada kami, silakan hubungi kami.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Perubahan Kebijakan</h2>
            <p class="text-gray-700 mb-6">
                Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan material akan diberitahukan melalui email atau notifikasi di platform. Tanggal "terakhir diperbarui" di bagian atas akan diubah sesuai dengan revisi terbaru.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Hubungi Kami</h2>
            <p class="text-gray-700 mb-4">
                Jika Anda memiliki pertanyaan tentang kebijakan privasi ini atau ingin menggunakan hak-hak Anda, silakan hubungi kami:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700">
                    <strong>Data Protection Officer:</strong><br>
                    <strong>Email:</strong> privacy@lapaktani.com<br>
                    <strong>Telepon:</strong> +62 822 2974 0385<br>
                    <strong>Alamat:</strong> Kampus Tegalboto, Jl. Kalimantan No.37 Krajan Timur, Sumbersari, Kec. Sumbersari Kabupaten Jember, Jawa Timur 68121
                </p>
            </div>

            <div class="mt-8 p-4 bg-hijau-50 rounded-lg">
                <p class="text-hijau-800 text-sm">
                    <strong>Catatan:</strong> Kebijakan privasi ini disusun sesuai dengan Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi dan peraturan terkait lainnya di Indonesia.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
