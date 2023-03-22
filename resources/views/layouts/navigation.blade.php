<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    @php
        $user = auth()->user();
    @endphp
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <span class="material-symbols-rounded text-greenButtons text-4xl">pets</span>
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="flex items-center min-w-max">
                <form class="hidden md:block" method="GET" action="{{ route('search') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-row items-center">
                        @if (request()->routeIs('organisations.index'))
                            <!-- Search Type Input That is Hidden -->
                            <input type="hidden" id="search-type" name="category" value="Organisations">
                            <!-- Dropdown Main -->
                            <button id="dropdown-button" data-dropdown-toggle="dropdown-search-type"
                                class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">
                                <span class="material-symbols-rounded text-greenButtons">home_work</span>
                                Organisations <svg aria-hidden="true" class="w-4 h-4" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @elseif (request()->routeIs('users.index'))
                            <!-- Search Type Input That is Hidden -->
                            <input type="hidden" id="search-type" name="category" value="Users">
                            <!-- Dropdown Main -->
                            <button id="dropdown-button" data-dropdown-toggle="dropdown-search-type"
                                class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">
                                <span class="material-symbols-rounded text-greenButtons">group</span>
                                Users <svg aria-hidden="true" class="w-4 h-4" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @else
                            <!-- Search Type Input That is Hidden -->
                            <input type="hidden" id="search-type" name="category" value="Vacancies">
                            <!-- Dropdown Main -->
                            <button id="dropdown-button" data-dropdown-toggle="dropdown-search-type"
                                class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">
                                <span class="material-symbols-rounded text-greenButtons">work</span>
                                Vacancies <svg aria-hidden="true" class="w-4 h-4" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @endif
                        <!-- Dropdown Contents -->
                        <div id="dropdown-search-type"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40">
                            <ul id="list" class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                                <li>
                                    <button type="button"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem" id="Vacancies">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="material-symbols-rounded text-greenButtons">
                                                work
                                            </span>
                                            Vacancies
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" id="Organisations"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="material-symbols-rounded text-greenButtons">
                                                home_work
                                            </span>
                                            Organisations
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" id="Users"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="material-symbols-rounded text-greenButtons">
                                                group
                                            </span>
                                            Users
                                        </div>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Serarch Contents -->
                        <div class="relative w-200 md:w-250 lg:w-400">
                            @if (request()->routeIs('organisations.index'))
                                <!-- Search Input -->
                                <input type="search" id="navbar-search" name="search"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Search in Organisations" required>
                            @elseif (request()->routeIs('users.index'))
                                <!-- Search Input -->
                                <input type="search" id="navbar-search" name="search"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Search in Users" required>
                            @else
                                <!-- Search Input -->
                                <input type="search" id="navbar-search" name="search"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Search in Vacancies" required>
                            @endif
                            <!-- Search Buttons -->
                            <button type="submit"
                                class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-greenButtons rounded-r-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Javascript that makes the buttons work. -->
                <script>
                    // Close the dropdown if the user clicks on a menu item
                    document.querySelectorAll('#list button').forEach(function(element) {
                        element.addEventListener('click', function(event) {
                            document.getElementById('dropdown-search-type').classList.remove('block');
                            document.getElementById('dropdown-search-type').classList.add('hidden');
                        });
                    });
                    // Close the dropdown if the user clicks outside of it
                    window.addEventListener('click', function(event) {
                        if (!event.target.matches('#dropdown-button')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('block')) {
                                    openDropdown.classList.remove('block');
                                    openDropdown.classList.add('hidden');
                                }
                            }
                        }
                    });
                    // Change the dropdown button text to the selected option
                    document.querySelectorAll('#list button').forEach(function(element) {
                        element.addEventListener('click', function(event) {
                            document.getElementById('dropdown-button').innerHTML = element.innerHTML +
                                '<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">' +
                                '<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"' +
                                'clip-rule="evenodd"></path>' +
                                '</svg>';
                            // Change the search type value to the selected option
                            document.getElementById('search-type').value = element.id;

                            // Change the search input placeholder to the selected option
                            document.getElementById('navbar-search').placeholder = 'Search in ' + element.id;
                        });
                    });
                </script>
            </div>

            <div class="flex gap-2">
                <!-- Navigation Links -->
                <div class="hidden space-x-5 sm:-my-px sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <span class="material-symbols-rounded text-greenButtons text-3xl">work</span>
                    </x-nav-link>
                    <x-nav-link :href="route('organisations.index')" :active="request()->routeIs('organisations.index')">
                        <span class="material-symbols-rounded text-greenButtons text-3xl">home_work</span>
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        <span class="material-symbols-rounded text-greenButtons text-3xl">group</span>
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <span class="material-symbols-rounded text-greenButtons text-3xl">settings</span>
                    </x-nav-link>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <img class="w-10 h-10 rounded-full border-greenButtons border-2"
                                    src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png') }}"
                                    alt="Rounded avatar">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="/users/{{ $user->id }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2.5 rounded-md text-greenButtons hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('search')" :active="request()->routeIs('search')">
                {{ __('Search') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Vacancies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('organisations.index')" :active="request()->routeIs('organisations.index')">
                {{ __('Organisations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Settings') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex flex-col gap-1">
                @if ($user->is_admin)
                    <div class="flex flex-row gap-1 items-center mt-3 bg-red-800 p-1 rounded-md w-max">
                        <span class="material-symbols-rounded text-white">
                            admin_panel_settings
                        </span>
                        <p class="text-xs text-white font-bold text-center">Administrator</p>
                    </div>
                @endif
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->username }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="/users/{{ $user->id }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
