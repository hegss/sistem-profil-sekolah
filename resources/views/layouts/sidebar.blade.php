<!-- Header -->
<div
    class="container-header absolute bg-white dark:bg-gray-700 flex justify-end items-center w-full h-[13%] px-10 py-2.5 shadow-sm">
    <!-- Form Search -->
    <div class="form-search mr-5">
        <form class="relative">
            <x-search-icon class="text-blue-600 dark:text-white size-6 absolute top-2 left-2 z-50 stroke-2" />
            <input type="text"
                class="w-80 bg-white dark:bg-gray-600 text-blue-950 dark:text-white border-2 border-gray-200 dark:border-gray-500 rounded-lg py-2 px-3 pl-10 focus:border-blue-600 dark:focus:border-white"
                placeholder="Search here...">
        </form>
    </div>

    <!-- Notif Badge -->
    <div class="relative inline-block">
        <div id="notif-btn"
            class="notif-btn text-blue-600 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-500 p-2 mr-3 rounded-lg cursor-pointer">
            <x-notif-icon class="size-7" />
        </div>
        <!-- Notif Menu -->
        <div id="notif-menu"
            class="notif-dropdown absolute hidden top-11 right-0 w-40 max-h-36 rounded-lg shadow-lg overflow-y-auto">
            <ul>
                <li class="cursor-pointer">
                    <a href="#" class="flex items-center pl-3 py-3 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 mr-2 text-blue-600">
                            <path
                                d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                        </svg>
                        Risma Cahaya
                    </a>
                </li>
                <li class="cursor-pointer">
                    <a href="#" class="flex items-center pl-3 py-3 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 mr-2 text-blue-600">
                            <path
                                d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                        </svg>
                        Nadia Fitri
                    </a>
                </li>
                <li class="cursor-pointer">
                    <a href="#" class="flex items-center pl-3 py-3 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 mr-2 text-blue-600">
                            <path
                                d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                        </svg>
                        Nadia Fitri
                    </a>
                </li>
                <li class="cursor-pointer">
                    <a href="#" class="flex items-center pl-3 py-3 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 mr-2 text-blue-600">
                            <path
                                d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                        </svg>
                        Nadia Fitri
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="relative inline-block">
        <!-- User Profile -->
        <div id="profile-btn"
            class="user-profile py-1 px-2 flex justify-center items-center rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-9 bg-blue-100 rounded-full p-1 mr-3">
                <path fill-rule="evenodd"
                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                    clip-rule="evenodd" />
            </svg>
            <div class="user-info mr-6">
                <p class="font-bold text-sm text-blue-950 dark:text-white">{{ Auth::user()->name }}</p>
                <p class="text-sm text-blue-950 dark:text-white">{{ Auth::user()->role }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-5 dark:text-white">
                <path fill-rule="evenodd"
                    d="M11.47 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 0 1-1.06-1.06l3.75-3.75Zm-3.75 9.75a.75.75 0 0 1 1.06 0L12 17.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <!-- User Menu -->
        <div id="profile-menu"
            class="drop-menu-user absolute hidden bg-white dark:bg-gray-700 text-blue-950 dark:text-white top-15 right-0 w-[156px] rounded-lg shadow-lg">
            <ul>
                <li class="cursor-pointer">
                    <a href="#"
                        class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 rounded-t-lg">
                        <x-profile-icon class="size-5 mr-2 text-blue-600 dark:text-white" />
                        Profile
                    </a>
                </li>
                <li class="cursor-pointer">
                    <a href="#"
                        class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 ">
                        <x-settings-icon class="size-5 mr-2 text-blue-600 dark:text-white" />
                        Setting
                    </a>
                </li>
                <li class="cursor-pointer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 rounded-b-lg">
                            <x-logout-icon class="size-5 mr-2 text-blue-600 dark:text-white" />
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- SideBar -->
<div class="container-sidebar relative flex flex-col items-center h-screen bg-white dark:bg-gray-700 shadow-xl">
    <!-- Logo -->
    <div class="logo m-0 py-6 flex justify-center items-center">
        <a href="{{ route('home') }}">
            <x-application-logo class="block h-9 w-auto fill-current" />
        </a>
    </div>

    <!-- Minimized Button -->
    <x-minimized-icon
        class="minimize-btn size-5 absolute w-10 h-10 -right-4 top-12 cursor-pointer bg-white dark:bg-gray-500 text-blue-600 dark:text-white p-2 rounded-full shadow-lg" />

    <!-- Navigation List -->
    <div class="nav-list w-full flex flex-col items-center overflow-auto overflow-x-hidden">
        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-dashboard-icon class="size-5 text-blue-600 dark:text-white" />
            <a href="#" class="text-nav text-blue-950 dark:text-white">Dashboard</a>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-teachers-icon class="size-5 dark:text-white text-blue-600" />
            <a href="#" class="text-nav text-blue-950 dark:text-white">Teachers</a>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-students-icon class="size-5 text-blue-600 dark:text-white" />
            <a href="#" class="text-nav text-blue-950 dark:text-white">Students</a>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-admin-staff-icon class="size-5 text-blue-600 dark:text-white" />
            <a href="#" class="text-nav text-blue-950 dark:text-white">Admin Staff</a>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-greetings-icon class="size-5 text-blue-600 dark:text-white" />
            <a href="#" class="text-nav text-blue-950 dark:text-white">Greeting</a>
        </div>

        <div class="nav-group w-full flex flex-col items-center">
            <div
                class="nav-item trigger-sublist relative gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                <x-activities-icon class="size-5 text-blue-600 dark:text-white" />
                <a href="#" class="text-nav text-blue-950 dark:text-white">Activities</a>
                <x-arrow-icon
                    class="arrow-icon size-4 absolute right-2 stroke-2 transition-transform duration-300 text-blue-600 dark:text-white" />
            </div>
            <div class="nav-sublist w-[85%] items-center block">
                <div class="sub-nav-item w-full flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-white" />
                    <a href="#" class="text-nav text-blue-950 dark:text-white">Extracurricular</a>
                </div>
                <div
                    class="sub-nav-item w-full my-2 flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-white" />
                    <a href="#" class="text-nav text-blue-950 dark:text-white">Events</a>
                </div>
            </div>
        </div>

        <div class="nav-item gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
            <x-facilities-icon class="size-5 text-blue-600 dark:text-white" />

            <a href="#" class="text-nav text-blue-950 dark:text-white">Facilities</a>
        </div>

        <div class="nav-group w-full flex flex-col items-center">
            <div
                class="nav-item trigger-sublist relative gap-2 w-[85%] my-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                <x-information-icon class="size-5 text-blue-600 dark:text-white" />
                <a href="#" class="text-nav text-blue-950 dark:text-white">Informations</a>
                <x-arrow-icon
                    class="arrow-icon size-4 absolute right-2 stroke-2 transition-transform duration-300 text-blue-600 dark:text-white" />
            </div>
            <div class="nav-sublist w-[85%] items-center block">
                <div class="sub-nav-item w-full flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-white" />
                    <a href="#" class="text-nav text-blue-950 dark:text-white">Article</a>
                </div>
                <div
                    class="sub-nav-item w-full my-2 flex gap-2 rounded-lg py-2.5 hover:bg-gray-200 dark:hover:bg-gray-500">
                    <x-sub-nav-icon class="size-5 text-blue-600 dark:text-white" />
                    <a href="#" class="text-nav text-blue-950 dark:text-white">Any Informations</a>
                </div>
            </div>
        </div>
    </div>
</div>
