<x-app-layout>

    <div class="flex items-center min-w-full max-w-none pt-10 pb-5 px-5 md:hidden">
        <form class="w-full" method="GET" action="{{ route('search') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row items-center">
                @if (request()->routeIs('organisations.index'))
                    <!-- Search Type Input That is Hidden -->
                    <input type="hidden" id="main-search-type" name="category" value="Organisations">
                    <!-- Dropdown Main -->
                    <button id="main-dropdown-button" data-dropdown-toggle="main-dropdown-search-type"
                        class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-50 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                        type="button">
                        <span class="material-symbols-rounded text-greenButtons">home_work</span>
                        Organisations <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @elseif (request()->routeIs('users.index'))
                    <!-- Search Type Input That is Hidden -->
                    <input type="hidden" id="main-search-type" name="category" value="Users">
                    <!-- Dropdown Main -->
                    <button id="main-dropdown-button" data-dropdown-toggle="main-dropdown-search-type"
                        class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-50 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                        type="button">
                        <span class="material-symbols-rounded text-greenButtons">group</span>
                        Users <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @else
                    <!-- Search Type Input That is Hidden -->
                    <input type="hidden" id="main-search-type" name="category" value="Vacancies">
                    <!-- Dropdown Main -->
                    <button id="main-dropdown-button" data-dropdown-toggle="main-dropdown-search-type"
                        class="gap-2 flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-500 bg-gray-50 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                        type="button">
                        <span class="material-symbols-rounded text-greenButtons">work</span>
                        Vacancies <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
                <!-- Dropdown Contents -->
                <div id="main-dropdown-search-type"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40">
                    <ul id="main-list" class="py-2 text-sm text-gray-700" aria-labelledby="main-dropdown-button">
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
                <div class="relative w-full">
                    @if (request()->routeIs('organisations.index'))
                        <!-- Search Input -->
                        <input type="search" id="main-navbar-search" name="search"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search in Organisations" required>
                    @elseif (request()->routeIs('users.index'))
                        <!-- Search Input -->
                        <input type="search" id="main-navbar-search" name="search"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search in Users" required>
                    @else
                        <!-- Search Input -->
                        <input type="search" id="main-navbar-search" name="search"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-green-500 focus:border-green-500"
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
            document.querySelectorAll('#main-list button').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    document.getElementById('main-dropdown-search-type').classList.remove('block');
                    document.getElementById('main-dropdown-search-type').classList.add('hidden');
                });
            });
            // Close the dropdown if the user clicks outside of it
            window.addEventListener('click', function(event) {
                if (!event.target.matches('#main-dropdown-button')) {
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
            document.querySelectorAll('#main-list button').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    document.getElementById('main-dropdown-button').innerHTML = element.innerHTML +
                        '<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">' +
                        '<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"' +
                        'clip-rule="evenodd"></path>' +
                        '</svg>';
                    // Change the search type value to the selected option
                    document.getElementById('main-search-type').value = element.id;
                    // Change the search input placeholder to the selected option
                    document.getElementById('main-navbar-search').placeholder = 'Search in ' + element.id;
                });
            });
        </script>
    </div>

    <div class="pt-5 md:pt-10 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($organisations as $organisation)
            <x-organisation-card :organisation="$organisation"></x-organisation-card>
        @endforeach
    </div>

    <div class="p-10">
        {{ $organisations->links() }}
    </div>
</x-app-layout>
