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


    <div class="flex items-center justify-center md:pt-10">
        <!-- Dropdown button-->
        <button type="button" id="filter-dropdown-button" data-dropdown-toggle="filter-dropdown-filter-type"
            class="inline-flex items-center justify-center w-max px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <span class="material-symbols-rounded text-greenButtons">
                filter_alt
            </span>Filter
        </button>
        <!-- Dropdown content -->
        <div id="filter-dropdown-filter-type"
            class="hidden absolute w-fit mt-2 origin-top-right bg-white border divide-y divide-gray-100 md:rounded-2xl focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="filter-dropdown-button">
            <div class="p-10 flex flex-col items-center gap-5">
                <div class="flex flex-col gap-5 md:w-full">

                    <div>
                        <x-input-label for="category_requirement">Category</x-input-label>
                        <x-select onchange="updateQuery()" name="category_requirement" id="category_requirement"
                            class="mt-1 block w-full">
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
                        <x-select onchange="updateQuery()" name="can_fly_requirement" id="can_fly_requirement"
                            class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_fly_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="can_swim_requirement">Should applicants be able to swim?
                        </x-input-label>
                        <x-select onchange="updateQuery()" name="can_swim_requirement" id="can_swim_requirement"
                            class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_swim_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="can_climb_requirement">Should applicants be able to climb?
                        </x-input-label>
                        <x-select onchange="updateQuery()" name="can_climb_requirement"
                            id="can_climb_requirement" class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_climb_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="eating_style_requirement">Eating Style Requirement</x-input-label>
                        <x-select onchange="updateQuery()" name="eating_style_requirement"
                            id="eating_style_requirement" class="mt-1 block w-full">
                            <option value="NULL">None</option>
                            <option value="HERBIVORE">Herbivore</option>
                            <option value="CARNIVORE">Carnivore</option>
                            <option value="OMNIVORE">Omnivore</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('eating_style_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="produces_toxins_requirement">Should applicants be able to produce
                            toxins?
                        </x-input-label>
                        <x-select onchange="updateQuery()" name="produces_toxins_requirement"
                            id="produces_toxins_requirement" class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('produces_toxins_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="size_requirement">Size Requirement</x-input-label>
                        <x-select onchange="updateQuery()" name="size_requirement" id="size_requirement"
                            class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>
                            <option value="SMALL">Small</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LARGE">Large</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('size_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="speed_requirement">Speed Requirement</x-input-label>
                        <x-select onchange="updateQuery()" name="speed_requirement" id="speed_requirement"
                            class="mt-1 block w-full">
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
                        <x-select onchange="updateQuery()" name="num_appendages_requirement"
                            id="num_appendages_requirement" class="mt-1 block w-full">
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
                                class="text-center text-white bg-redButtons w-max px-2 rounded-lg">
                                Can't have duplicate
                                skills.</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <x-primary-button class="w-max" onclick="addSkill()" type="button">Add Skill
                            </x-primary-button>
                        </div>
                    </div>

                    @error('skills')
                        <p>{{ $message }}</p>
                    @enderror

                    <div>
                        <x-input-label for="qualifications">All qualifications applicants should have. Please
                            separate
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
                            <x-select id="qualification_name" name="qualifications_select"
                                class="mt-1 block w-full">
                                @foreach ($qualifications as $qualification)
                                    <option value="{{ $qualification->qualification_name }}">
                                        {{ $qualification->qualification_name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="flex flex-col items-center">
                            <p id="qualifications_error" hidden
                                class="text-center text-white bg-redButtons w-max px-2 rounded-lg">Can't have
                                duplicate
                                qualifications.</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <x-primary-button onclick="addQualification()" type="button">Add Qualification
                            </x-primary-button>
                        </div>
                    </div>

                    @error('qualifications')
                        <p>{{ $message }}</p>
                    @enderror


                    <div class="flex justify-center gap-2 md:gap-5">
                        {{-- Possibly go straight to the created organisation page? --}}
                        <a id="final_query" href="/vacancies/index/?=">
                            <x-primary-button class="flex flex-row gap-2 items-center">
                                <span class="material-symbols-rounded">
                                    work
                                </span>
                                Search with filters
                            </x-primary-button>
                        </a>

                        <a id="recommended" href="/vacancies/recommended">
                            <x-primary-button class="flex flex-row gap-2 items-center">
                                <span class="material-symbols-rounded">
                                    work
                                </span>
                                Get Suitable Vacancies
                            </x-primary-button>
                        </a>

                    </div>
                </div>

                <script>
                    var final_query = document.getElementById("final_query");

                    function updateQuery() {
                        final_query.href = "/vacancies/index/?";
                        var cat = document.getElementById("category_requirement");
                        if (cat.value != "NULL") {
                            final_query.href += "category=" + cat.value + "&";
                        }

                        var fly = document.getElementById("can_fly_requirement");
                        if (fly.value != "NULL") {
                            final_query.href += "can_fly=" + fly.value + "&";
                        }

                        var swim = document.getElementById("can_swim_requirement");
                        if (swim.value != "NULL") {
                            final_query.href += "can_swim=" + swim.value + "&";
                        }

                        var climb = document.getElementById("can_climb_requirement");
                        if (climb.value != "NULL") {
                            final_query.href += "can_climb=" + climb.value + "&";
                        }

                        var eating_style = document.getElementById("eating_style_requirement");
                        if (eating_style.value != "NULL") {
                            final_query.href += "eating_style=" + eating_style.value + "&";
                        }

                        var produces_toxins = document.getElementById("produces_toxins_requirement");
                        if (produces_toxins.value != "NULL") {
                            final_query.href += "produces_toxins=" + produces_toxins.value + "&";
                        }

                        var size = document.getElementById("size_requirement");
                        if (size.value != "NULL") {
                            final_query.href += "size=" + size.value + "&";
                        }

                        var speed = document.getElementById("speed_requirement");
                        if (speed.value != "NULL") {
                            final_query.href += "speed=" + speed.value + "&";
                        }

                        var num_appendages = document.getElementById("num_appendages_requirement");
                        if (num_appendages.value != "NULL") {
                            final_query.href += "num_appendages=" + num_appendages.value + "&";
                        }

                        var skills = document.getElementById("skills_list");
                        console.log("Value: " + skills.value);
                        if (skills.value != "NULL") {
                            final_query.href += "skills=" + skills.value + "&";
                        }

                        var quals = document.getElementById("qualifications_list");
                        console.log("Value: " + quals.value);
                        if (quals.value != "NULL") {
                            final_query.href += "qualifications=" + quals.value + "&";
                        }

                        console.log(final_query);

                    }

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
                        updateQuery();

                    }

                    function addQualification() {

                        var qualifications_error = document.getElementById('qualifications_error');
                        var qualification_name = document.getElementById('qualification_name').value;

                        if (document.getElementById('qualifications_list').value.includes(qualification_name)) {
                            qualifications_error.style.display = "block";
                        } else {
                            document.getElementById('qualifications_list').value += qualification_name.concat(",");
                            qualifications_error.style.display = "none";
                        }
                        updateQuery();

                    }
                </script>

            </div>
        </div>



    </div>

    <div class="pt-10 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($vacancies as $vacancy)
            @php
                $organisation = App\Models\Organisation::all()
                    ->where('organisation_id', '=', $vacancy->organisation_id)
                    ->first();
            @endphp
            <x-vacancy :vacancy="$vacancy" :organisation="$organisation" />
        @endforeach
    </div>
    <div class="p-10">
        {{ $vacancies->links() }}
    </div>
{{--
    <div class="pt-5 md:pt-10 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
    </div> --}}
</x-app-layout>
