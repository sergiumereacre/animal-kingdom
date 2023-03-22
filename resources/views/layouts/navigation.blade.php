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

                <!-- Search Bar -->
                <div class="flex items-center pl-2">
                    <x-search-dropdown>
                        <x-slot name="trigger">
                            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-greenButtons hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-300 rounded-lg text-sm p-2.5 mr-1">
                                <svg class="w-7 h-7" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="flex flex-row items-center gap-5">
                                <x-text-input class="border border-greenButtons shadow-none w-64 h-8 rounded-2xl focus:outline-none focus:ring-0 pl-2"></x-text-input>
                                <x-primary-button @click="open = false">Search</x-primary-button>
                            </div>
                        </x-slot>
                    </x-search-dropdown>
                    <div class="relative hidden md:block md:pl-5">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 md:pl-8 pointer-events-none">
                            <svg class="w-5 h-5 text-greenButtons" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <input type="text" id="search-navbar" class="placeholder-greenButtons block w-80 px-2 pl-11 font-medium text-sm text-greenButtons rounded-xl bg-appBackground border-none focus:ring-green-500 focus:border-green-500" placeholder="Search">
                    </div>
                </div>
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
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <img class="w-10 h-10 rounded-full border-greenButtons border-2" src="{{$user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png')}}" alt="Rounded avatar">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="/users/{{$user->id}}">
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-md text-greenButtons hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
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
            <div class="px-4">
                @if ($user->is_admin)
                    <div class="font-bold text-sm text-red-500">Admin</div>
                @endif
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->username }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="/users/{{$user->id}}">
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
