<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;

class TransactionReportController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan parameter filter dari request  
        $period = $request->get('period', 'daily'); // default ke harian  
        $date = $request->get('date', Carbon::today()->toDateString());
        $type = $request->get('type', null);

        // Query dasar  
        $query = Transaction::query();

        // Filter berdasarkan periode  
        switch ($period) {
            case 'daily':
                $query->whereDate('date', $date);
                break;
            case 'weekly':
                $query->whereBetween('date', [Carbon::parse($date)->startOfWeek(), Carbon::parse($date)->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('date', Carbon::parse($date)->month)
                    ->whereYear('date', Carbon::parse($date)->year);
                break;
        }

        // Filter berdasarkan tipe transaksi jika ada  
        if ($type) {
            $query->where('type', $type);
        }

        // Dapatkan hasil query  
        $transactions = $query->get();

        // Kirim data ke view  
        return view('admin.laporan.index', compact('transactions', 'period', 'date', 'type'));
    }

    public function incomeExpense(Request $request)
    {
        $dateFrom = $request->input('date_from', Carbon::now()->startOfMonth()->toDateString());
        $dateTo = $request->input('date_to', Carbon::now()->endOfMonth()->toDateString());

        // Total Pengeluaran  
        $expense = Transaction::where('type', 'in')
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->with('item') // Mengambil relasi item  
            ->get()
            ->sum(function ($transaction) {
                return $transaction->quantity * $transaction->item->purchase_price; // Menghitung total nilai transaksi  
            });

        // Total Pendapatan  
        $income = Transaction::where('type', 'out')
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->with('item') // Mengambil relasi item  
            ->get()
            ->sum(function ($transaction) {
                return $transaction->quantity * $transaction->item->selling_price; // Menghitung total nilai transaksi  
            });

        return view('admin.laporan.income-expense', compact('income', 'expense', 'dateFrom', 'dateTo'));
    }

    public function profitability(Request $request)
    {
        // Mengatur tanggal default jika tidak ada input  
        $dateFrom = $request->input('date_from', Carbon::now()->startOfMonth()->toDateString());
        $dateTo = $request->input('date_to', Carbon::now()->endOfMonth()->toDateString());

        // Ambil semua transaksi dengan tipe 'out' dalam rentang tanggal  
        $transactions = Transaction::where('type', 'out') // Hanya transaksi dengan tipe 'out'
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->with('item') // Mengambil relasi item  
            ->get();

        // Kelompokkan transaksi berdasarkan item
        $groupedByItem = $transactions->groupBy('item_id');

        // Hitung profitabilitas per item
        $profitability = $groupedByItem->map(function ($group, $itemId) {
            $item = $group->first()->item;

            // Validasi jika item tidak ditemukan
            if (!$item) {
                return [
                    'item_name' => 'Unknown Item',
                    'purchase_price' => 0,
                    'selling_price' => 0,
                    'margin_keuntungan' => 0,
                    'profit_percentage' => 0,
                    'total_quantity' => 0,
                    'total_profit' => 0,
                ];
            }

            // Hitung data profitabilitas
            $totalQuantity = $group->sum('quantity');
            $marginKeuntungan = $item->selling_price - $item->purchase_price;
            $profitPercentage = $item->purchase_price > 0
                ? ($marginKeuntungan / $item->purchase_price) * 100
                : 0;
            $totalProfit = $marginKeuntungan * $totalQuantity;

            return [
                'item_name' => $item->name,
                'purchase_price' => $item->purchase_price,
                'selling_price' => $item->selling_price,
                'margin_keuntungan' => $marginKeuntungan,
                'profit_percentage' => round($profitPercentage, 2), // Dibulatkan ke 2 desimal
                'total_quantity' => $totalQuantity,
                'total_profit' => $totalProfit,
            ];
        });

        // Sortir berdasarkan total profit (descending)
        $sortedProfitability = $profitability->sortByDesc('total_profit');

        // Total profitabilitas seluruh item
        $totalProfitabilitas = $sortedProfitability->sum('total_profit');

        return view('admin.laporan.profitability', compact(
            'sortedProfitability',
            'totalProfitabilitas',
            'dateFrom',
            'dateTo'
        ));
    }
}
