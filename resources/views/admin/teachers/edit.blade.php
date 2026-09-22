<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Data Teacher</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Update Manage teacher data, active status, and position.</p>
            </div>

            <a href="{{ route('teachers.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Back
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: Preview Foto & Upload -->
                <div class="flex items-center gap-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="relative">
                        <img id="photo-preview"
                            src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=0D8ABC&color=fff' }}"
                            alt="{{ $teacher->name }}"
                            class="size-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Change Photo
                            (Opsional)</label>
                        <input type="file" name="photo" id="photo-input" accept="image/jpeg,image/png,image/jpg"
                            class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-500 cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maximum 2MB.</p>
                        @error('photo')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama Lengkap + Gelar -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Name (including
                            title)
                            *</label>
                        <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                            placeholder="Example: John Doe, Ph.D">
                        @error('name')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Position / Subject Teachers *</label>
                        <input type="text" name="position" value="{{ old('position', $teacher->position) }}"
                            placeholder="Example: Math Teacher" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                        @error('position')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Toggle Status Aktif -->
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="size-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="is_active" class="text-xs font-semibold text-gray-700 dark:text-gray-200">Show in
                        School Profile (Active Status)</label>
                </div>

                {{-- Footer Actions Button --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('teachers.index') }}"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                        Cancel
                    </a>

                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg">
                        Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('photo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => document.getElementById('photo-preview').src = e.target.result;
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin-layout>
