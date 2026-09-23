<!-- Container Sidebar Utama dengan Alpine.js -->
<aside x-data="{
    isMinimized: false,
    openGroup: '{{ request()->routeIs('activities.*') ? 'activities' : (request()->routeIs('informations.*') ? 'informations' : '') }}'
}" :class="isMinimized ? 'w-20' : 'w-64'"
    class="relative h-screen flex flex-col bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700/60 transition-all duration-300 shadow-sm shrink-0 z-40 select-none">

    <!-- Logo & Title Header -->
    <div
        class="p-5 flex items-center gap-3 shrink-0 h-18 border-b border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <x-application-logo class="h-8 w-auto fill-current shrink-0 text-blue-600 dark:text-blue-400" />
            <span x-show="!isMinimized" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-bold text-gray-800 dark:text-white text-base tracking-wide whitespace-nowrap">
                SchoolAdmin
            </span>
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

        <!-- 2. Teachers -->
        <a href="{{ route('teachers.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('teachers.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Teachers' : ''">
            <x-teachers-icon
                class="size-5 shrink-0 {{ request()->routeIs('teachers.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <span x-show="!isMinimized" class="truncate">Teachers</span>
        </a>

        <!-- 3. Students -->
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.students') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Students' : ''">
            <x-students-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Students</span>
        </a>

        <!-- 4. Admin Staff -->
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.staffs') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Admin Staff' : ''">
            <x-admin-staff-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Admin Staff</span>
        </a>

        <!-- 5. Greeting -->
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.greetings') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Greeting' : ''">
            <x-greetings-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Greeting</span>
        </a>

        <!-- 6. Sub-Menu Group: Activities -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'activities' ? '' : 'activities'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition-all duration-200"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Activities' : ''">
                <div class="flex items-center gap-3">
                    <x-activities-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
                    <span x-show="!isMinimized" class="truncate">Activities</span>
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
                <a href="#"
                    class="block py-2 px-3 text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700/40 rounded-lg transition">
                    Extracurricular
                </a>
                <a href="#"
                    class="block py-2 px-3 text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700/40 rounded-lg transition">
                    Events
                </a>
            </div>
        </div>

        <!-- 7. Facilities -->
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Facilities' : ''">
            <x-facilities-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Facilities</span>
        </a>

        <!-- 8. Sub-Menu Group: Informations -->
        <div class="space-y-1">
            <button type="button"
                @click="openGroup = (openGroup === 'informations' ? '' : 'informations'); if(isMinimized) isMinimized = false;"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition-all duration-200"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Informations' : ''">
                <div class="flex items-center gap-3">
                    <x-information-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
                    <span x-show="!isMinimized" class="truncate">Informations</span>
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
                <a href="#"
                    class="block py-2 px-3 text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700/40 rounded-lg transition">
                    Article
                </a>
                <a href="#"
                    class="block py-2 px-3 text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700/40 rounded-lg transition">
                    Any Informations
                </a>
            </div>
        </div>

        <!-- 9. Messages -->
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.messages') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}"
            :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Messages' : ''">
            <x-mail-icon class="size-5 shrink-0 text-blue-600 dark:text-gray-100" />
            <span x-show="!isMinimized" class="truncate">Messages</span>
        </a>

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
            <span x-show="!isMinimized" class="truncate">Settings</span>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-all duration-200"
                :class="isMinimized ? 'justify-center' : ''" :title="isMinimized ? 'Logout' : ''">
                <x-logout-icon class="size-5 shrink-0 text-rose-600 dark:text-rose-400" />
                <span x-show="!isMinimized" class="truncate">Logout</span>
            </button>
        </form>

    </div>

</aside>
