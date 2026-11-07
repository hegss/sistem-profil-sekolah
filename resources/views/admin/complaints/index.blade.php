<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-hidden" x-data="{ detailModalOpen: false, selectedComplaint: null }">

        <!-- Header & Input Pencarian -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Judul & Subtitle -->
            <div>
                <h1 class="text-xl font-bold text-amber-600 dark:text-white">Keluhan Warga Sekolah</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kelola dan tindak lanjuti informasi keluhan yang
                    disampaikan warga sekolah.</p>
            </div>

            <!-- Form Pencarian & Filter Status -->
            <form action="{{ route('complaints.index') }}" method="get"
                class="flex flex-wrap items-center gap-2">
                <!-- Dropdown Filter Status -->
                <select name="status" onchange="this.form.submit()"
                    class="text-xs rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:ring-amber-500 focus:border-amber-500 py-2.5">
                    <option value="">Semua Status</option>
                    <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>
                        Diterima</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>
                        Diproses</option>
                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>
                        Selesai</option>
                </select>

                <!-- Field Input Pencarian -->
                <div class="relative md:w-64">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Cari nama pengirim, no telepon..."
                        class="w-full text-xs pl-9 pr-8 py-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:border-amber-600 dark:focus:border-amber-400">

                    <!-- Icon Search -->
                    <x-search-icon class="size-4 absolute left-3 top-2.5 text-gray-400" />

                    <!-- Tombol Reset Search (Muncul jika ada keyword) -->
                    @if (request('search'))
                        <a href="{{ route('complaints.index') }}"
                            class="absolute right-2.5 top-2.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                            title="Clear search">
                            <x-clear-icon class="size-4" />
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tabel Keluhan -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col flex-1 min-h-0 overflow-hidden">
            <div class="overflow-x-auto overflow-y-auto flex-1 custom-scrollbar">
                <table class="w-full text-left text-xs border-collapse">
                    <thead
                        class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold sticky top-0 border-b border-gray-100 dark:border-gray-700 z-10">
                        <tr>
                            <th class="py-3.5 px-4 text-center w-16">No</th>
                            <th class="py-3.5 px-4">Pengirim / Telepon</th>
                            <th class="py-3.5 px-4">Kode Referal</th>
                            <th class="py-3.5 px-4">Jenis Keluhan</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 text-gray-700 dark:text-gray-200">
                        @forelse ($complaints as $index => $complaint)
                            <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                                <td class="py-3 px-4 text-center font-bold text-slate-400">
                                    {{ $complaints->firstItem() + $index }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $complaint->sender_name }}
                                    </div>
                                    <div class="text-[11px] text-slate-400">{{ $complaint->sender_phone }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-900/30 font-mono text-[11px] font-bold text-amber-800 dark:text-amber-300 border border-amber-200/50">
                                        {{ $complaint->referral_code }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 capitalize font-semibold">
                                    @if ($complaint->category == 'infrastructure')
                                        Sarana & Prasarana
                                    @elseif($complaint->category == 'learning')
                                        Kegiatan Belajar
                                    @else
                                        Lainnya
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <!-- Form Status Ubah Langsung -->
                                    <form action="{{ route('complaints.update-status', $complaint->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-[11px] font-bold rounded-full px-3 py-1 border-0 focus:ring-0 cursor-pointer
                                                {{ $complaint->status == 'accepted' ? 'bg-amber-100 text-amber-800' : '' }}
                                                {{ $complaint->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $complaint->status == 'done' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                            <option value="accepted"
                                                {{ $complaint->status == 'accepted' ? 'selected' : '' }}>Diterima
                                            </option>
                                            <option value="processing"
                                                {{ $complaint->status == 'processing' ? 'selected' : '' }}>Diproses
                                            </option>
                                            <option value="done"
                                                {{ $complaint->status == 'done' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Lihat Detail -->
                                        <button
                                            @click="selectedComplaint = {{ json_encode($complaint) }}; detailModalOpen = true"
                                            class="p-2 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 text-slate-700 dark:text-slate-200 transition"
                                            title="Lihat Detail Pesan">
                                            <svg class="size-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <!-- Hubungi WhatsApp -->
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $complaint->sender_phone);
                                            if (str_starts_with($cleanPhone, '0')) {
                                                $cleanPhone = '62' . substr($cleanPhone, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($complaint->sender_name) }},%20mengenai%20keluhan%20Anda%20di%20SDN%20Gedong%2012..."
                                            target="_blank"
                                            class="p-2 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition"
                                            title="Hubungi via WhatsApp">
                                            <svg class="size-4 fill-current" viewBox="0 0 24 24">
                                                <path
                                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                                            </svg>
                                        </a>

                                        <!-- Hapus (Hanya jika Selesai) -->
                                        @if ($complaint->status === 'done')
                                            <form action="{{ route('complaints.destroy', $complaint->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
                                                    title="Hapus Keluhan">
                                                    <svg class="size-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <button disabled
                                                class="p-2 rounded-xl bg-slate-100 text-slate-300 cursor-not-allowed"
                                                title="Hanya keluhan selesai yang dapat dihapus">
                                                <svg class="size-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-400">
                                    @if (request('search'))
                                        Pencarian "<span class="font-semibold">{{ request('search') }}</span>" tidak
                                        ditemukan.
                                    @elseif (request('status'))
                                        Status "
                                        <span class="font-semibold">
                                            @if(request('status') === 'accepted')
                                                Diterima
                                            @elseif(request('status') === 'processing')
                                                Diproses
                                            @elseif(request('status') === 'done')
                                                Selesai
                                            @endif
                                        </span>
                                        " tidak ditemukan.
                                    @else
                                        Belum ada data ekstrakurikuler.
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
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $complaints->firstItem() ?? 0 }}</span>
                    - <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $complaints->lastItem() ?? 0 }}</span>
                    dari <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $complaints->total() }}</span>
                    Keluhan
                </div>

                <!-- Tombol Navigasi Halaman -->
                <div class="flex items-center gap-1">
                    <!-- Tombol Sebelumnya -->
                    @if ($complaints->onFirstPage())
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $complaints->previousPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Sebelumnya
                        </a>
                    @endif

                    <!-- Nomor Halaman -->
                    @foreach ($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                        @if ($page == $complaints->currentPage())
                            <span class="px-2.5 py-1 rounded bg-amber-600 text-white font-semibold">
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
                    @if ($complaints->hasMorePages())
                        <a href="{{ $complaints->nextPageUrl() }}"
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

        <!-- MODAL DETAIL KELUHAN -->
        <div x-show="detailModalOpen" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm" x-cloak>
            <div @click.away="detailModalOpen = false"
                class="bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 space-y-5 border border-slate-100 dark:border-slate-700 shadow-2xl">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
                    <h3 class="font-black text-slate-900 dark:text-white text-base">Detail Pesan Keluhan</h3>
                    <button @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <template x-if="selectedComplaint">
                    <div class="space-y-4 text-xs">
                        <div
                            class="grid grid-cols-2 gap-3 bg-amber-50/50 dark:bg-slate-700/50 p-4 rounded-2xl border border-amber-100/60">
                            <div>
                                <span class="text-slate-400 block text-[10px]">Nama Pengirim</span>
                                <strong class="text-slate-800 dark:text-white"
                                    x-text="selectedComplaint.sender_name"></strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Nomor Telepon</span>
                                <strong class="text-slate-800 dark:text-white"
                                    x-text="selectedComplaint.sender_phone"></strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Kode Referal</span>
                                <span class="font-mono font-bold text-amber-700 dark:text-amber-400"
                                    x-text="selectedComplaint.referral_code"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Jenis Keluhan</span>
                                <strong class="text-slate-800 dark:text-white capitalize"
                                    x-text="selectedComplaint.category.replace('_', ' ')"></strong>
                            </div>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[10px] mb-1">Isi Pesan Keluhan:</span>
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 text-slate-700 dark:text-slate-200 leading-relaxed whitespace-pre-line"
                                x-text="selectedComplaint.message"></div>
                        </div>
                    </div>
                </template>

                <div class="pt-2 flex justify-end">
                    <button @click="detailModalOpen = false"
                        class="px-5 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-xs hover:bg-slate-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
