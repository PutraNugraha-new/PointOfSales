@extends('admin.layouts.main')


@section('container')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $totalItems }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Barang</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $totalTransactions }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Transaksi</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $totalPurchases }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Pembelian</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $totalSales }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Penjualan</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $activeSuppliers }}</div>
                    <div class="text-sm font-medium text-gray-400">Supplier Aktif</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $outOfStockItems }}</div>
                    <div class="text-sm font-medium text-gray-400">Stok Habis</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1 text-green-500">Rp {{ number_format($income, 2) }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Pendapatan</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1 text-indigo-700">Rp {{ number_format($totalProfit, 2) }}
                    </div>
                    <div class="text-sm font-medium text-gray-400">Total Profit</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1 text-rose-500">Rp {{ number_format($totalExpenses, 2) }}</div>
                    <div class="text-sm font-medium text-gray-400">Total Pengeluaran</div>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Tren Penjualan per Bulan</div>
            </div>
            <div class="overflow-x-auto">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Tren Stok Tiap Barang</div>
            </div>
            <div class="overflow-x-auto">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Total Penjualan',
                    data: @json($totalSaleschart),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Penjualan (IDR)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const ctxstock = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctxstock, {
            type: 'bar', // Anda bisa menggunakan 'bar' atau 'line' sesuai preferensi  
            data: {
                labels: @json($itemNames),
                datasets: [{
                    label: 'Stok',
                    data: @json($itemStocks),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Stok'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Barang'
                        }
                    }
                }
            }
        });
    </script>
@endsection
