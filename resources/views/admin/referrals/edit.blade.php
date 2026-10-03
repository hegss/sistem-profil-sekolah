<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <!-- Header Page -->
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Kode Referral</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui detail kode referal dan status aktif.
                </p>
            </div>

            <a href="{{ route('referrals.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">

            <form action="{{ route('referrals.update', $referral->id) }}" method="POST" x-data="{
                classVal: '{{ old('class', $referral->class) }}',
                shift: '{{ old('shift', $referral->shift) }}',
                get previewCode() {
                    let cleanClass = this.classVal.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
                    return cleanClass ? `REF-${cleanClass}-${this.shift}` : 'REF-...';
                }
            }"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1. Input Class -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="class" x-model="classVal" value="{{ old('class', $referral->class) }}" placeholder="Example: 1A" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 uppercase">
                        @error('class')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 2. Select Shift -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Shift <span class="text-red-500">*</span></label>
                        <select name="shift" x-model="shift" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                            <option value="P" {{ old('shift', $referral->shift) === 'P' ? 'selected' : '' }}>Pagi (P)</option>
                            <option value="S" {{ old('shift', $referral->shift) === 'S' ? 'selected' : '' }}>Siang (S)</option>
                        </select>
                        @error('shift')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 3. Auto-Generated Referral Code Preview -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Kode Referal
                            (Otomatis)</label>

                        <input type="text" :value="previewCode" readonly
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700/80 text-blue-600 dark:text-blue-400 font-mono font-bold focus:outline-none cursor-not-allowed">

                        @error('reff_code')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Checkbox Status -->
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $referral->is_active) ? 'checked' : '' }}
                        class="size-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="is_active" class="text-xs font-semibold text-gray-700 dark:text-gray-200">
                        Status Aktif (Dapat digunakan untuk pengajuan dokumen dan keluhan.)
                    </label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">
                        Perbarui Referal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
