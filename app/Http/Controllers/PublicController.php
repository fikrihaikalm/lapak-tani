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

        return view('public.about', compact('stats'));
    }

    public function howItWorks()
    {
        return view('public.how-it-works');
    }

    public function testimonials()
    {
        // Get some successful petani with their stats
        $successfulPetani = User::where('user_type', 'petani')
            ->withCount(['products', 'orders as total_sales'])
            ->having('products_count', '>', 0)
            ->orderBy('total_sales', 'desc')
            ->take(6)
            ->get();

        // Get some happy customers (konsumen with completed orders)
        $happyCustomers = User::where('user_type', 'konsumen')
            ->whereHas('orders', function($query) {
                $query->where('status', 'delivered');
            })
            ->withCount(['orders as completed_orders' => function($query) {
                $query->where('status', 'delivered');
            }])
            ->orderBy('completed_orders', 'desc')
            ->take(6)
            ->get();

        return view('public.testimonials', compact('successfulPetani', 'happyCustomers'));
    }

    public function contact()
    {
        return view('public.contact');
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

        return view('public.faq', compact('faqs'));
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function blog(Request $request)
    {
        // Get featured post
        $featuredPost = Education::with(['user', 'category'])
            ->where('is_featured', true)
            ->latest()
            ->first();

        // Get all posts (excluding featured)
        $postsQuery = Education::with(['user', 'category'])
            ->when($featuredPost, function($query) use ($featuredPost) {
                return $query->where('id', '!=', $featuredPost->id);
            })
            ->when($request->category, function($query) use ($request) {
                return $query->where('category_id', $request->category);
            });

        $posts = $postsQuery->latest()->paginate(12);

        $categories = EducationCategory::withCount('educations')
            ->having('educations_count', '>', 0)
            ->get();

        return view('public.blog', compact('posts', 'categories', 'featuredPost'));
    }

    public function blogPost($id)
    {
        $post = Education::with(['user', 'category'])->findOrFail($id);
        
        // Increment views
        $post->increment('views_count');

        // Get related posts
        $relatedPosts = Education::where('id', '!=', $id)
            ->where('category_id', $post->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.blog-post', compact('post', 'relatedPosts'));
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
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
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

        return view('public.petani-directory', compact('petani'));
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
