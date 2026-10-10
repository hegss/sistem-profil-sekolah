<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Sambutan</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Pilih Kepala Sekolah dan masukkan kata sambutan/motivasi.</p>
            </div>

            <a href="{{ route('greetings.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('greetings.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Pilih Kepala Sekolah <span class="text-red-500">*</span></label>
                    <select name="teacher_id" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                        <option value="">-- Pilih Kepala Sekolah --</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $teacher->id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }} {{ isset($teacher->position) ? "({$teacher->position})" : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Kata Sambutan <span class="text-red-500">*</span></label>
                    <textarea name="greeting_text" rows="8" required placeholder="Tuliskan kata sambutan / motivasi Kepala Sekolah di sini..." class="w-full text-xs p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                        {{ old('greeting_text', $greetings->greeting_text) }}
                    </textarea>
                    @error('greeting_text')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="size-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="is_active" class="text-xs font-semibold text-gray-700 dark:text-gray-200">Set sebagai Sambutan Aktif (Akan otomatis menonaktifkan sambutan lama)</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
