<!-- Container Sidebar Utama dengan Alpine.js -->
<aside x-data="{
    isMinimized: false,
    openGroup: '{{ request()->routeIs('activities.*') ? 'activities' : (request()->routeIs('informations.*') ? 'informations' : '') }}'
}" :class="isMinimized ? 'w-20' : 'w-64'"
    class="relative h-screen flex flex-col bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700/60 transition-all duration-300 shadow-sm shrink-0 z-40 select-none">

    <!-- Logo & Title Header -->
    <div
        class="p-1 flex justify-center items-center gap-3 shrink-0 border-b border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <a href="{{ route('home') }}" class="flex justify-center items-center">
            <x-application-logo class="h-16 w-auto fill-current shrink-0 text-blue-600 dark:text-blue-400" />
        </a>
    </div>

    <!-- Floating Toggle / Minimize Button -->
    <button type="button" @click="isMinimized = !isMinimized"
        class="absolute -right-3.5 top-5 z-50 p-1.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 shadow-md text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white transition duration-200 focus:outline-none"
        :title="isMinimized ? 'Expand Sidebar' : 'Minimize Sidebar'">
        <svg class="size-4 transition-transform duration-300" :class="isMinimized ? 'rotate-180' : ''" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Navigation List Container (Scrollable Area) -->
    <div class="flex-1 py-4 px-3 space-y-1.5 overflow-y-auto overflow-x-hidden custom-scrollbar">

        <!-- 1. Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Dashboard' : ''">
            <x-dashboard-icon
                class="size-5 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Dashboard</span>
        </a>

        <!-- 2. Banner -->
        <a href="{{ route('banners.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('banners.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Dashboard' : ''">
            <x-image-icon
                class="size-5 shrink-0 {{ request()->routeIs('banners.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Banner</span>
        </a>

        <!-- 3. Refferal Code -->
        <a href="{{ route('referrals.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('referrals.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Dashboard' : ''">
            <x-checked-badge
                class="size-5 shrink-0 {{ request()->routeIs('referrals.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Kode Refferal</span>
        </a>

        <!-- 4. Sub-Menu Group: Warga Sekolah -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'schools' ? '' : 'schools'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('students.*', 'teachers.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Warga Sekolah' : ''">
                <div class="flex items-center gap-3">
                    <x-students-icon
                        class="size-5 shrink-0 {{ request()->routeIs('teachers.*', 'students.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
                    <span x-show="!isMinimized" class="truncate">Warga Sekolah</span>
                </div>
                <svg x-show="!isMinimized"
                    class="size-3.5 stroke-2 text-gray-400 transition-transform duration-200 shrink-0"
                    :class="openGroup === 'schools' ? 'rotate-180 text-blue-600 dark:text-gray-200' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Sublist Items -->
            <div x-show="openGroup === 'schools' && !isMinimized" x-collapse class="pl-9 pr-2 space-y-1 pt-0.5">
                <a href="{{ route('students.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('students.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Data Siswa
                </a>
                <a href="{{ route('teachers.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('teachers.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Data Guru
                </a>
            </div>
        </div>

        <!-- 5. Greetings -->
        <a href="{{ route('greetings.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('greetings.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Dashboard' : ''">
            <x-paragraph-icon
                class="size-5 shrink-0 {{ request()->routeIs('greetings.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Sambutan</span>
        </a>

        <!-- 6. Sub-Menu Group: Activities -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'activities' ? '' : 'activities'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('extracurriculars.*', 'events.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Activities' : ''">
                <div class="flex items-center gap-3">
                    <x-activities-icon
                        class="size-5 shrink-0 {{ request()->routeIs('extracurriculars.*', 'events.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
                    <span x-show="!isMinimized" class="truncate">Aktivitas</span>
                </div>
                <svg x-show="!isMinimized"
                    class="size-3.5 stroke-2 text-gray-400 transition-transform duration-200 shrink-0"
                    :class="openGroup === 'activities' ? 'rotate-180 text-blue-600 dark:text-gray-200' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Sublist Items -->
            <div x-show="openGroup === 'activities' && !isMinimized" x-collapse class="pl-9 pr-2 space-y-1 pt-0.5">
                <a href="{{ route('extracurriculars.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('extracurriculars.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Ekstrakurikuler
                </a>
                <a href="{{ route('events.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('events.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Acara Sekolah
                </a>
            </div>
        </div>

        <!-- 7. Facilities -->
        <a href="{{ route('facilities.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('facilities.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Facilities' : ''">
            <x-facilities-icon
                class="size-5 shrink-0 {{ request()->routeIs('facilities.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Fasilitas</span>
        </a>

        <!-- 8. Sub-Menu Group: Informations -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'informations' ? '' : 'informations'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('academic_infos.*', 'news.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Informations' : ''">
                <div class="flex items-center gap-3">
                    <x-information-icon class="size-5 shrink-0 {{ request()->routeIs('academic_infos.*', 'news.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
                    <span x-show="!isMinimized" class="truncate">Informasi</span>
                </div>
                <svg x-show="!isMinimized"
                    class="size-3.5 stroke-2 text-gray-400 transition-transform duration-200 shrink-0"
                    :class="openGroup === 'informations' ? 'rotate-180 text-blue-600 dark:text-gray-200' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Sublist Items -->
            <div x-show="openGroup === 'informations' && !isMinimized" x-collapse class="pl-9 pr-2 space-y-1 pt-0.5">
                <a href="{{ route('news.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('news.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Berita
                </a>
                <a href="{{ route('academic_infos.index') }}"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('academic_infos.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Informasi Akademik
                </a>
            </div>
        </div>

        <!-- 9. Sub-Menu Group: Messages -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'mails' ? '' : 'mails'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('questions.*', 'complaints.*', 'docs_request.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'mails' : ''">
                <div class="flex items-center gap-3">
                    <x-mail-icon class="size-5 shrink-0 {{ request()->routeIs('questions.*', 'complaints.*', 'docs_request.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
                    <span x-show="!isMinimized" class="truncate">Pesan</span>
                </div>
                <svg x-show="!isMinimized"
                    class="size-3.5 stroke-2 text-gray-400 transition-transform duration-200 shrink-0"
                    :class="openGroup === 'mails' ? 'rotate-180 text-blue-600 dark:text-gray-200' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Sublist Items -->
            <div x-show="openGroup === 'mails' && !isMinimized" x-collapse class="pl-9 pr-2 space-y-1 pt-0.5">
                <a href="#"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('questions.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Pertanyaan
                </a>
                <a href="#"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('complaints.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Keluhan
                </a>
                <a href="#"
                    class="block py-2 px-3 text-xs font-semibold rounded-lg transition duration-200 {{ request()->routeIs('docs_request.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}">
                    Pengajuan Dokumen
                </a>
            </div>
        </div>

        <!-- 10. Users -->
        <a href="{{ route('users.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Users' : ''">
            <x-profile-icon
                class="size-5 shrink-0 {{ request()->routeIs('users.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Users</span>
        </a>

    </div>

    <!-- FIXED BOTTOM SECTION (Settings & Logout) -->
    <div
        class="mt-auto p-3 border-t border-gray-100 dark:border-gray-700/60 space-y-1.5 shrink-0 bg-white dark:bg-gray-800">

        <!-- Settings -->
        <a href="{{ route('admin.profile.edit') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition-all duration-200"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Settings' : ''">
            <x-settings-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Profil</span>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-all duration-200"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Logout' : ''">
                <x-logout-icon class="size-5 shrink-0 text-rose-600 dark:text-rose-400" />
                <span x-show="!isMinimized" class="truncate">Keluar</span>
            </button>
        </form>

    </div>

</aside>
