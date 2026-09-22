<!-- SideBar -->
<aside
    class="container-sidebar relative h-screen flex flex-col items-center bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 transition-all duration-300 shadow-sm overflow-hidden z-40 ">
    <!-- Logo -->
    <div class="logo p-7 flex justify-center items-center shrink-0">
        <a href="{{ route('home') }}">
            <x-application-logo class="block h-9 w-auto fill-current" />
        </a>
    </div>

    <!-- Minimized Button -->
    <x-minimized-icon
        class="minimize-btn size-5 absolute w-10 h-10 right-0 top-12 cursor-pointer bg-white dark:bg-gray-800 text-blue-600 dark:text-gray-100 p-2 border border-gray-100 dark:border-gray-700 rounded-full shadow-sm z-50" />

    <!-- Navigation List -->
    <div class="nav-list w-full flex flex-col items-center overflow-y-auto overflow-x-hidden">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-dashboard-icon
                class="size-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <p class="text-nav">Dashboard</p>
        </a>

        <a href="{{ route('teachers.index') }}"
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('teachers.*') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-teachers-icon
                class="size-5 {{ request()->routeIs('teachers.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <p class="text-nav">Teachers</p>
        </a>

        <div
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('admin.students') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-students-icon class="size-5 text-blue-600 dark:text-gray-100" />
            <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Students</a>
        </div>

        <div
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('admin.staffs') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-admin-staff-icon class="size-5 text-blue-600 dark:text-gray-100" />
            <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Admin Staff</a>
        </div>

        <div
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('admin.greetings') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-greetings-icon class="size-5 text-blue-600 dark:text-gray-100" />
            <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Greeting</a>
        </div>

        <div class="nav-group w-full flex flex-col items-center">
            <div
                class="nav-item trigger-sublist relative gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                <x-activities-icon class="size-5 text-blue-600 dark:text-gray-100" />
                <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Activities</a>
                <x-arrow-icon
                    class="arrow-icon size-4 absolute right-2 stroke-2 transition-transform duration-300 text-blue-600 dark:text-gray-100" />
            </div>
            <div class="nav-sublist w-[85%] items-center block">
                <div class="sub-nav-item w-full flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-gray-100" />
                    <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Extracurricular</a>
                </div>
                <div
                    class="sub-nav-item w-full my-2 flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-gray-100" />
                    <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Events</a>
                </div>
            </div>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-facilities-icon class="size-5 text-blue-600 dark:text-gray-100" />

            <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Facilities</a>
        </div>

        <div class="nav-group w-full flex flex-col items-center">
            <div
                class="nav-item trigger-sublist relative gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                <x-information-icon class="size-5 text-blue-600 dark:text-gray-100" />
                <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Informations</a>
                <x-arrow-icon
                    class="arrow-icon size-4 absolute right-2 stroke-2 transition-transform duration-300 text-blue-600 dark:text-gray-100" />
            </div>
            <div class="nav-sublist w-[85%] items-center block">
                <div class="sub-nav-item w-full flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-gray-100" />
                    <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Article</a>
                </div>
                <div
                    class="sub-nav-item w-full my-2 flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-gray-100" />
                    <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Any Informations</a>
                </div>
            </div>
        </div>

        <div
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('admin.messages') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-mail-icon class="size-5 dark:text-gray-100 text-blue-600" />
            <a href="#" class="text-nav text-blue-950 dark:text-gray-100">Messages</a>
        </div>

        <a href="{{ route('users.index') }}"
            class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white dark:text-gray-100 hover:bg-blue-600 hover:text-white' : 'bg-transparent hover:bg-gray-200 dark:hover:bg-gray-500 text-blue-950 dark:text-gray-100' }}">
            <x-profile-icon
                class="size-5 {{ request()->routeIs('users.*') ? 'text-white' : 'text-blue-600 dark:text-gray-100' }}" />
            <p class="text-nav">Users</p>
        </a>
    </div>
</aside>
