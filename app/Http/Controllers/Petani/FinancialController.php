<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\FinancialRecord;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $period = $request->get('period', 'month');
        
        // Calculate date range
        switch ($period) {
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default: // month
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
        }

        // Get financial records
        $records = FinancialRecord::where('user_id', $user->id)
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->latest('transaction_date')
            ->paginate(15);

        // Calculate totals
        $totalIncome = FinancialRecord::where('user_id', $user->id)
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = FinancialRecord::where('user_id', $user->id)
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->where('type', 'expense')
            ->sum('amount');

        $netProfit = $totalIncome - $totalExpense;

        // Get sales data from orders
        $totalOrders = Order::where('petani_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalSales = Order::where('petani_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $stats = [
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'net_profit' => $netProfit,
            'total_orders' => $totalOrders,
            'total_sales' => $totalSales,
        ];

        return view('petani.financial.index', compact('records', 'stats', 'period', 'startDate', 'endDate'));
    }

    public function create()
    {
        return view('petani.financial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        FinancialRecord::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan keuangan berhasil ditambahkan!',
            'redirect' => route('petani.financial.index')
        ]);
    }

    public function destroy($id)
    {
        $record = FinancialRecord::where('user_id', auth()->id())->findOrFail($id);
        $record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Catatan keuangan berhasil dihapus!'
        ]);
    }
}
