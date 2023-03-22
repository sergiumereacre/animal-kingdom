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

    <div>
        <form method="POST" action="/users/filter" enctype="multipart/form-data"
            class="p-10 flex flex-col items-center gap-5">
            {{-- This tag makes it so that not anyone can just send a form pointed towards this URL --}}
            @csrf
            <div class="flex flex-col gap-5 md:w-full">

                <div>
                    <x-input-label for="category_requirement">Category Requirement</x-input-label>
                    <x-select name="category_requirement" id="category_requirement" class="mt-1 block w-full">
                        <option value="NULL">None</option>
                        <option value="MAMMAL">Mammal</option>
                        <option value="REPTILE">Reptile</option>
                        <option value="AMPHIBIAN">Amphibian</option>
                        <option value="AVIAN">Avian</option>
                        <option value="FISH">Fish</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('category_requirement')" />
                </div>

                <div>
                    <x-input-label for="can_fly_requirement">Should applicants be able to fly?</x-input-label>
                    <x-select name="can_fly_requirement" id="can_fly_requirement" class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('can_fly_requirement')" />
                </div>

                <div>
                    <x-input-label for="can_swim_requirement">Should applicants be able to swim?</x-input-label>
                    <x-select name="can_swim_requirement" id="can_swim_requirement" class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('can_swim_requirement')" />
                </div>

                <div>
                    <x-input-label for="can_climb_requirement">Should applicants be able to climb?</x-input-label>
                    <x-select name="can_climb_requirement" id="can_climb_requirement" class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('can_climb_requirement')" />
                </div>

                <div>
                    <x-input-label for="eating_style_requirement">Eating Style Requirement</x-input-label>
                    <x-select name="eating_style_requirement" id="eating_style_requirement"
                        class="mt-1 block w-full">
                        <option value="NULL">None</option>
                        <option value="HERBIVORE">Herbivore</option>
                        <option value="CARNIVORE">Carnivore</option>
                        <option value="OMNIVORE">Omnivore</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('eating_style_requirement')" />
                </div>

                <div>
                    <x-input-label for="produces_toxins_requirement">Should applicants be able to produce toxins?
                    </x-input-label>
                    <x-select name="produces_toxins_requirement" id="produces_toxins_requirement"
                        class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('produces_toxins_requirement')" />
                </div>

                <div>
                    <x-input-label for="size_requirement">Size Requirement</x-input-label>
                    <x-select name="size_requirement" id="size_requirement" class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="SMALL">Small</option>
                        <option value="MEDIUM">Medium</option>
                        <option value="LARGE">Large</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('size_requirement')" />
                </div>

                <div>
                    <x-input-label for="speed_requirement">Speed Requirement</x-input-label>
                    <x-select name="speed_requirement" id="speed_requirement" class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="SLOW">Slow</option>
                        <option value="MEDIUM">Medium</option>
                        <option value="FAST">Fast</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('speed_requirement')" />
                </div>

                <div>
                    <x-input-label for="num_appendages_requirement">How many appendages should applicants have?
                    </x-input-label>
                    <x-select name="num_appendages_requirement" id="num_appendages_requirement"
                        class="mt-1 block w-full">
                        <option value="NULL">Doesn't matter</option>
                        <option value="NONE">No Appendages</option>
                        <option value="FEW">Few Appendages, e.g., 4</option>
                        <option value="MANY">Many Appendages</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('num_appendages_requirement')" />
                </div>

                <div>
                    <x-input-label for="skills">All skills applicants should have. Please specify skill level
                        with colon and
                        separate with commas.</x-input-label>
                    <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full"
                        placeholder="" value="{{ old('skills') }}"></x-text-input>
                </div>

                <div class="flex flex-col gap-5">
                    @php
                        $skills = App\Models\Skill::all();
                    @endphp

                    <div>
                        <x-input-label for="skills_select">Select specific skill.</x-input-label>
                        <x-select id="skill_name" name="skills_select" class="mt-1 block w-full">
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->skill_name }}">{{ $skill->skill_name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div>
                        <x-input-label for="skills_level_select">Select skill level.</x-input-label>
                        <x-select id="skill_level" name="skills_level_select" class="mt-1 block w-full">
                            <option value="BEGINNER">Beginner</option>
                            <option value="INTERMEDIATE">Intermediate</option>
                            <option value="EXPERT">Expert</option>
                        </x-select>
                    </div>

                    <div class="flex flex-col items-center">
                        <p id="skills_error" hidden
                            class="text-center text-white bg-redButtons w-max px-2 rounded-lg">Can't have duplicate
                            skills.</p>
                    </div>

                    <div class="flex flex-col items-center">
                        <x-primary-button class="w-max" onclick="addSkill()" type="button">Add Skill
                        </x-primary-button>
                    </div>
                </div>

                <script>
                    function addSkill() {
                        var skills_error = document.getElementById('skills_error');
                        var skill_name = document.getElementById('skill_name').value;
                        var skill_level = document.getElementById('skill_level').value;

                        if (document.getElementById('skills_list').value.includes(skill_name)) {
                            skills_error.style.display = "block";
                        } else {
                            document.getElementById('skills_list').value += skill_name.concat(":", skill_level, ",");
                            skills_error.style.display = "none";
                        }
                    }
                </script>

                @error('skills')
                    <p>{{ $message }}</p>
                @enderror

                <div>
                    <x-input-label for="qualifications">All qualifications applicants should have. Please separate
                        with
                        commas.</x-input-label>
                    <x-text-input id="qualifications_list" type="text" name="qualifications"
                        class="mt-1 block w-full" placeholder="" value="{{ old('qualifications') }}">
                    </x-text-input>
                </div>
                <div class="flex flex-col gap-5">

                    @php
                        $qualifications = App\Models\Qualification::all();
                    @endphp

                    <div>
                        <x-input-label for="qualifications_select">Select qualifications here</x-input-label>
                        <x-select id="qualification_name" name="qualifications_select" class="mt-1 block w-full">
                            @foreach ($qualifications as $qualification)
                                <option value="{{ $qualification->qualification_name }}">
                                    {{ $qualification->qualification_name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="flex flex-col items-center">
                        <p id="qualifications_error" hidden
                            class="text-center text-white bg-redButtons w-max px-2 rounded-lg">Can't have duplicate
                            qualifications.</p>
                    </div>

                    <div class="flex flex-col items-center">
                        <x-primary-button onclick="addQualification()" type="button">Add Qualification
                        </x-primary-button>
                    </div>
                </div>

                <script>
                    function addQualification() {
                        var qualifications_error = document.getElementById('qualifications_error');
                        var qualification_name = document.getElementById('qualification_name').value;

                        if (document.getElementById('qualifications_list').value.includes(qualification_name)) {
                            qualifications_error.style.display = "block";
                        } else {
                            document.getElementById('qualifications_list').value += qualification_name.concat(",");
                            qualifications_error.style.display = "none";
                        }
                    }
                </script>

                @error('qualifications')
                    <p>{{ $message }}</p>
                @enderror


                <div class="flex justify-center gap-2 md:gap-5">
                    {{-- Possibly go straight to the created organisation page? --}}
                    <x-primary-button class="flex flex-row gap-2 items-center">
                        <span class="material-symbols-rounded">
                            work
                        </span>
                        Search with filters
                    </x-primary-button>
                </div>
            </div>
        </form>

    </div>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($users as $user)
            <x-user-card :user="$user" />
        @endforeach
    </div>
    <div class="p-10">
        {{ $users->links() }}
    </div>
</x-app-layout>
