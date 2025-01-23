@extends('admin.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Transaksi</h2>

                <form action="{{ route('transactionIn.update', $transaction->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Item -->
                    <div>
                        <label for="item_id" class="block text-sm font-medium text-gray-700">Item</label>
                        <select name="item_id" id="item_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 js-example-basic-single"
                            style="width: 100%">
                            @foreach ($item as $item)
                                <option value="{{ $item->id }}" @if (old('item_id', $transaction->item_id) == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Nama Supplier -->
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 js-example-basic-single"
                            style="width: 100%">
                            @foreach ($supplier as $supplier)
                                <option value="{{ $supplier->id }}" @if (old('supplier_id', $transaction->supplier_id) == $supplier->id) selected @endif>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Kuantitas -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Kuantitas</label>
                        <input type="number" name="quantity" id="quantity" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                            value="{{ old('quantity', $transaction->quantity) }}">
                        @error('quantity')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="date" id="date" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                            value="{{ old('date', $transaction->date) }}">
                        @error('date')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- note --}}
                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="note" id="note" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('note', $transaction->note) }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
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
