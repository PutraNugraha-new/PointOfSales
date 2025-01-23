@extends('admin.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Data Supplier</h2>

                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Supplier -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        @error('name')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Supplier</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $supplier->email) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        @error('email')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Supplier</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $supplier->phone) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        @error('phone')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address Supplier</label>
                        <textarea name="address" id="address" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('address', $supplier->address) }}</textarea>
                        @error('address')
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
