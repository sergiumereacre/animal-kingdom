<x-app-layout>
    <div>
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
                <x-input-label for="can_swim_requirement">Should applicants be able to swim?</x-input-label>
                <x-select onchange="updateQuery()" name="can_swim_requirement" id="can_swim_requirement"
                    class="mt-1 block w-full">
                    <option value="NULL">Doesn't matter</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('can_swim_requirement')" />
            </div>

            <div>
                <x-input-label for="can_climb_requirement">Should applicants be able to climb?</x-input-label>
                <x-select onchange="updateQuery()" name="can_climb_requirement" id="can_climb_requirement"
                    class="mt-1 block w-full">
                    <option value="NULL">Doesn't matter</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('can_climb_requirement')" />
            </div>

            <div>
                <x-input-label for="eating_style_requirement">Eating Style Requirement</x-input-label>
                <x-select onchange="updateQuery()" name="eating_style_requirement" id="eating_style_requirement"
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
                <x-select onchange="updateQuery()" name="produces_toxins_requirement" id="produces_toxins_requirement"
                    class="mt-1 block w-full">
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
                <x-select onchange="updateQuery()" name="num_appendages_requirement" id="num_appendages_requirement"
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
                <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full" placeholder=""
                    value="{{ old('skills') }}"></x-text-input>
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
                    <p id="skills_error" hidden class="text-center text-white bg-redButtons w-max px-2 rounded-lg">
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

            @error('qualifications')
                <p>{{ $message }}</p>
            @enderror


            <div class="flex justify-center gap-2 md:gap-5">
                {{-- Possibly go straight to the created organisation page? --}}
                <a id="final_query" href="/users/index/?=">
                    <x-primary-button class="flex flex-row gap-2 items-center">
                        <span class="material-symbols-rounded">
                            work
                        </span>
                        Search with filters
                    </x-primary-button>
                </a>

            </div>
        </div>

        <script>
            var final_query = document.getElementById("final_query");

            function updateQuery() {
                final_query.href = "/users/index/?";
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
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($users as $user)
            <x-user-card :user="$user" />
        @endforeach
    </div>
    <div class="p-10">
        {{ $users->links() }}
    </div>
</x-app-layout>
