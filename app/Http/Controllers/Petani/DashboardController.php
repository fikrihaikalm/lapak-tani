<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Education;
use App\Models\Order;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Calculate stats
        $stats = [
            'total_products' => Product::where('user_id', $user->id)->count(),
            'total_educations' => Education::where('user_id', $user->id)->count(),
            'total_orders' => Order::where('petani_id', $user->id)->count(),
            'monthly_income' => $this->getFormattedMonthlyIncome($user->id),
        ];

        $recentProducts = Product::where('user_id', $user->id)->latest()->take(5)->get();
        $recentEducations = Education::where('user_id', $user->id)->latest()->take(5)->get();

        return view('petani.dashboard', compact(
            'stats',
            'recentProducts',
            'recentEducations'
        ));
    }

    private function getFormattedMonthlyIncome($userId)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Calculate income from delivered orders this month
        $income = Order::where('petani_id', $userId)
            ->where('status', 'delivered')
            ->whereBetween('delivered_at', [$startOfMonth, $endOfMonth])
            ->sum('total_amount');

        return 'Rp ' . number_format($income, 0, ',', '.');
    }
}