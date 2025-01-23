<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionInController extends Controller
{
    public function index()
    {
        return view('admin.transactionIn.index', [
            'title' => 'Transaction In',
            'transactionIn' => Transaction::where('type', 'in')->get()
        ]);
    }

    public function create()
    {
        return view('admin.transactionIn.create', [
            'title' => 'Transaction In',
            'item' => Item::all(),
            'supplier' => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_id' => 'required|exists:items,id', // Pastikan item_id ada di tabel items  
                'supplier_id' => 'required|exists:suppliers,id', // Pastikan supplier_id ada di tabel suppliers  
                'quantity' => 'required|integer|min:1',
                'date' => 'required|date',
                'note' => 'nullable|string|max:255',
            ]);
            $validatedData['type'] = 'in';
            $validatedData['user_id'] = Auth::id();

            $item = Item::find($validatedData['item_id']);
            $item->stock += $request->quantity; // Tambahkan quantity ke stock  
            $item->save(); // Simpan perubahan  

            Transaction::create($validatedData);

            return redirect('/transactionIn')
                ->with('success', 'New Transaction has been added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function edit(Transaction $transactionIn)
    {
        return view('admin.transactionIn.edit', [
            'title' => 'Edit transactionIn',
            'transaction' => $transactionIn,
            'item' => Item::all(),
            'supplier' => Supplier::all()
        ]);
    }

    public function update(Request $request, Transaction $transactionIn)
    {
        try {
            $validated = $request->validate([
                'item_id' => 'required|exists:items,id', // Pastikan item_id ada di tabel items  
                'supplier_id' => 'required|exists:suppliers,id', // Pastikan supplier_id ada di tabel suppliers  
                'quantity' => 'required|integer|min:1',
                'date' => 'required|date',
                'note' => 'nullable|string|max:255',
            ]);

            $item = Item::find($validated['item_id']);

            // Bandingkan quantity baru dengan quantity lama  
            if ($transactionIn->quantity != $validated['quantity']) {
                // Jika quantity berubah, update stok  
                $item->stock += ($validated['quantity'] - $transactionIn->quantity);
                $item->save(); // Simpan perubahan stok  
            }

            $transactionIn->update($validated);

            return redirect('/transactionIn')
                ->with('success', 'transactionIn updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Transaction $transactionIn)
    {
        try {
            // Ambil item terkait dengan transaksi  
            $item = Item::find($transactionIn->item_id);

            // Kurangi stok item berdasarkan quantity transaksi yang dihapus  
            $item->stock -= $transactionIn->quantity;
            $item->save(); // Simpan perubahan stok  

            // Hapus transaksi  
            $transactionIn->delete();

            return redirect()->route('transactionIn.index')
                ->with('success', 'Item berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('transactionIn.index')
                ->with('error', 'Gagal menghapus Item: ' . $e->getMessage());
        }
    }

    public function getDetail($id)
    {
        $transactionIn = Transaction::with(['item', 'supplier'])->findOrFail($id);
        return response()->json($transactionIn);
    }
}
