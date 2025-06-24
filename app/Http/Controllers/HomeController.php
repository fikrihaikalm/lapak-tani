<?php

namespace App\Http\Controllers;

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

    public function products()
    {
        $products = Product::with('user')->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function education()
    {
        $educations = Education::with('user')->latest()->paginate(9);
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
        $product->load(['user', 'category', 'reviews.user']);

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}