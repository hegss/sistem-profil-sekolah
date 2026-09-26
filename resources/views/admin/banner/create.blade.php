<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Add New Banner</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Fill out the form below to add a new banner to the
                    system.</p>
            </div>

            <a href="{{ route('banners.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Back
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            placeholder="Example: SDN 12 Gedong" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Subtitle *</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                            placeholder="School moto or motivation" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Description *</label>
                    <textarea name="description" rows="4" required placeholder="Write a brief description about this school..."
                        class="w-full text-xs p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">{{ old('description') }}</textarea>
                </div>

                <!-- Multi-Image File Input -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Facility Photo Gallery (Can Add More Photo)</label>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-500 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG, JPEG. Maksimal 2MB per foto.</p>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg">Save
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
