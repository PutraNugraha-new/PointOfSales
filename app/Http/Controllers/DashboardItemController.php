<?php

namespace App\Http\Controllers;

use App\Imports\ItemsImport;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardItemController extends Controller
{
    public function index()
    {
        return view('admin.item.index', [
            'title' => 'Item',
            'item' => Item::all()
        ]);
    }

    public function create()
    {
        return view('admin.item.create', [
            'title' => 'Create Item',
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100', // Maksimal 100 karakter
                'category_id' => 'required|exists:categories,id', // Pastikan category_id valid di tabel categories
                'sku' => 'required|string|unique:items,sku', // SKU harus unik di tabel products
                'description' => 'nullable|string|max:255', // Maksimal 255 karakter jika diisi
                'unit' => 'required|string|max:50', // Maksimal 50 karakter
                'stock' => 'integer|min:0', // Harus angka bulat positif
                'min_stock' => 'required|integer|min:0', // Harus angka bulat positif
                'purchase_price' => 'required|numeric|min:0', // Harga harus angka positif
                'selling_price' => 'required|numeric|min:0', // Harga harus angka positif
            ]);

            Item::create($validatedData);

            return redirect('/items')
                ->with('success', 'New Item has been added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new ItemsImport, $request->file);
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('import_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Item $item)
    {
        return view('admin.item.edit', [
            'title' => 'Edit item',
            'item' => $item,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Item $item)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100', // Maksimal 100 karakter
                'category_id' => 'required|exists:categories,id', // Pastikan category_id valid di tabel categories
                'sku' => 'required|string|unique:items,sku,' . $item->id, // SKU unik, kecuali untuk item ini
                'description' => 'nullable|string|max:255', // Maksimal 255 karakter jika diisi
                'unit' => 'required|string|max:50', // Maksimal 50 karakter
                'stock' => 'integer|min:0', // Harus angka bulat positif
                'min_stock' => 'required|integer|min:0', // Harus angka bulat positif
                'purchase_price' => 'required|numeric|min:0', // Harga harus angka positif
                'selling_price' => 'required|numeric|min:0', // Harga harus angka positif
            ]);

            $item->update($validated);

            return redirect('/items')
                ->with('success', 'Item updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Item $item)
    {
        if ($item->transactions()->exists()) {
            return redirect()->route('item.index')
                ->with('error', 'Item tidak dapat dihapus karena masih memiliki transaksi');
        }

        try {
            $item->delete();
            return redirect()->route('items.index')
                ->with('success', 'Item berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('items.index')
                ->with('error', 'Gagal menghapus Item');
        }
    }

    public function getDetail($id)
    {
        $item = Item::with('category')->findOrFail($id);
        return response()->json($item);
    }
}
