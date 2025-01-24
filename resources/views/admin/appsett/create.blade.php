@extends('admin.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Pengaturan Baru</h2>

                <form action="{{ route('appSett.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Setting Key -->
                    <div>
                        <label for="setting_key" class="block text-sm font-medium text-gray-700">Setting Key</label>
                        <input type="text" name="setting_key" id="setting_key" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        @error('setting_key')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Setting Value -->
                    <div>
                        <label for="setting_value" class="block text-sm font-medium text-gray-700">Setting Value</label>
                        <textarea name="setting_value" required id="setting_value" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                        @error('setting_value')
                            <div class="invalid-feedback">
                                <span class="text-red-500">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Data Type -->
                    <div>
                        <label for="data_type" class="block text-sm font-medium text-gray-700">Data Type</label>
                        <select name="data_type" id="data_type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="">Pilih Tipe Data</option>
                            <option value="string">String</option>
                            <option value="integer">integer</option>
                            <option value="boolean">boolean</option>
                            <option value="float">float</option>
                        </select>
                        @error('data_type')
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
