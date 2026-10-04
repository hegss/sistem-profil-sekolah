<x-admin-layout>
    <div x-data="{ openPhotoDeleteModal: false, deletePhotoUrl: '' }" class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Ekskul</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Isi form dibawah ini untuk mengedit ekskul.</p>
            </div>

            <a href="{{ route('extracurriculars.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('extracurriculars.update', $extracurricular->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: Preview Foto & Upload Baru -->
                <div class="flex items-center gap-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="relative">
                        <img id="photo-preview"
                            src="{{ $extracurricular->logo ? asset('storage/' . $extracurricular->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($extracurricular->name) }}"
                            alt="{{ $extracurricular->name }}"
                            class="size-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Ubah Logo
                            (Optional)</label>
                        <input type="file" name="logo" id="photo-input" accept="image/jpeg,image/png,image/jpg"
                            class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1">Biarkan kosong jika tidak ingin memperbarui logo</p>
                        @error('logo')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama Ekskul
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $extracurricular->name) }}"
                            placeholder="Contoh: Futsal Gedong 12" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Jadwal <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="schedule" value="{{ old('schedule', $extracurricular->schedule) }}"
                            placeholder="Contoh: Jumat, 15.00-16.00" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Tulis deskripsi singkat tentang ekskul ini..."
                        class="w-full text-xs p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">{{ old('description', $extracurricular->description) }}</textarea>
                </div>

                <!-- Existing Photos Gallery Section -->
                @if ($extracurricular->photos->count() > 0)
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-2">Galeri Foto
                            Terakhir</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            @foreach ($extracurricular->photos as $photo)
                                <div
                                    class="relative group rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <img src="{{ asset('storage/' . $photo->photos) }}"
                                        class="size-24 object-cover w-full">

                                    <!-- Delete Single Photo Trigger Button (Mengaktifkan Modal Custom) -->
                                    <div
                                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-200">
                                        <button type="button"
                                            @click="openPhotoDeleteModal = true; deletePhotoUrl = '{{ route('extracurriculars.photo.destroy', $photo->id) }}'"
                                            class="p-1.5 bg-red-600 text-white rounded-lg text-xs font-semibold hover:bg-red-700 shadow-md transition">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Multi-Image File Input -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Tambah Dokumentasi
                        (Bisa lebih dari satu foto)</label>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-500 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG, JPEG. Maksimal 2MB per foto.</p>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg">Simpan
                        Data</button>
                </div>
            </form>
        </div>

        <!-- MODAL CUSTOM DELETE FOTO GALERI -->
        <template x-teleport="body">
            <div x-show="openPhotoDeleteModal"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div @click.away="openPhotoDeleteModal = false"
                    class="bg-white dark:bg-gray-800 rounded-2xl max-w-sm w-full p-6 shadow-2xl space-y-4 border border-gray-100 dark:border-gray-700">

                    <!-- Icon Warning Merah -->
                    <div
                        class="size-12 rounded-full bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 flex items-center justify-center mx-auto shrink-0">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>

                    <!-- Pesan Konfirmasi -->
                    <div class="text-center space-y-1">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Hapus Foto Galeri?</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus foto ini
                            dari galeri ekskul? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>

                    <!-- Tombol Aksi Modal -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="openPhotoDeleteModal = false"
                            class="flex-1 py-2 text-xs font-semibold bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg transition">
                            Batal
                        </button>

                        <form :action="deletePhotoUrl" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 text-xs font-semibold bg-red-600 hover:bg-red-700 text-white rounded-lg transition shadow-sm">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Script Live Preview Logo Ekskul -->
    <script>
        document.getElementById('photo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin-layout>
