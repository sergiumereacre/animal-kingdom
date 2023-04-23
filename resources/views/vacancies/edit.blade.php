<x-app-layout>
    <div class="py-12 flex flex-col items-center max-w-2xl mx-auto">
        <x-card-base>
            <form method="POST" action="/vacancies/{{ $vacancy->vacancy_id }}" enctype="multipart/form-data"
                onsubmit="return validateForm()" class="p-10 flex flex-col items-center gap-5">
                @csrf
                @method('PUT')
                <!-- Form Title -->

                {{-- Getting value for skills as text --}}
                @php
                    $final_text_skills = '';
                    $skills_vacancies = App\Models\SkillsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);
                    
                    // We need to get the level and name of each
                    foreach ($skills_vacancies as $skills_vacancy) {
                        $skill_name = App\Models\Skill::where('skill_id', '=', $skills_vacancy->skill_id)->first()->skill_name;
                    
                        // dd($skill_name);
                    
                        $skill_level = $skills_vacancy->skill_level;
                    
                        $current_skill_text = $skill_name . ':' . $skill_level . ',';
                        $final_text_skills = $final_text_skills . $current_skill_text;
                        // dd($current_skill_text);
                    }
                    
                    $final_text_quals = '';
                    $quals_vacancies = App\Models\QualificationsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);
                    
                    foreach ($quals_vacancies as $quals_vacancy) {
                        $qual_name = App\Models\Qualification::where('qualification_id', '=', $quals_vacancy->qualification_id)->first()->qualification_name;
                    
                        $current_qual_text = $qual_name . ',';
                        $final_text_quals = $final_text_quals . $current_qual_text;
                    }
                    
                    // dd($final_text_quals);
                    
                @endphp

                <div>
                    <p class="font-bold text-2xl md:text-3xl">Edit Vacancy: {{ $vacancy->vacancy_title }} </p>
                </div>

                <input type="hidden" name="organisation_id" value="{{ $vacancy->organisation_id }}">

                <div class="flex flex-col gap-5 md:w-full">
                    <div>
                        <x-input-label for="vacancy_title">Vacancy Title</x-input-label>
                        <x-text-input type="text" name="vacancy_title" class="mt-1 block w-full" placeholder=""
                            value="{{ $vacancy->vacancy_title }}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('vacancy_title')" />
                    </div>


                    <div>
                        <x-input-label for="category_requirement">Category Requirement</x-input-label>
                        <x-select name="category_requirement" id="category_requirement" class="mt-1 block w-full">
                            @php
                                // Generate a list of all the categories, and set the selected one to the current category
                                $categories = ['MAMMAL', 'REPTILE', 'AMPHIBIAN', 'AVIAN', 'FISH'];
                                
                                // list of eating styles
                                $eating_styles = ['HERBIVORE', 'CARNIVORE', 'OMNIVORE'];
                                
                                // list of size_requirements
                                $size_requirements = ['SMALL', 'MEDIUM', 'LARGE'];
                                
                                // List of speed_requirements
                                $speed_requirements = ['SLOW', 'MEDIUM', 'FAST'];
                                
                                // list of num_appendages_requirements
                                $num_appendages_requirements = ['NONE', 'FEW', 'MANY'];
                                
                            @endphp

                            <option value="NULL">None</option>

                            @foreach ($categories as $category)
                                @if ($category == $vacancy->category_requirement)
                                    <option value="{{ $category }}" selected>{{ ucfirst(strtolower($category)) }}
                                    </option>
                                @else
                                    <option value="{{ $category }}">{{ ucfirst(strtolower($category)) }}</option>
                                @endif
                            @endforeach
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="can_fly_requirement">Should applicants be able to fly?</x-input-label>
                        <x-select name="can_fly_requirement" id="can_fly_requirement" class="mt-1 block w-full">

                            @if ($vacancy->can_fly_requirement == 'NULL')
                                <option value="NULL" selected>Doesn't matter</option>
                            @else
                                <option value="NULL">Doesn't matter</option>
                            @endif
                            @if ($vacancy->can_fly_requirement == '1')
                                <option value="1" selected>Yes</option>
                            @else
                                <option value="1">Yes</option>
                            @endif
                            @if ($vacancy->can_fly_requirement == '0')
                                <option value="0" selected>No</option>
                            @else
                                <option value="0">No</option>
                            @endif


                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_fly_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="can_swim_requirement">Should applicants be able to swim?</x-input-label>
                        <x-select name="can_swim_requirement" id="can_swim_requirement" class="mt-1 block w-full">

                            @if ($vacancy->can_swim_requirement == 'NULL')
                                <option value="NULL" selected>Doesn't matter</option>
                            @else
                                <option value="NULL">Doesn't matter</option>
                            @endif
                            @if ($vacancy->can_swim_requirement == '1')
                                <option value="1" selected>Yes</option>
                            @else
                                <option value="1">Yes</option>
                            @endif
                            @if ($vacancy->can_swim_requirement == '0')
                                <option value="0" selected>No</option>
                            @else
                                <option value="0">No</option>
                            @endif
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_swim_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="can_climb_requirement">Should applicants be able to climb?</x-input-label>
                        <x-select name="can_climb_requirement" id="can_climb_requirement" class="mt-1 block w-full">

                            @if ($vacancy->can_climb_requirement == 'NULL')
                                <option value="NULL" selected>Doesn't matter</option>
                            @else
                                <option value="NULL">Doesn't matter</option>
                            @endif
                            @if ($vacancy->can_climb_requirement == '1')
                                <option value="1" selected>Yes</option>
                            @else
                                <option value="1">Yes</option>
                            @endif
                            @if ($vacancy->can_climb_requirement == '0')
                                <option value="0" selected>No</option>
                            @else
                                <option value="0">No</option>
                            @endif
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('can_climb_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="eating_style_requirement">Eating Style Requirement</x-input-label>
                        <x-select name="eating_style_requirement" id="eating_style_requirement"
                            class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>

                            @foreach ($eating_styles as $eating_style)
                                @if ($eating_style == $vacancy->eating_style_requirement)
                                    <option value="{{ $eating_style }}" selected>
                                        {{ ucfirst(strtolower($eating_style)) }}
                                    </option>
                                @else
                                    <option value="{{ $eating_style }}">{{ ucfirst(strtolower($eating_style)) }}
                                    </option>
                                @endif
                            @endforeach
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('eating_style_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="produces_toxins_requirement">Should applicants be able to produce toxins?
                        </x-input-label>
                        <x-select name="produces_toxins_requirement" id="produces_toxins_requirement"
                            class="mt-1 block w-full">

                            @if ($vacancy->produces_toxins_requirement == 'NULL')
                                <option value="NULL" selected>Doesn't matter</option>
                            @else
                                <option value="NULL">Doesn't matter</option>
                            @endif
                            @if ($vacancy->produces_toxins_requirement == '1')
                                <option value="1" selected>Yes</option>
                            @else
                                <option value="1">Yes</option>
                            @endif
                            @if ($vacancy->produces_toxins_requirement == '0')
                                <option value="0" selected>No</option>
                            @else
                                <option value="0">No</option>
                            @endif
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('produces_toxins_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="size_requirement">Size Requirement</x-input-label>
                        <x-select name="size_requirement" id="size_requirement" class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>

                            @foreach ($size_requirements as $size)
                                @if ($size == $vacancy->size_requirement)
                                    <option value="{{ $size }}" selected>{{ ucfirst(strtolower($size)) }}
                                    </option>
                                @else
                                    <option value="{{ $size }}">{{ ucfirst(strtolower($size)) }}</option>
                                @endif
                            @endforeach

                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('size_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="speed_requirement">Speed Requirement</x-input-label>
                        <x-select name="speed_requirement" id="speed_requirement" class="mt-1 block w-full">
                            <option value="NULL">Doesn't matter</option>

                            @foreach ($speed_requirements as $speed)
                                @if ($speed == $vacancy->speed_requirement)
                                    <option value="{{ $speed }}" selected>{{ ucfirst(strtolower($speed)) }}
                                    </option>
                                @else
                                    <option value="{{ $speed }}">{{ ucfirst(strtolower($speed)) }}</option>
                                @endif
                            @endforeach
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('speed_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="num_appendages_requirement">How many appendages should applicants have?
                        </x-input-label>
                        <x-select name="num_appendages_requirement" id="num_appendages_requirement"
                            class="mt-1 block w-full">

                            @if ($vacancy->num_appendages_requirement == 'NULL')
                                <option value="NULL" selected>Doesn't matter</option>
                            @else
                                <option value="NULL">Doesn't matter</option>
                            @endif
                            @if ($vacancy->num_appendages_requirement == 'NONE')
                                <option value="NONE" selected>No Appendages</option>
                            @else
                                <option value="NONE">No Appendages</option>
                            @endif
                            @if ($vacancy->num_appendages_requirement == 'FEW')
                                <option value="FEW" selected>Few Appendages, e.g., 4</option>
                            @else
                                <option value="FEW">Few Appendages, e.g., 4</option>
                            @endif
                            @if ($vacancy->num_appendages_requirement == 'MANY')
                                <option value="MANY" selected>Many Appendages</option>
                            @else
                                <option value="MANY">Many Appendages</option>
                            @endif
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('num_appendages_requirement')" />
                    </div>

                    <div>
                        <x-input-label for="skills">All skills applicants should have. Please specify skill level
                            with colon and
                            separate with commas.</x-input-label>
                        <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full"
                            placeholder="" value="{{ $final_text_skills }}"></x-text-input>
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
                            class="mt-1 block w-full" placeholder="" value="{{ $final_text_quals }}">
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

                    {{-- MUST CHECK IF SALARY RANGE IS LOWER --}}
                    <div>
                        <x-input-label for="salary_range_lower">Lower salary range</x-input-label>
                        <x-text-input id="salary_lower" type="number" name="salary_range_lower"
                            class="mt-1 block w-full" placeholder="" value="{{ $vacancy->salary_range_lower }}"
                            required min="0" max="1000000"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('salary_range_lower')" />
                    </div>

                    <div>
                        <x-input-label for="salary_range_upper">Upper salary range</x-input-label>
                        <x-text-input id="salary_upper" type="number" name="salary_range_upper"
                            class="mt-1 block w-full" placeholder="" value="{{ $vacancy->salary_range_upper }}"
                            required min="0" max="1000000"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('salary_range_upper')" />
                    </div>

                    <script>
                        function validateForm() {

                            var salary_lower = parseInt(document.getElementById('salary_lower').value);
                            var salary_upper = parseInt(document.getElementById('salary_upper').value);

                            console.log(salary_lower);
                            console.log(salary_upper);

                            if (salary_lower > salary_upper) {
                                alert("Invalid salary range. Please make sure that the lower salary range is less than the upper range.");
                                return false;
                            }
                        }
                    </script>

                    <div>
                        <x-input-label for="vacancy_description">Vacancy Description</x-input-label>
                        <textarea limitTextArea(this, 200)" onkeyup="limitTextArea(this, 200) name="vacancy_description" id="vacancy_description" rows="10"
                            class="mt-1 block w-full border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md"
                            placeholder="Description Details.">{{ $vacancy->vacancy_description }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('vacancy_description')" />
                    </div>

                    <div class="flex justify-center gap-2 md:gap-5">
                        {{-- Possibly go straight to the created organisation page? --}}
                        <a href="{{ URL::previous() }}">
                            <x-secondary-button>
                                {{ __('Go Back') }}
                            </x-secondary-button>
                        </a>
                        <x-primary-button>
                            Save
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </x-card-base>
    </div>
</x-app-layout>
