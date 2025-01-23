@extends('admin.layouts.main')


@section('container')
    @include('admin.feature.alert')
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white border-b-2 border-indigo-600">
        <div class="flex gap-1 mb-10">
            <form method="GET" action="{{ route('reports.transactions') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label for="period" class="block text-sm font-medium text-gray-700">Periode:</label>
                    <select name="period" id="period" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal:</label>
                    <input type="date" name="date" id="date" value="{{ $date }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe Transaksi:</label>
                    <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="" {{ is_null($type) ? 'selected' : '' }}>Semua</option>
                        <option value="in" {{ $type == 'in' ? 'selected' : '' }}>Masuk</option>
                        <option value="out" {{ $type == 'out' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Filter</button>
                </div>
            </form>
        </div>
        <table id="dataItem" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">ID</th>
                    <th data-priority="2">User ID</th>
                    <th data-priority="3">Item ID</th>
                    <th data-priority="4">Supplier ID</th>
                    <th data-priority="5">Type</th>
                    <th data-priority="6">Quantity</th>
                    <th data-priority="7">Date</th>
                    <th data-priority="8">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->item->name }}</td>
                        <td>{{ $transaction->supplier->name ?? 'Tidak ada Supplier' }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.supplier.feature.modal')
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Hancurkan instance DataTable jika sudah ada
            if ($.fn.DataTable.isDataTable('#dataItem')) {
                $('#dataItem').DataTable().destroy();
            }

            // Inisialisasi ulang DataTable
            $('#dataItem').DataTable({
                responsive: true,
                destroy: true, // Tambahkan ini untuk memastikan destroy berjalan
            }).columns.adjust().responsive.recalc();
        });
    </script>
@endsection
