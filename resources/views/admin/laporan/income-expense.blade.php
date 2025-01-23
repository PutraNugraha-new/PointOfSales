@extends('admin.layouts.main')


@section('container')
    @include('admin.feature.alert')
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white border-b-2 border-indigo-600">
        <div class="mb-10">
            <h1 class="text-2xl font-bold mb-4">Laporan Pendapatan dan Pengeluaran</h1>

            <form method="GET" action="{{ route('reports.income-expense') }}"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">Tanggal Dari:</label>
                    <input type="date" name="date_from" id="date_from" value="{{ $dateFrom }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700">Tanggal Sampai:</label>
                    <input type="date" name="date_to" id="date_to" value="{{ $dateTo }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Filter</button>
                </div>
            </form>
        </div>
        <div class="bg-white p-4 rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-2">Total Pendapatan: <span
                    class="text-green-600">{{ number_format($income, 2) }}</span></h2>
            <h2 class="text-xl font-semibold mb-2">Total Pengeluaran: <span
                    class="text-red-600">{{ number_format($expense, 2) }}</span></h2>
            <h2 class="text-xl font-semibold mb-2">Selisih:
                <span class="{{ $income - $expense < 0 ? 'text-red-600' : 'text-blue-600' }}">
                    {{ number_format($income - $expense, 2) }}
                </span>
            </h2>
        </div>
    </div>
    @include('admin.supplier.feature.modal')
@endsection
