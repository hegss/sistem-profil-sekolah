<!-- Header Container -->
<header
    class="sticky top-0 w-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-md flex justify-between items-center px-8 py-3.5 shadow-sm border-b border-gray-100 dark:border-gray-700/60 z-30 transition-all">

    <!-- Form Search Global -->
    <div class="form-search">
        <form action="{{ route('users.index') }}" method="GET" class="relative">
            <x-search-icon
                class="text-gray-400 dark:text-gray-400 size-4 absolute top-2 left-3.5 stroke-2 pointer-events-none" />
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-72 md:w-80 pl-10 pr-4 py-2 text-xs rounded-xl bg-gray-50 dark:bg-gray-900/50 text-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-700 focus:outline-none focus:border-blue-600 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-gray-900 transition duration-200"
                placeholder="Search here...">
        </form>
    </div>

    <!-- Area Kanan Header (Notifications & Profile Menu) -->
    <div class="flex items-center gap-3">

        <!-- 1. Notification Dropdown (Alpine.js State) -->
        <div x-data="{ openNotif: false }" class="relative">

            <!-- Notification Trigger Button -->
            <button @click="openNotif = !openNotif" type="button"
                class="relative p-2 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition duration-200 focus:outline-none"
                :class="openNotif ? 'bg-gray-100 dark:bg-gray-700/60 text-blue-600 dark:text-blue-400' : ''">

                <x-notif-icon class="size-5" />

                <!-- Red Badge Indicator -->
                <span class="absolute top-2 right-2 flex size-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full size-2 bg-blue-600"></span>
                </span>
            </button>

            <!-- Notification Dropdown Menu -->
            <div x-show="openNotif" @click.away="openNotif = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50"
                x-cloak>

                <!-- Dropdown Header -->
                <div
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-700/60 flex items-center justify-between">
                    <h3 class="text-xs font-bold text-gray-800 dark:text-white">Pesan & Notifikasi</h3>
                    <span
                        class="px-2 py-0.5 text-[10px] font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 rounded-full">4
                        Baru</span>
                </div>

                <!-- Dropdown List -->
                <div class="max-h-64 overflow-y-auto custom-scrollbar divide-y divide-gray-50 dark:divide-gray-700/40">
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                        <div
                            class="size-8 rounded-full bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                            <x-mail-icon class="size-4" />
                        </div>
                        <div class="flex flex-col flex-1 min-w-0">
                            <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 truncate">Risma
                                Cahaya</span>
                            <span class="text-[10px] text-gray-400 truncate">Mengirim pesan baru terkait
                                kegiatan...</span>
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                        <div
                            class="size-8 rounded-full bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                            <x-mail-icon class="size-4" />
                        </div>
                        <div class="flex flex-col flex-1 min-w-0">
                            <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 truncate">Nadia
                                Fitri</span>
                            <span class="text-[10px] text-gray-400 truncate">Mengunggah berkas data siswa baru.</span>
                        </div>
                    </a>
                </div>

                <!-- Dropdown Footer -->
                <a href="#"
                    class="block text-center py-2.5 text-[11px] font-semibold text-blue-600 dark:text-blue-400 hover:bg-gray-50 dark:hover:bg-gray-700/40 border-t border-gray-100 dark:border-gray-700/60 transition">
                    Lihat Semua Pesan
                </a>
            </div>
        </div>

        <!-- Divider Line -->
        <div class="h-5 w-px bg-gray-200 dark:bg-gray-700 mx-1"></div>

        <!-- 2. User Profile Dropdown (Alpine.js State) -->
        <div x-data="{ openProfile: false }" class="relative">

            <!-- Profile Trigger Button (Header) -->
            <button @click="openProfile = !openProfile" type="button"
                class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700/60 transition duration-200 focus:outline-none">

                <!-- Avatar Foto Header -->
                @if (Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                        class="size-8 rounded-full object-cover border border-gray-200 dark:border-gray-600 shrink-0">
                @else
                    <div
                        class="size-8 rounded-full bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                        <x-profile-icon class="size-4" />
                    </div>
                @endif

                <!-- User Information Text Header -->
                <div class="hidden sm:flex flex-col text-left">
                    <span
                        class="text-xs font-bold text-gray-800 dark:text-white leading-tight">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] font-semibold text-gray-400 capitalize">{{ Auth::user()->role }}</span>
                </div>

                <!-- Arrow Icon -->
                <svg class="size-4 text-gray-400 transition-transform duration-200"
                    :class="openProfile ? 'rotate-180 text-blue-600 dark:text-white' : ''" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- User Profile Card Popover (Desain Persis Seperti Gambar) -->
            <div x-show="openProfile" @click.away="openProfile = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700/60 p-6 z-50 space-y-5"
                x-cloak>

                <!-- Top Section: Foto & Identitas -->
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-3">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                                class="size-24 rounded-full object-cover border-4 border-emerald-500/20 shadow-sm">
                        @else
                            <div
                                class="size-24 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold text-xl border-4 border-emerald-500/20 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-gray-900 dark:text-white leading-tight">{{ Auth::user()->name }}
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">@ {{ Auth::user()->username ?? 'user' }}</p>

                    <span
                        class="mt-3 px-3.5 py-1 text-[10px] font-extrabold rounded-full bg-blue-50 text-blue-600 dark:bg-blue-950/80 dark:text-blue-400 uppercase tracking-wider">
                        {{ Auth::user()->role }}
                    </span>
                </div>

                <!-- Divider Line -->
                <div class="border-t border-gray-100 dark:border-gray-700/60"></div>

                <!-- Middle Section: Detail Contact Info -->
                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 font-medium">Email:</span>
                        <span
                            class="font-bold text-gray-800 dark:text-gray-200 truncate max-w-[170px]">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 font-medium">Phone:</span>
                        <span
                            class="font-bold text-gray-800 dark:text-gray-200">{{ Auth::user()->phone ?? '-' }}</span>
                    </div>
                </div>

                <!-- Bottom Section: Dua Navigasi (Settings & Logout) -->
                <div class="pt-2 flex items-center gap-2.5 border-t border-gray-100 dark:border-gray-700/60">
                    <!-- Navigasi Settings / Edit Profile -->
                    <a href="{{ route('admin.profile.edit') }}"
                        class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold transition">
                        <x-settings-icon class="size-4 text-gray-500 dark:text-gray-300" />
                        <span>Settings</span>
                    </a>

                    <!-- Navigasi Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-red-50 hover:bg-red-100 dark:bg-red-950/40 dark:hover:bg-red-900/60 text-red-600 dark:text-red-400 text-xs font-semibold transition">
                            <x-logout-icon class="size-4 text-red-600 dark:text-red-400" />
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</header>
