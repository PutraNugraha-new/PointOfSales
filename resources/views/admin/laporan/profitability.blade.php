@extends('admin.layouts.main')


@section('container')
    @include('admin.feature.alert')
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white border-b-2 border-indigo-600">
        <div class="flex flex-col gap-1 mb-10">
            <h1 class="text-2xl font-bold mb-4">Laporan Profitabilitas</h1>

            <form method="GET" action="{{ route('reports.profitability') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
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
        <div class="mb-6">
            {{-- <h2 class="text-xl font-semibold mb-2">Total Profit: <span
                    class="text-green-600">{{ number_format($totalProfit, 2) }}</span></h2>
            <p>Average Profit Percentage: {{ number_format($averageProfitPercentage, 2) }}%</p> --}}
        </div>
        <table id="dataItem" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority='1'>Item</th>
                    <th data-priority='2'>Purchase Price</th>
                    <th data-priority='3'>Selling Price</th>
                    <th data-priority='4'>Profit Margin</th>
                    <th data-priority='5'>Profit Percentage</th>
                    <th data-priority='6'>Total Selling</th>
                    <th data-priority='7'>Total Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sortedProfitability as $item)
                    <tr>
                        <td>{{ $item['item_name'] }}</td>
                        <td>{{ number_format($item['purchase_price'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['selling_price'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['margin_keuntungan'], 0, ',', '.') }}</td>
                        <td>{{ $item['profit_percentage'] }}%</td>
                        <td>{{ $item['total_quantity'] }}</td>
                        <td>{{ number_format($item['total_profit'], 0, ',', '.') }}</td>
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
