@extends('layouts.app')

@section('title', 'Hubungi Kami - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Hubungi Kami</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Kami siap membantu Anda. Jangan ragu untuk menghubungi tim kami kapan saja.
            </p>
        </div>
    </div>
</div>

<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                
                <form action="{{ route('contact.submit') }}" method="POST" data-ajax="true" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required 
                               class="form-input" 
                               placeholder="Masukkan nama lengkap Anda">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required 
                               class="form-input" 
                               placeholder="Masukkan alamat email Anda">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <input type="text" id="subject" name="subject" required 
                               class="form-input" 
                               placeholder="Subjek pesan Anda">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="6" required 
                                  class="form-textarea" 
                                  placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full btn-primary">
                        Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="bg-white rounded-lg shadow p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-hijau-100 rounded-lg p-3">
                                <i class="bi bi-geo-alt-fill text-hijau-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600">
                                    Kampus Tegalboto, Jl. Kalimantan No.37<br>
                                    Krajan Timur, Sumbersari, Kec. Sumbersari<br>
                                    Kabupaten Jember, Jawa Timur 68121
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-hijau-100 rounded-lg p-3">
                                <i class="bi bi-telephone-fill text-hijau-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Telepon</h3>
                                <p class="text-gray-600">
                                    +62 822 2974 0385<br>
                                    +62 822 2974 0385 (WhatsApp)
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-hijau-100 rounded-lg p-3">
                                <i class="bi bi-envelope-fill text-hijau-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">
                                    info@lapaktani.com<br>
                                    support@lapaktani.com
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-hijau-100 rounded-lg p-3">
                                <i class="bi bi-clock text-xl text-hijau-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Jam Operasional</h3>
                                <p class="text-gray-600">
                                    Senin - Jumat: 08:00 - 17:00 WIB<br>
                                    Sabtu: 08:00 - 12:00 WIB<br>
                                    Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-lg shadow p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ikuti Kami</h2>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="bi bi-twitter text-xl"></i>
                        </a>

                        <a href="#" class="bg-blue-800 text-white p-3 rounded-lg hover:bg-blue-900 transition duration-200">
                            <i class="bi bi-facebook text-xl"></i>
                        </a>

                        <a href="#" class="bg-pink-600 text-white p-3 rounded-lg hover:bg-pink-700 transition duration-200">
                            <i class="bi bi-instagram text-xl"></i>
                        </a>

                        <a href="#" class="bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="bi bi-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- FAQ Quick Links -->
                <div class="bg-white rounded-lg shadow p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Pertanyaan Umum</h2>
                    
                    <div class="space-y-4">
                        <a href="{{ route('faq') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <h3 class="font-semibold text-gray-900 mb-1">Bagaimana cara menjadi petani di platform ini?</h3>
                            <p class="text-sm text-gray-600">Pelajari langkah-langkah untuk bergabung sebagai petani</p>
                        </a>
                        
                        <a href="{{ route('faq') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <h3 class="font-semibold text-gray-900 mb-1">Bagaimana sistem pembayaran bekerja?</h3>
                            <p class="text-sm text-gray-600">Informasi lengkap tentang metode pembayaran</p>
                        </a>
                        
                        <a href="{{ route('faq') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <h3 class="font-semibold text-gray-900 mb-1">Apakah ada biaya untuk bergabung?</h3>
                            <p class="text-sm text-gray-600">Detail tentang biaya dan layanan gratis</p>
                        </a>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('faq') }}" class="text-hijau-600 hover:text-hijau-700 font-medium">
                            Lihat Semua FAQ →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
            <p class="text-gray-600">Kunjungi kantor kami untuk diskusi lebih lanjut</p>
        </div>
        
        <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.8267!2d113.7168!3d-8.1660!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMDknNTcuNiJTIDExM8KwNDMnMDAuNyJF!5e0!3m2!1sen!2sid!4v1640000000000!5m2!1sen!2sid"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <p class="text-sm text-gray-500 mt-2 text-center">
            Koordinat: 8°09'57.6"S 113°43'00.7"E
        </p>
    </div>
</div>
@endsection
