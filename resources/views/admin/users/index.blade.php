<x-admin-layout>
    <!-- Wrapper Utama (Fit Layar & Scroll Intern untuk Tabel) -->
    <div x-data="{ openDeleteModal: false, deleteUrl: '', userName: '' }" class="p-6 space-y-4 flex flex-col h-full overflow-hidden">

        <!-- Header Halaman & Tombol Tambah -->
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Users Management</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Manage user data, access rights, and contact
                    information.</p>
            </div>

            <a href="{{ route('users.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add User
            </a>
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
                            <th scope="col" class="py-3.5 px-4 w-16 text-center">ID</th>
                            <th scope="col" class="py-3.5 px-4">Name</th>
                            <th scope="col" class="py-3.5 px-4">Email</th>
                            <th scope="col" class="py-3.5 px-4">Phone</th>
                            <th scope="col" class="py-3.5 px-4">Role</th>
                            <th scope="col" class="py-3.5 px-4 text-center w-28">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 text-gray-700 dark:text-gray-200">
                        @forelse ($users as $user)
                            <!-- Contoh Baris 1 -->
                            <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-gray-400">{{ $user->id }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <!-- Foto Profil -->
                                        <img class="size-9 rounded-full object-cover border border-gray-200 dark:border-gray-600 shrink-0"
                                            src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff' }}"
                                            alt="{{ $user->name }}">

                                        <!-- Nama + Username (Stacked) -->
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-gray-900 dark:text-white text-sm leading-tight">{{ $user->name }}</span>
                                            <span
                                                class="text-[11px] text-gray-400 dark:text-gray-400">{{ $user->username }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-medium">{{ $user->email }}</td>
                                <td class="py-3 px-4 text-gray-500 dark:text-gray-400">{{ $user->phone }}</td>
                                <td class="py-3 px-4">
                                    <!-- Badge Role -->
                                    @if ($user->role === 'admin')
                                        <span
                                            class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300">
                                            Administrator
                                        </span>
                                    @else
                                        <span
                                            class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-purple-100 text-purple-700 dark:bg-purle-950 dark:text-purple-300">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <!-- Edit Button -->
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="p-1.5 rounded-lg text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition"
                                            title="Edit User">
                                            <svg class="size-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button (Pemicu Modal Delete) -->
                                        <button type="button"
                                            @click="openDeleteModal = true; deleteUrl = '{{ route('users.destroy', $user->id) }}'; userName = '{{ addslashes($user->name) }}'"
                                            class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 transition"
                                            title="Hapus User">
                                            <svg class="size-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-400">No user data yet.</td>
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
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $users->firstItem() ?? 0 }}</span>
                    sampai <span
                        class="font-semibold text-gray-700 dark:text-gray-200">{{ $users->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $users->total() }}</span> User
                </div>

                <!-- Tombol Navigasi Halaman -->
                <div class="flex items-center gap-1">
                    <!-- Tombol Sebelumnya -->
                    @if ($users->onFirstPage())
                        <span
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}"
                            class="px-2.5 py-1 rounded border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                            Sebelumnya
                        </a>
                    @endif

                    <!-- Nomor Halaman -->
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
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
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}"
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
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Delete this user?</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Are you sure want to delete this data <span
                            class="font-semibold text-gray-800 dark:text-gray-200" x-text="userName"></span>?
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
