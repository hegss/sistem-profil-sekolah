<x-admin-layout>
    <div class="p-6 space-y-6 flex flex-col h-full overflow-y-auto custom-scrollbar">

        <!-- Header Page -->
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Admin Profile Setting</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Manage personal profile information, photo, and security
                    akun Anda.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Card Ringkasan Profile & Foto -->
            <div class="lg:col-span-1 space-y-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col items-center text-center">

                    <!-- Avatar Preview -->
                    <div class="relative group mb-4">
                        <img id="profile-avatar-preview"
                            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                            alt="{{ Auth::user()->name }}"
                            class="size-28 rounded-full object-cover border-4 border-gray-100 dark:border-gray-700 shadow-md transition group-hover:opacity-90">
                    </div>

                    <!-- User Meta -->
                    <h2 class="text-base font-bold text-gray-900 dark:text-white leading-tight">{{ Auth::user()->name }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">@ {{ Auth::user()->username }}</p>

                    <div class="mt-3">
                        <span
                            class="px-3 py-1 text-[10px] font-bold rounded-full bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300 uppercase tracking-wider">
                            {{ Auth::user()->role }}
                        </span>
                    </div>

                    <div class="w-full border-t border-gray-100 dark:border-gray-700/60 my-5"></div>

                    <!-- Detail Info Ringkas -->
                    <div class="w-full space-y-3 text-left text-xs">
                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                            <span>Email:</span>
                            <span
                                class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                            <span>Phone:</span>
                            <span
                                class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->phone ?? '-' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column: Form Edit Informasi & Password -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Card 1: Form Update Informsi Profil -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/60 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white mb-1">Account Information</h3>
                    <p class="text-xs text-gray-400 mb-6">Update name, username, email, and your phone number account.
                    </p>

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <!-- File Input Foto -->
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700/60">
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Unggah
                                Foto Profil Baru</label>
                            <input type="file" name="photo" id="photo-file-input"
                                accept="image/jpeg,image/png,image/jpg"
                                class="text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:hover:file:bg-gray-500 dark:file:bg-gray-700 dark:file:text-gray-200 cursor-pointer">
                            @error('photo')
                                <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="name"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Full Name *</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', Auth::user()->name) }}" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                                @error('name')
                                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Username
                                    *</label>
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', Auth::user()->username) }}" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                                @error('username')
                                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Email
                                    *</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', Auth::user()->email) }}" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                                @error('email')
                                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label for="phone"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Phone Number</label>
                                <input type="text" name="phone" id="phone"
                                    value="{{ old('phone', Auth::user()->phone) }}" placeholder="+62 812-xxxx-xxxx"
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                                @error('phone')
                                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                                Save Update
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Card 2: Form Ganti Password -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/60 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white mb-1">Password Security</h3>
                    <p class="text-xs text-gray-400 mb-6">Ensure your account uses a long, random password to maintain security.</p>

                    <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="current_password"
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Current Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                            @error('current_password')
                                <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">New Password</label>
                                <input type="password" name="password" id="password" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                                @error('password')
                                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit"
                                class="px-5 py-2.5 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Live Preview Script untuk Avatar Foto Profil -->
    <script>
        document.getElementById('photo-file-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin-layout>
