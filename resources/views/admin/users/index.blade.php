@extends('admin.layouts.main')


@section('container')
    @include('admin.feature.alert')
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white border-b-2 border-indigo-600">
        <div class="flex gap-1 mb-10">
            <a href="{{ route('users.create') }}"
                class="border-2 bg-amber-400 p-2 text-sm font-bold rounded-lg text-white hover:bg-amber-500 hover:text-white transition duration-300 ease-in-out">New
                Data</a>
            {{-- <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="border-2 border-indigo-500 p-2 text-sm font-bold rounded-lg text-slate-950 hover:bg-indigo-600 hover:text-white transition duration-300 ease-in-out">Import
                Data</button> --}}
        </div>
        <table id="dataItem" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">Nama</th>
                    <th data-priority="2">Email</th>
                    <th data-priority="3">Usertype</th>
                    <th data-priority="3">Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->usertype }}</td>
                        <td>{{ $data->created_at->translatedFormat('F d, Y') }}</td>
                        <td>
                            <div>
                                {{-- <button data-modal-target="view-modal" data-modal-toggle="view-modal"
                                    data-id="{{ $data->id }}"
                                    class="view-btn inline-flex items-center px-1 py-2 text-md font-medium text-slate-600 hover:underline transition-colors duration-200 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    View
                                </button> --}}

                                {{-- <a href="{{ route('suppliers.edit', $data->id) }}"
                                    class="inline-flex items-center px-1 py-2 text-md font-medium text-indigo-600 hover:underline transition-colors duration-200 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a> --}}

                                <form action="{{ route('users.destroy', $data->id) }}" method="POST"
                                    class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center px-1 py-2 text-md font-medium text-red-600 hover:underline transition-colors duration-200 ease-in-out"
                                        onclick="confirmDelete(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('admin.users.feature.modal')
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
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua tombol view
            const viewButtons = document.querySelectorAll('.view-btn');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');

                    // Fetch data dari server
                    fetch(`/users/${itemId}/detail`)
                        .then(response => response.json())
                        .then(data => {
                            // Update konten modal
                            document.getElementById('modal-name').textContent = data.name;
                            document.getElementById('judul-modal').textContent = data.name;
                            document.getElementById('modal-email').textContent = data.email;
                            document.getElementById('modal-phone').textContent = data.phone;
                            document.getElementById('modal-address').textContent = data.address;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
