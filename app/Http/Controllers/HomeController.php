<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Education;
use App\Models\User;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->latest()->take(6)->get();
        $educations = Education::with('user')->latest()->take(3)->get();

        // Calculate stats
        $stats = [
            'total_petani' => User::where('user_type', 'petani')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::where('status', 'delivered')->count(),
            'total_educations' => Education::count(),
        ];

        return view('home', compact('products', 'educations', 'stats'));
    }

    public function products(Request $request)
    {
        $query = Product::with(['user', 'category']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('total_sold', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = \App\Models\ProductCategory::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function education(Request $request)
    {
        $query = Education::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'featured':
                $query->where('is_featured', true)->latest();
                break;
            default:
                $query->latest();
                break;
        }

        $educations = $query->paginate(9)->withQueryString();

        return view('education.index', compact('educations'));
    }

    public function educationShow(Education $education)
    {
        $education->load('user');
        $education->increment('views_count');

        $relatedEducations = Education::where('id', '!=', $education->id)
            ->where('user_id', $education->user_id)
            ->take(3)
            ->get();

        return view('education.show', compact('education', 'relatedEducations'));
    }

    public function productShow(Product $product)
    {
        $product->load(['user', 'category']);

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}