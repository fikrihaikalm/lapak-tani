<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Education;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->latest()->take(6)->get();
        $educations = Education::with('user')->latest()->take(3)->get();

        return view('home', compact('products', 'educations'));
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

    public function educationShow($id)
    {
        $education = Education::with('user')->findOrFail($id);
        return view('education.show', compact('education'));
    }
}