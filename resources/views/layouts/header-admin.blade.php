<!-- Header -->
<div
    class="container-header sticky top-0 w-full bg-white dark:bg-gray-800 flex justify-between items-center px-8 py-4 shadow-sm border border-gray-100 dark:border-gray-700 z-30">
    <!-- Form Search -->
    <div class="form-search">
        <form class="relative">
            <x-search-icon class="text-blue-600 dark:text-gray-200 size-6 absolute top-2 left-2 stroke-2" />
            <input type="text"
                class="w-80 bg-white dark:bg-gray-800 text-blue-950 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-600 rounded-lg py-2 px-3 pl-10 focus:border-blue-600 focus:dark:border-gray-400"
                placeholder="Search here...">
        </form>
    </div>

    <div class="flex items-center">
        <!-- Notif Badge -->
        <div class="relative inline-block">
            <div id="notif-btn"
                class="notif-btn text-blue-600 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500 p-2 mr-3 rounded-lg cursor-pointer">
                <x-notif-icon class="size-7" />
            </div>
            <!-- Notif Menu -->
            <div id="notif-menu"
                class="notif-dropdown bg-white dark:bg-gray-700 text-blue-950 dark:text-gray-200 absolute hidden top-11 right-0 w-40 max-h-36 rounded-lg shadow-lg overflow-y-auto">
                <ul>
                    <li class="cursor-pointer">
                        <a href="#" class="flex items-center pl-3 py-3 w-full">
                            <x-mail-icon class="size-4 mr-2 text-blue-600 dark:text-gray-100" />
                            Risma Cahaya
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <a href="#" class="flex items-center pl-3 py-3 w-full">
                            <x-mail-icon class="size-4 mr-2 text-blue-600 dark:text-gray-100" />
                            Nadia Fitri
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <a href="#" class="flex items-center pl-3 py-3 w-full">
                            <x-mail-icon class="size-4 mr-2 text-blue-600 dark:text-gray-100" />
                            Nadia Fitri
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <a href="#" class="flex items-center pl-3 py-3 w-full">
                            <x-mail-icon class="size-4 mr-2 text-blue-600 dark:text-gray-100" />
                            Nadia Fitri
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- User Profile -->
        <div class="relative inline-block">
            <div id="profile-btn"
                class="user-profile py-1 px-2 flex justify-center items-center rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500">
                @if (Auth::user()->photo)
                    <div class="w-9 mr-3">
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" class="rounded-full">
                    </div>
                @else
                    <x-profile-icon class="size-9 bg-blue-100 rounded-full p-1 mr-3" />
                @endif
                <div class="user-info mr-6">
                    <p class="font-bold text-sm text-blue-950 dark:text-gray-200">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-blue-950 dark:text-gray-200">{{ Auth::user()->role }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-5 dark:text-gray-200">
                    <path fill-rule="evenodd"
                        d="M11.47 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 0 1-1.06-1.06l3.75-3.75Zm-3.75 9.75a.75.75 0 0 1 1.06 0L12 17.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <!-- User Menu -->
            <div id="profile-menu"
                class="drop-menu-user absolute hidden bg-white dark:bg-gray-700 text-blue-950 dark:text-gray-200 top-15 right-0 w-[156px] rounded-lg shadow-lg">
                <ul>
                    <li class="cursor-pointer">
                        <a href="#"
                            class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 rounded-t-lg">
                            <x-profile-icon class="size-5 mr-2 text-blue-600 dark:text-gray-200" />
                            Profile
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <a href="#"
                            class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 ">
                            <x-settings-icon class="size-5 mr-2 text-blue-600 dark:text-gray-200" />
                            Setting
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center pl-5 py-3 w-full hover:bg-gray-200 dark:hover:bg-gray-500 rounded-b-lg">
                                <x-logout-icon class="size-5 mr-2 text-blue-600 dark:text-gray-200" />
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
