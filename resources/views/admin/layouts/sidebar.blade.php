<div
    class="fixed left-0 top-0 w-64 h-full border-r overflow-y-auto border-grey-300 bg-slate-950 md:bg-white p-4 z-40 sidebar-menu transition-transform">
    <a href="/" class="flex items-center pb-4 justify-center">
        {{-- <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover"> --}}
        {{-- <img src="{{ asset('image/putra.png') }}" alt="" class="w-8 h-8 rounded object-cover"> --}}
        <i class="ri-store-3-line"></i>
        <span class="text-lg font-bold text-white md:text-indigo-950 ml-3 text-center">POS</span>
    </a>
    <ul class="mt-4">
        <span class="text-sm text-slate-400 tracking-wider">
            MAIN MENU
        </span>
        <li class="mb-1 group {{ Request::is('/') ? 'active' : '' }}">
            <a href="/"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="#"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-settings-2-line mr-3 text-lg"></i>
                <span class="text-sm">Application Settings</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-user-settings-line mr-3 text-lg"></i>
                <span class="text-sm">User Manajemen</span>
            </a>
        </li>
        {{-- <li class="mb-1 group {{ Request::is('dashboard/reports') ? 'active' : '' }}">
            <a href="#"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-error-warning-line mr-3 text-lg"></i>
                <span class="text-sm">Bantuan</span>
            </a>
        </li> --}}
        <span class="text-sm text-slate-400 tracking-wider">
            DATA MASTER
        </span>
        <li class="mb-1 group {{ Request::is('pelanggan*') ? 'active' : '' }}">
            <a href="/users"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-user-2-line mr-3 text-lg"></i>
                <span class="text-sm">Pelanggan</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is('suppliers*') ? 'active' : '' }}">
            <a href="{{ route('suppliers.index') }}"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-user-5-line mr-3 text-lg"></i>
                <span class="text-sm">Supplier</span>
            </a>
        </li>
        <li x-data="{ open: false }"
            class="mb-1 group {{ Request::is('items*') || Request::is('category*') ? 'active' : '' }}">
            <div class="flex flex-col">
                <!-- Menu Utama -->
                <button @click="open = !open"
                    class="flex items-center justify-between w-full py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white focus:outline-none">
                    <div class="flex items-center">
                        <i class="ri-archive-line mr-3 text-lg"></i>
                        <span class="text-sm">Master Barang</span>
                    </div>
                    <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"
                        class="text-gray-400 hover:text-gray-600"></i>
                </button>

                <!-- Submenu -->
                <ul x-show="open" x-transition.origin.top.duration.300ms
                    class="mt-1 pl-1 py-1 rounded-md bg-gray-100 border border-gray-200 divide-y divide-gray-200">
                    <li>
                        <a href="{{ route('items.index') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 rounded-md hover:text-blue-500 hover:bg-gray-50">
                            Data Barang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 rounded-md hover:text-blue-500 hover:bg-gray-50">
                            Kategori Barang
                        </a>
                    </li>
                </ul>

            </div>
        </li>
        <span class="text-sm text-slate-400 tracking-wider">
            TRANSAKSI
        </span>
        <li class="mb-1 group {{ Request::is('transactionIn*') ? 'active' : '' }}">
            <a href="{{ route('transactionIn.index') }}"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-login-box-line mr-3 text-lg"></i>
                <span class="text-sm">Barang Masuk</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is('transactionOut*') ? 'active' : '' }}">
            <a href="{{ route('transactionOut.index') }}"
                class="flex items-center py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-logout-box-line mr-3 text-lg"></i>
                <span class="text-sm">Barang Keluar</span>
            </a>
        </li>
        <span class="text-sm text-slate-400 tracking-wider">
            LAINNYA
        </span>
        <li x-data="{ open: false }"
            class="mb-1 group {{ Request::is('transactions*') || Request::is('reports/income-expense*') || Request::is('reports/profitability*') ? 'active' : '' }}">
            <div class="flex flex-col">
                <!-- Menu Utama -->
                <button @click="open = !open"
                    class="flex items-center justify-between w-full py-2 px-4 text-slate-400 md:text-indigo-950 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white focus:outline-none">
                    <div class="flex items-center">
                        <i class="ri-archive-line mr-3 text-lg"></i>
                        <span class="text-sm">Laporan</span>
                    </div>
                    <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"
                        class="text-gray-400 hover:text-gray-600"></i>
                </button>

                <!-- Submenu -->
                <ul x-show="open" x-transition.origin.top.duration.300ms
                    class="mt-1 pl-1 py-1 rounded-md bg-gray-100 border border-gray-200 divide-y divide-gray-200">
                    <li>
                        <a href="{{ route('reports.transactions') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 rounded-md hover:text-blue-500 hover:bg-gray-50">
                            Laporan Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.income-expense') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 rounded-md hover:text-blue-500 hover:bg-gray-50">
                            Laporan Pendapatan dan Pengeluaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.profitability') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 rounded-md hover:text-blue-500 hover:bg-gray-50">
                            Laporan Profitabilitas
                        </a>
                    </li>
                </ul>

            </div>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
