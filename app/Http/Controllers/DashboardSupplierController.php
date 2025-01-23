<?php

namespace App\Http\Controllers;

use App\Imports\SuppliersImport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class DashboardSupplierController extends Controller
{
    public function index()
    {
        return view('admin.supplier.index', [
            'title' => 'Supplier',
            'supplier' => Supplier::all()
        ]);
    }

    public function create()
    {
        return view('admin.supplier.create', [
            'title' => 'Create Supplier',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
                'email' => 'required|string|email|max:100|unique:suppliers,email,' . $request->id, // Email valid dan unik
                'phone' => 'required|string|max:15|regex:/^\+?\d{9,15}$/', // Format nomor telepon yang valid
                'address' => 'required|string|max:255', // Panjang alamat ditingkatkan
            ]);


            Supplier::create($validatedData);

            return redirect('/suppliers')
                ->with('success', 'New Supplier has been added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', [
            'title' => 'Edit supplier',
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:100',
                    Rule::unique('users', 'email')->ignore($request->route('user')),
                ],
                'phone' => 'required|string|max:15|regex:/^\+?\d{9,15}$/', // Format nomor telepon yang valid
                'address' => 'required|string|max:255', // Panjang alamat ditingkatkan
            ]);

            $supplier->update($validated);

            return redirect('/suppliers')
                ->with('success', 'Supplier updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->transactions()->exists()) {
            return redirect()->route('suppliers.index')
                ->with('error', 'supplier tidak dapat dihapus karena masih memiliki transaksi');
        }

        try {
            $supplier->delete();
            return redirect()->route('suppliers.index')
                ->with('success', 'supplier berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')
                ->with('error', 'Gagal menghapus Supplier');
        }
    }

    public function getDetail($id)
    {
        $supplier = Supplier::all()->findOrFail($id);
        return response()->json($supplier);
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new SuppliersImport, $request->file);
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('import_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
