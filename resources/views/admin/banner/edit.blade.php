<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Banner</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Update the banners photo, title, subtitle, and description.</p>
            </div>

            <a href="{{ route('banners.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Back
            </a>
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm space-y-6">

            <!-- Existing Photos Gallery Section -->
            @if ($banner->photos->count() > 0)
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-2">Recent Photo Gallery</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        @foreach ($banner->photos as $photo)
                            <div
                                class="relative group rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                                <img src="{{ asset('storage/' . $photo->photos) }}"
                                    class="size-24 object-cover w-full">
                                <!-- Delete Single Photo Button -->
                                <form action="{{ route('banners.photo.destroy', $photo->id) }}" method="POST"
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus foto ini dari galeri?')"
                                        class="p-1.5 bg-red-600 text-white rounded-lg text-xs font-semibold hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 border-t border-gray-100 dark:border-gray-700 pt-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Title
                            *</label>
                        <input type="text" name="title"
                            value="{{ old('title', $banner->title) }}" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Subtitle
                            *</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Description *</label>
                    <textarea name="description" rows="4" required
                        class="w-full text-xs p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Add New Photo to
                        Gallery (Optional)</label>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-500 cursor-pointer">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
