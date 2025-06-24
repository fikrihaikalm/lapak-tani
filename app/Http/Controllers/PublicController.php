<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Education;
use App\Models\EducationCategory;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about()
    {
        $stats = [
            'total_petani' => User::where('user_type', 'petani')->count(),
            'total_konsumen' => User::where('user_type', 'konsumen')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::where('status', 'delivered')->count(),
        ];

        return view('public-pages.about', compact('stats'));
    }

    public function howItWorks()
    {
        return view('public-pages.how-it-works');
    }

    public function testimonials()
    {
        // Static testimonials data
        $testimonials = [
            [
                'name' => 'Pak Budi Santoso',
                'role' => 'Petani Organik',
                'location' => 'Malang, Jawa Timur',
                'message' => 'Lapak Tani membantu saya menjual hasil panen langsung ke konsumen. Sekarang pendapatan saya meningkat 40% dibanding jual ke tengkulak.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=10b981&color=fff'
            ],
            [
                'name' => 'Ibu Sari Dewi',
                'role' => 'Konsumen',
                'location' => 'Surabaya, Jawa Timur',
                'message' => 'Sayuran yang saya beli di Lapak Tani selalu segar dan berkualitas. Harganya juga lebih murah karena langsung dari petani.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Sari+Dewi&background=3b82f6&color=fff'
            ],
            [
                'name' => 'Pak Ahmad Wijaya',
                'role' => 'Petani Sayuran',
                'location' => 'Banyuwangi, Jawa Timur',
                'message' => 'Platform ini sangat membantu petani kecil seperti saya. Fitur edukasi pertaniannya juga sangat bermanfaat untuk meningkatkan hasil panen.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Wijaya&background=f59e0b&color=fff'
            ],
            [
                'name' => 'Ibu Rina Kusuma',
                'role' => 'Konsumen',
                'location' => 'Kediri, Jawa Timur',
                'message' => 'Berbelanja di Lapak Tani memberikan kepuasan tersendiri karena saya tahu produk yang dibeli langsung membantu petani lokal.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Rina+Kusuma&background=8b5cf6&color=fff'
            ],
            [
                'name' => 'Pak Joko Susilo',
                'role' => 'Petani Buah',
                'location' => 'Probolinggo, Jawa Timur',
                'message' => 'Sejak bergabung dengan Lapak Tani, saya tidak perlu lagi khawatir mencari pembeli. Konsumen langsung datang ke produk saya.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Joko+Susilo&background=ef4444&color=fff'
            ],
            [
                'name' => 'Ibu Maya Sari',
                'role' => 'Konsumen',
                'location' => 'Jember, Jawa Timur',
                'message' => 'Kualitas produk organik di Lapak Tani sangat baik. Anak-anak saya jadi lebih suka makan sayur karena rasanya yang segar.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Maya+Sari&background=06b6d4&color=fff'
            ]
        ];

        return view('public-pages.testimonials', compact('testimonials'));
    }

    public function terms()
    {
        return view('public-pages.terms');
    }

    public function privacy()
    {
        return view('public-pages.privacy');
    }

    public function help()
    {
        return view('public-pages.help');
    }

    public function contact()
    {
        return view('public-pages.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Here you would typically send an email or save to database
        // For now, we'll just return a success response
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.'
        ]);
    }

    public function faq()
    {
        $faqs = [
            [
                'question' => 'Apa itu Lapak Tani?',
                'answer' => 'Lapak Tani adalah platform digital yang menghubungkan petani lokal dengan konsumen, serta menyediakan konten edukasi pertanian untuk menginspirasi generasi muda.'
            ],
            [
                'question' => 'Bagaimana cara menjadi petani di platform ini?',
                'answer' => 'Anda dapat mendaftar sebagai petani dengan memilih "Petani" saat registrasi. Setelah itu, Anda dapat mulai mengunggah produk dan konten edukasi.'
            ],
            [
                'question' => 'Apakah ada biaya untuk bergabung?',
                'answer' => 'Tidak, bergabung di Lapak Tani sepenuhnya gratis untuk petani maupun konsumen.'
            ],
            [
                'question' => 'Bagaimana sistem pembayaran bekerja?',
                'answer' => 'Kami menyediakan berbagai metode pembayaran yang aman melalui gateway pembayaran terpercaya, termasuk transfer bank, e-wallet, dan QRIS.'
            ],
            [
                'question' => 'Apakah produk dijamin segar?',
                'answer' => 'Kami bekerja sama dengan petani lokal yang berkomitmen menyediakan produk segar berkualitas. Setiap petani memiliki rating dan review dari konsumen.'
            ],
            [
                'question' => 'Bagaimana cara melacak pesanan?',
                'answer' => 'Setelah melakukan pemesanan, Anda dapat melacak status pesanan melalui dashboard konsumen di akun Anda.'
            ],
        ];

        return view('public-pages.faq', compact('faqs'));
    }



    public function petaniDirectory(Request $request)
    {
        $query = User::where('user_type', 'petani')
            ->withCount(['products', 'followers'])
            ->with(['products' => function($q) {
                $q->take(3);
            }]);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('farm_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('bio', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', "%{$request->location}%");
        }

        // Sorting
        switch ($request->sort) {
            case 'products':
                $query->orderBy('products_count', 'desc');
                break;
            case 'followers':
                $query->orderBy('followers_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $petani = $query->paginate(12)->withQueryString();

        return view('public-pages.petani-directory', compact('petani'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all');

        $results = [];

        if ($type === 'all' || $type === 'products') {
            $products = Product::with('user')
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->take(10)
                ->get();
            $results['products'] = $products;
        }

        if ($type === 'all' || $type === 'education') {
            $educations = Education::with('user')
                ->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->take(10)
                ->get();
            $results['educations'] = $educations;
        }

        if ($type === 'all' || $type === 'petani') {
            $petani = User::where('user_type', 'petani')
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('farm_name', 'like', "%{$query}%");
                })
                ->take(10)
                ->get();
            $results['petani'] = $petani;
        }

        return view('public.search-results', compact('results', 'query', 'type'));
    }
}
