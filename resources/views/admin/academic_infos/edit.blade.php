<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Informasi Akademik</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Isi form dibawah ini untuk mengedit informasi akademik</p>
            </div>

            <a href="{{ route('academic_infos.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('academic_infos.update', $academic_info->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: Preview Foto & Upload -->
                <div class="flex items-center gap-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="relative">
                        <img id="photo-preview"
                            src="{{ $academic_info->photo ? asset('storage/' . $academic_info->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($academic_info->title) }}"
                            alt="{{ $academic_info->title }}"
                            alt="Preview Photo"
                            class="size-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Foto Informasi
                            (Opsional)</label>
                        <input type="file" name="photo" id="photo-input" accept="image/jpeg,image/png,image/jpg"
                            class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-500 cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        @error('photo')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Judul Informasi <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $academic_info->title) }}"
                            placeholder="Contoh: Informasi KJP" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Link Informasi</label>
                        <input type="text" name="info_link" value="{{ old('info_link', $academic_info->info_link) }}"
                            placeholder="Contoh: https://example.com/informasi-kjp"
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Tuliskan deskripsi informasi ini..."
                        class="w-full text-xs p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">{{ old('description', $academic_info->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg">Perbarui
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Live Preview photo Ekskul -->
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
