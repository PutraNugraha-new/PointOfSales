    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[50] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Upload File Excel
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="/importUsers" method="POST" class="max-w-lg mx-auto" enctype="multipart/form-data">
                        @csrf
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="user_avatar">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="user_avatar_help" id="user_avatar" name="file" type="file"
                            accept=".xlsx,.xls,.csv">
                        <button type="submit"
                            class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="view-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[50] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800" id="judul-modal">
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 hover:text-gray-500 bg-transparent hover:bg-gray-100 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="view-modal">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="p-4 md:p-5 bg-slate-50">
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Kolom Kiri -->
                        <div class="space-y-4">
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-600">Nama</label>
                                <p id="modal-name" class="mt-1 text-sm font-semibold text-gray-800"></p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-600">Email</label>
                                <p id="modal-email" class="mt-1 text-sm font-semibold text-gray-800"></p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-600">Phone</label>
                                <p id="modal-phone" class="mt-1 text-sm font-semibold text-gray-800"></p>
                            </div>
                        </div>

                        <!-- address -->
                        <div class="space-y-4">
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-600">Address</label>
                                <p id="modal-address" class="mt-1 text-sm font-semibold text-gray-800"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
