<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Item::distinct('category_id')->count();
        $totalTransactions = Transaction::count();
        $totalIncomeTransactions = Transaction::where('type', 'in')->count();
        $totalExpenseTransactions = Transaction::where('type', 'out')->count();
        $totalPurchases = Transaction::where('type', 'in')->sum('quantity');
        $totalSales = Transaction::where('type', 'out')->sum('quantity');

        $totalProfit = Transaction::where('type', 'out')->with('item')->get()->sum(function ($transaction) {
            return ($transaction->item->selling_price - $transaction->item->purchase_price) * $transaction->quantity;
        });

        // Hitung total pengeluaran  
        $totalExpenses = Transaction::where('type', 'in')->with('item')->get()->sum(function ($transaction) {
            return $transaction->item->purchase_price * $transaction->quantity; // Menghitung total nilai pengeluaran  
        });

        $totalStock = Item::sum('stock');
        $outOfStockItems = Item::where('stock', '=', NULL)->count();
        $activeSuppliers = Supplier::count();
        $title = 'Dashboard';

        // Total Pendapatan  
        $income = Transaction::where('type', 'out')
            ->with('item') // Mengambil relasi item  
            ->get()
            ->sum(function ($transaction) {
                return $transaction->quantity * $transaction->item->selling_price; // Menghitung total nilai transaksi  
            });

        // Ambil total penjualan per bulan  
        $salesData = Transaction::select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('SUM(quantity * items.selling_price) as total_sales'))
            ->where('type', 'out')
            ->join('items', 'transactions.item_id', '=', 'items.id')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data untuk chart  
        $months = $salesData->pluck('month');
        $totalSaleschart = $salesData->pluck('total_sales');

        // Ambil data stok untuk setiap item  
        $items = Item::select('id', 'name', 'stock')->get();

        // Format data untuk chart  
        $itemNames = $items->pluck('name');
        $itemStocks = $items->pluck('stock');

        return view('admin.index', compact(
            'totalItems',
            'totalCategories',
            'totalTransactions',
            'totalIncomeTransactions',
            'totalExpenseTransactions',
            'totalPurchases',
            'totalSales',
            'totalProfit',
            'totalExpenses',
            'totalStock',
            'outOfStockItems',
            'activeSuppliers',
            'months',
            'totalSaleschart',
            'income',
            'itemNames',
            'itemStocks',
            'title'

        ));
    }

    public function profile()
    {
        return view('admin.profile.index', [
            'title' => 'Profile',
        ]);
    }
}
