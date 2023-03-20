<x-app-layout>
    This page will show the form for creating vacancies

    <form method="POST" action="/vacancies" enctype="multipart/form-data" onsubmit="return validateForm()">
        {{-- This tag makes it so that not anyone can just send a form pointed towards this URL --}}
        @csrf
        <div>
            <label for="vacancy_title">Vacancy Title</label>
            <input type="text" name="vacancy_title" placeholder="" value="{{ old('vacancy_title') }}">
        </div>

        {{-- Catching errors and displaying them --}}
        @error('vacancy_title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="organisation_id">What company will this vacancy be created under?</label>
            <select name="organisation_id" id="organisation_id">

                @foreach ($organisations as $org)
                    @if ($org == $organisation)
                        <option selected value="{{ $org->organisation_id }}">{{ $org->organisation_name }}</option>
                    @else
                        <option value="{{ $org->organisation_id }}">{{ $org->organisation_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        @error('organisation_id')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="category_requirement">Category Requirement</label>
            <select name="category_requirement" id="category_requirement">
                <option value="NULL">None</option>
                <option value="MAMMAL">Mammal</option>
                <option value="REPTILE">Reptile</option>
                <option value="AMPHIBIAN">Amphibian</option>
                <option value="AVIAN">Avian</option>
                <option value="FISH">Fish</option>
            </select>
        </div>

        @error('category_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="can_fly_requirement">Should applicants be able to fly?</label>
            <select name="can_fly_requirement" id="can_fly_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        @error('can_fly_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="can_swim_requirement">Should applicants be able to swim?</label>
            <select name="can_swim_requirement" id="can_swim_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        @error('can_swim_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="can_climb_requirement">Should applicants be able to climb?</label>
            <select name="can_climb_requirement" id="can_climb_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        @error('can_climb_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="eating_style_requirement">Eating Style Requirement</label>
            <select name="eating_style_requirement" id="eating_style_requirement">
                <option value="NULL">None</option>
                <option value="HERBIVORE">Herbivore</option>
                <option value="CARNIVORE">Carnivore</option>
                <option value="OMNIVORE">Omnivore</option>
            </select>
        </div>

        @error('eating_style_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="produces_toxins_requirement">Should applicants be able to produce toxins?</label>
            <select name="produces_toxins_requirement" id="produces_toxins_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        @error('produces_toxins_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="size_requirement">Size Requirement</label>
            <select name="size_requirement" id="size_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="SMALL">Small</option>
                <option value="MEDIUM">Medium</option>
                <option value="LARGE">Large</option>
            </select>
        </div>

        @error('size_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="speed_requirement">Speed Requirement</label>
            <select name="speed_requirement" id="speed_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="SLOW">Slow</option>
                <option value="MEDIUM">Medium</option>
                <option value="FAST">Fast</option>
            </select>
        </div>

        @error('speed_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="num_appendages_requirement">How many appendages should applicants have?</label>
            <select name="num_appendages_requirement" id="num_appendages_requirement">
                <option value="NULL">Doesn't matter</option>
                <option value="NONE">No Appendages</option>
                <option value="FEW">Few Appendages, e.g., 4</option>
                <option value="MANY">Many Appendages</option>
            </select>
        </div>

        @error('num_appendages_requirement')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="skills">All skills applicants should have. Please specify skill level with colon and
                separate with commas</label>
            <input id="skills_list" type="text" name="skills" placeholder="" value="{{ old('skills') }}">
        </div>
        <div>
            <label for="skills_select">Select skills here</label>

            @php
                $skills = App\Models\Skill::all();
            @endphp

            <select id="skill_name" name="skills_select" id="skills_select">
                @foreach ($skills as $skill)
                    <option value="{{ $skill->skill_name }}">{{ $skill->skill_name }}</option>
                @endforeach
            </select>

            <label for="skills_level_select">Select skill level here</label>
            <select id="skill_level" name="skills_level_select" id="skills_level_select">
                <option value="BEGINNER">Beginner</option>
                <option value="INTERMEDIATE">Intermediate</option>
                <option value="EXPERT">Expert</option>
            </select>

            <p id="skills_error" hidden>Can't have duplicate skills</p>

            <button onclick="addSkill()" type="button">Add Skill</button>
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
            <label for="qualifications">All qualifications applicants should have. Please separate with commas</label>
            <input id="qualifications_list" type="text" name="qualifications" placeholder=""
                value="{{ old('qualifications') }}">
        </div>
        <div>
            <label for="qualifications_select">Select qualifications here</label>

            @php
                $qualifications = App\Models\Qualification::all();
            @endphp

            <select id="qualification_name" name="qualifications_select" id="qualifications_select">
                @foreach ($qualifications as $qualification)
                    <option value="{{ $qualification->qualification_name }}">{{ $qualification->qualification_name }}
                    </option>
                @endforeach
            </select>

            <p id="qualifications_error" hidden>Can't have duplicate qualifications</p>

            <button onclick="addQualification()" type="button">Add Qualification</button>
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
            <label for="salary_range_lower">Lower salary range</label>
            <input id="salary_lower" type="number" name="salary_range_lower" placeholder=""
                value="{{ old('salary_range_lower') }}">
        </div>

        @error('salary_range_lower')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="salary_range_upper">Upper salary range</label>
            <input id="salary_upper" type="number" name="salary_range_upper" placeholder=""
                value="{{ old('salary_range_upper') }}">
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

        @error('salary_range_upper')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="vacancy_description">Vacancy Description</label>
            <textarea name="vacancy_description" id="vacancy_description" rows="10" placeholder="Vacancy Description...">{{ old('vacancy_description') }}</textarea>
        </div>

        @error('vacancy_description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <button>
                Create Vacancy
            </button>

            <a href="/home">Go Back</a>

    </form>


</x-app-layout>
