<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Education;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::where('user_id', auth()->id())->count();
        $totalEducations = Education::where('user_id', auth()->id())->count();
        
        $recentProducts = Product::where('user_id', auth()->id())->latest()->take(5)->get();
        $recentEducations = Education::where('user_id', auth()->id())->latest()->take(5)->get();

        return view('petani.dashboard', compact(
            'totalProducts',
            'totalEducations',
            'recentProducts',
            'recentEducations'
        ));
    }
}