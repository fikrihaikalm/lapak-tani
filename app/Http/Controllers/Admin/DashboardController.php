<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Education;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPetani = User::where('role', 'petani')->count();
        $totalProducts = Product::count();
        $totalEducations = Education::count();
        
        $recentProducts = Product::with('user')->latest()->take(5)->get();
        $recentEducations = Education::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPetani',
            'totalProducts', 
            'totalEducations',
            'recentProducts',
            'recentEducations'
        ));
    }
}