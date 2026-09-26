<x-admin-layout>
    <!-- Wrapper Utama (Fit Layar & Scroll Intern untuk Tabel) -->
    <div x-data="{ openDeleteModal: false, deleteUrl: '', facilitieName: '' }" class="p-6 space-y-4 flex flex-col h-full overflow-hidden">

        <!-- Header Halaman & Form Pencarian + Tombol Tambah -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Facility Information Management</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Manage the facilities and infrastructure available at
                    the school.</p>
            </div>

            <div class="flex items-center gap-3">
                <!-- Form Pencarian -->
                <form action="{{ route('facilities.index') }}" method="get" class="relative flex-1 md:w-64">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Search facility name, location..."
                        class="w-full text-xs pl-9 pr-8 py-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400">

                    <!-- Icon Search -->
                    <x-search-icon class="size-4 absolute left-3 top-2.5 text-gray-400" />

                    <!-- Tombol Reset Search (Muncul jika ada keyword) -->
                    @if (request('search'))
                        <a href="{{ route('facilities.index') }}"
                            class="absolute right-2.5 top-2.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                            title="Clear search">
                            <x-clear-icon class="size-4" />
                        </a>
                    @endif
                </form>

                <!-- Tomboh tambah facilitie -->
                <a href="{{ route('facilities.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    <x-plus-icon class="size-4" />
                    Add Facility
                </a>
            </div>
        </div>

        <!-- Card Container Tabel -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col flex-1 min-h-0 overflow-hidden">

            <!-- Table Area (Overflow-x auto untuk responsif di layar kecil) -->
            <div class="overflow-x-auto overflow-y-auto flex-1 custom-scrollbar">
                <table class="w-full text-left text-xs border-collapse">

                    <!-- Table Header -->
                    <thead
                        class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold sticky top-0 border-b border-gray-100 dark:border-gray-700 z-10">
                        <tr>
                            <th class="py-3.5 px-4 w-16 text-center">No</th>
                            <th class="py-3.5 px-4">Gallery Photo</th>
                            <th class="py-3.5 px-4">Facility Name</th>
                            <th class="py-3.5 px-4">Location</th>
                            <th class="py-3.5 px-4 max-w-xs">Description</th>
                            <th class="py-3.5 px-4 text-center w-28">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 text-gray-700 dark:text-gray-200">
                        @forelse ($facilities as $facility)
                            <!-- Baris facilitie -->
                            <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center -space-x-2 overflow-hidden">
                                        @forelse ($facility->photos->take(3) as $photo)
                                            <img src="{{ asset('storage/' . $photo->photos) }}"
                                                class="inline-block size-9 rounded-lg object-cover ring-2 ring-white dark:ring-gray-800">
                                        @empty
                                            <span class="text-gray-400 text-[11px] italic">Without a Photo</span>
                                        @endforelse
                                        @if ($facility->photos->count() > 3)
                                            <span
                                                class="flex items-center justify-center size-9 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-bold ring-2 ring-white dark:ring-gray-800">
                                                +{{ $facility->photos->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-bold text-gray-900 dark:text-white">
                                    {{ $facility->name }}</td>
                                <td class="py-3 px-4 font-medium text-gray-500 dark:text-gray-400">
                                    {{ $facility->location }}</td>
                                <td class="py-3 px-4 text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                    {{ Str::limit($facility->description, 60) }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('facilities.edit', $facility->id) }}"
                                            class="p-1.5 rounded-lg text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition"
                                            title="Edit Fasilitas">
                                            <x-edit-icon class="size-4" />
                                        </a>
                                        <button type="button"
                                            @click="openDeleteModal = true; deleteUrl = '{{ route('facilities.destroy', $facility->id) }}'; facilityName = '{{ addslashes($facility->name) }}'"
                                            class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 transition"
                                            title="Hapus Fasilitas">
                                            <x-trash-icon class="size-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-400">
                                    @if (request('search'))
                                        No facility data matches the search "<span
                                            class="font-semibold">{{ request('search') }}</span>".
                                    @else
                                        There is no facility data yet.
                                    @endif
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div
                class="px-4 py-3 bg-gray-50/50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400 flex items-center justify-between shrink-0">

                <!-- Informasi Jumlah Data -->
                <div>
                    Show <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $facilities->firstItem() ?? 0 }}</span>
                    - <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $facilities->lastItem() ?? 0 }}</span>
                    from <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $facilities->total() }}</span> facilities
                </div>

                <!-- Tombol Navigasi Halaman -->
                <div class="flex items-center gap-1">
                    <!-- Tombol Sebelumnya -->
                    @if ($facilities->onFirstPage())
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Prev
                        </span>
                    @else
                        <a href="{{ $facilities->previousPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Prev
                        </a>
                    @endif

                    <!-- Nomor Halaman -->
                    @foreach ($facilities->getUrlRange(1, $facilities->lastPage()) as $page => $url)
                        @if ($page == $facilities->currentPage())
                            <span class="px-2.5 py-1 rounded bg-blue-600 text-white font-semibold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    <!-- Tombol Selanjutnya -->
                    @if ($facilities->hasMorePages())
                        <a href="{{ $facilities->nextPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Next
                        </a>
                    @else
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="openDeleteModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            style="display: none;">

            <div @click.away="openDeleteModal = false"
                class="bg-white dark:bg-gray-800 rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-700 space-y-4">

                <div
                    class="size-12 rounded-full bg-red-100 dark:bg-red-950/50 text-red-600 dark:text-red-400 flex items-center justify-center mx-auto">
                    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <div class="text-center space-y-1">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Delete this facilities?</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Are you sure want to delete this data <span
                            class="font-semibold text-gray-800 dark:text-gray-200" x-text="facilitieName"></span>?
                        This action can't be undone.
                    </p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="button" @click="openDeleteModal = false"
                        class="flex-1 py-2 px-4 text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition">
                        Cancel
                    </button>

                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full py-2 px-4 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">
                            Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
