<x-admin-layout>
    <!-- Wrapper Utama (Fit Layar & Scroll Intern untuk Tabel) -->
    <div x-data="{ openDeleteModal: false, deleteUrl: '', facilitieName: '' }" class="p-6 space-y-4 flex flex-col h-full overflow-hidden">

        <!-- Header Halaman & Form Pencarian + Tombol Tambah -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Acara Sekolah</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kelola nama, deskripsi, dan informasi acara lainnya.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <!-- Form Pencarian -->
                <form action="{{ route('events.index') }}" method="get" class="relative flex-1 md:w-64">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Cari nama acara, jadwal..."
                        class="w-full text-xs pl-9 pr-8 py-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400">

                    <!-- Icon Search -->
                    <x-search-icon class="size-4 absolute left-3 top-2.5 text-gray-400" />

                    <!-- Tombol Reset Search (Muncul jika ada keyword) -->
                    @if (request('search'))
                        <a href="{{ route('events.index') }}"
                            class="absolute right-2.5 top-2.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                            title="Clear search">
                            <x-clear-icon class="size-4" />
                        </a>
                    @endif
                </form>

                <!-- Tomboh tambah facilitie -->
                <a href="{{ route('events.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    <x-plus-icon class="size-4" />
                    Tambah Acara
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
                            <th class="py-3.5 px-4">Nama Acara</th>
                            <th class="py-3.5 px-4">Jadwal</th>
                            <th class="py-3.5 px-4">Dokumentasi</th>
                            <th class="py-3.5 px-4 max-w-xs">Deskripsi</th>
                            <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 text-gray-700 dark:text-gray-200">
                        @forelse ($events as $event)
                            <!-- Baris acara -->
                            <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $event->name }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $event->schedule }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center -space-x-2 overflow-hidden">
                                        @forelse ($event->photos->take(3) as $photo)
                                            <img src="{{ asset('storage/' . $photo->photos) }}"
                                                class="inline-block size-9 rounded-lg object-cover ring-2 ring-white dark:ring-gray-800">
                                        @empty
                                            <span class="text-gray-400 text-[11px] italic">Tanpa Foto</span>
                                        @endforelse
                                        @if ($event->photos->count() > 3)
                                            <span
                                                class="flex items-center justify-center size-9 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-bold ring-2 ring-white dark:ring-gray-800">
                                                +{{ $event->photos->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-semibold text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                    {{ Str::limit($event->description, 60) }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="p-1.5 rounded-lg text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition"
                                            title="Edit Acara">
                                            <x-edit-icon class="size-4" />
                                        </a>
                                        <button type="button"
                                            @click="openDeleteModal = true; deleteUrl = '{{ route('events.destroy', $event->id) }}'; facilityName = '{{ addslashes($event->name) }}'"
                                            class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 transition"
                                            title="Hapus Acara">
                                            <x-trash-icon class="size-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-400">
                                    @if (request('search'))
                                        Pencarian acara "<span class="font-semibold">{{ request('search') }}</span>" tidak
                                        ditemukan.
                                    @else
                                        Belum ada data acara.
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
                    Menampilkan <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $events->firstItem() ?? 0 }}</span>
                    - <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $events->lastItem() ?? 0 }}</span>
                    dari <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $events->total() }}</span>
                    Acara
                </div>

                <!-- Tombol Navigasi Halaman -->
                <div class="flex items-center gap-1">
                    <!-- Tombol Sebelumnya -->
                    @if ($events->onFirstPage())
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $events->previousPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Sebelumnya
                        </a>
                    @endif

                    <!-- Nomor Halaman -->
                    @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                        @if ($page == $events->currentPage())
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
                    @if ($events->hasMorePages())
                        <a href="{{ $events->nextPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Selanjutnya
                        </a>
                    @else
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Selanjutnya
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <template x-teleport="body">
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
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Hapus acara ini?</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Anda yakin ingin menghapus data ini <span
                                class="font-semibold text-gray-800 dark:text-gray-200" x-text="facilitieName"></span>?
                            Aksi ini tidak bisa dibatalkan.
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="openDeleteModal = false"
                            class="flex-1 py-2 px-4 text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition">
                            Batal
                        </button>

                        <form :action="deleteUrl" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 px-4 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
</x-admin-layout>
