<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'title' => 'Category',
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('admin.category.create', [
            'title' => 'Create Category',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:255',
            ], [
                'name.unique' => 'Nama kategori :input sudah digunakan. Silakan gunakan nama lain.',
            ]);

            Category::create($validatedData);

            return redirect('/category')
                ->with('success', 'New category has been added successfully!');
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
            Excel::import(new CategoryImport, $request->file);
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('import_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'title' => 'Edit Category',
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            $category->update($validated);

            return redirect('/category')
                ->with('success', 'Category updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Category $category)
    {
        if ($category->items()->exists()) {
            return redirect()->route('category.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki item');
        }

        try {
            $category->delete();
            return redirect()->route('category.index')
                ->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('category.index')
                ->with('error', 'Gagal menghapus kategori');
        }
    }
}
