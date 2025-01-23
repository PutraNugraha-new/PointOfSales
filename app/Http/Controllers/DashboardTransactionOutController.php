<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionOutController extends Controller
{
    public function index()
    {
        return view('admin.transactionOut.index', [
            'title' => 'Transaction Out',
            'transactionOut' => Transaction::where('type', 'out')->get()
        ]);
    }

    public function create()
    {
        return view('admin.transactionOut.create', [
            'title' => 'Transaction Out',
            'item' => Item::all(),
            'supplier' => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_id' => 'required|exists:items,id', // Pastikan item_id ada di tabel items   
                'quantity' => 'required|integer|min:1',
                'date' => 'required|date',
                'note' => 'nullable|string|max:255',
            ]);
            $validatedData['type'] = 'out';
            $validatedData['user_id'] = Auth::id();

            $item = Item::find($validatedData['item_id']);
            $item->stock -= $request->quantity; // Tambahkan quantity ke stock  
            $item->save(); // Simpan perubahan  

            Transaction::create($validatedData);

            return redirect('/transactionOut')
                ->with('success', 'New Transaction has been added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function edit(Transaction $transactionOut)
    {
        return view('admin.transactionOut.edit', [
            'title' => 'Edit transactionOut',
            'transaction' => $transactionOut,
            'item' => Item::all(),
            'supplier' => Supplier::all()
        ]);
    }

    public function update(Request $request, Transaction $transactionOut)
    {
        try {
            $validated = $request->validate([
                'item_id' => 'required|exists:items,id', // Pastikan item_id ada di tabel items  
                'quantity' => 'required|integer|min:1',
                'date' => 'required|date',
                'note' => 'nullable|string|max:255',
            ]);

            $item = Item::find($validated['item_id']);

            // Bandingkan quantity baru dengan quantity lama  
            if ($transactionOut->quantity != $validated['quantity']) {
                // Jika quantity berubah, update stok  
                $item->stock -= ($validated['quantity'] - $transactionOut->quantity);
                $item->save(); // Simpan perubahan stok  
            }

            $transactionOut->update($validated);

            return redirect('/transactionOut')
                ->with('success', 'transactionOut updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Transaction $transactionOut)
    {
        try {
            // Ambil item terkait dengan transaksi  
            $item = Item::find($transactionOut->item_id);

            // Kurangi stok item berdasarkan quantity transaksi yang dihapus  
            $item->stock += $transactionOut->quantity;
            $item->save(); // Simpan perubahan stok  

            // Hapus transaksi  
            $transactionOut->delete();

            return redirect()->route('transactionOut.index')
                ->with('success', 'Item berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('transactionOut.index')
                ->with('error', 'Gagal menghapus Item: ' . $e->getMessage());
        }
    }

    public function getDetail($id)
    {
        $transactionOut = Transaction::with(['item', 'supplier'])->findOrFail($id);
        return response()->json($transactionOut);
    }
}
