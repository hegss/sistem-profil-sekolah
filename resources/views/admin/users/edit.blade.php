<x-admin-layout>
    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">

        <!-- Header Page & Tombol Kembali -->
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Data User</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Update user data and access rights below.</p>
            </div>

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        <!-- Form Card Container -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: Preview Foto & Upload Baru -->
                <div class="flex items-center gap-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="relative">
                        <img id="photo-preview"
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                            alt="{{ $user->name }}"
                            class="size-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Change Photo
                            (Optional)</label>
                        <input type="file" name="photo" id="photo-input" accept="image/jpeg,image/png,image/jpg"
                            class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1">Leave blank if you do not want to change your profile
                            photo.
                        </p>
                        @error('photo')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section: Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Full Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Username <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="username" id="username"
                            value="{{ old('username', $user->username) }}" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="phone"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Phone </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            placeholder="+62 812-xxxx-xxxx"
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role / Hak Akses -->
                    <div>
                        <label for="role"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Role / Access
                            Right
                            <span class="text-red-500">*</span></label>
                        <select name="role" id="role" required
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('role') border-red-500 @enderror">
                            {{-- <option value="">-- Choose Role --</option> --}}
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator
                            </option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User
                            </option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden md:block"></div> <!-- Spacer alignment -->

                    <!-- Password Baru (Opsional) -->
                    <div>
                        <label for="password"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Password Baru
                            (Opsional)</label>
                        <input type="password" name="password" id="password"
                            placeholder="Leave blank if don't want to change password"
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Konfirmasi
                            Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Repeat new password"
                            class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600 dark:focus:border-blue-400">
                    </div>

                </div>

                <!-- Footer Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                        Update Data
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Script Live Preview Foto Profil Saat Diunggah -->
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
