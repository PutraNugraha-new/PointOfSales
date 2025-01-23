@extends('admin.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Barang</h2>

                <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Barang -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                            value="{{ old('name', $item->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id', $item->category_id) == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <!-- SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700">Kode SKU</label>
                        <input type="text" name="sku" id="sku" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                            value="{{ old('sku', $item->sku) }}">
                        @error('sku')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700">Satuan</label>
                        <select name="unit" id="unit" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option disabled selected>Pilih Satuan</option>
                            <option value="pcs" @if (old('unit', $item->unit) == 'pcs') selected @endif>Pcs</option>
                            <option value="kg" @if (old('unit', $item->unit) == 'kg') selected @endif>Kg</option>
                            <option value="liter" @if (old('unit', $item->unit) == 'liter') selected @endif>Liter</option>
                            <option value="box" @if (old('unit', $item->unit) == 'box') selected @endif>Box</option>
                            <option value="lusin" @if (old('unit', $item->unit) == 'lusin') selected @endif>Lusin</option>
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <!-- Stock -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stok Saat Ini</label>
                            <input type="number" name="stock" id="stock" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                value="{{ old('stock', $item->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    <span class="text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="min_stock" class="block text-sm font-medium text-gray-700">Stok Minimum</label>
                            <input type="number" name="min_stock" id="min_stock" required min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                value="{{ old('min_stock', $item->min_stock) }}">
                            @error('min_stock')
                                <div class="invalid-feedback">
                                    <span class="text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Purchase Price -->
                    <div>
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700">Harga Beli per
                            Unit</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="purchase_price" id="purchase_price" required min="0"
                                step="0.01"
                                class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                value="{{ old('purchase_price', $item->purchase_price) }}">
                            @error('purchase_price')
                                <div class="invalid-feedback">
                                    <span class="text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Selling Price -->
                    <div>
                        <label for="selling_price" class="block text-sm font-medium text-gray-700">Harga Jual per
                            Unit</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="selling_price" id="selling_price" required min="0"
                                step="0.01"
                                class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                value="{{ old('selling_price', $item->selling_price) }}">
                            @error('selling_price')
                                <div class="invalid-feedback">
                                    <span class="text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="history.back()"
                            class="bg-gray-100 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-amber-500 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
