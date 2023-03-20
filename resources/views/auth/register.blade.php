<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name*')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first-name')"
                required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name*')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username*')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email*')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password*')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Input field for address. -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Input field for date of birth with a date picker. -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Date of Birth*')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                :value="old('date_of_birth')" required autofocus autocomplete="date_of_birth" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Input field for phone number with a field to the left side that has country code. -->
        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Phone Number')" />
            <x-text-input id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number"
                :value="old('contact_number')" />
            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
        </div>

        <!-- Species -->
        <div class="mt-4">
            <x-input-label for="species_id" :value="__('Species*')" />
            @php
                $all_species = \App\Models\AnimalSpecies::all();
                // dd($all_species);
            @endphp
            <select name="species_id" id="species_id" required
                class="select w-full border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-md shadow-lg">
                <option selected value="">What type of species?</option>

                @foreach ($all_species as $species)
                    <option value="{{ $species->species_id }}">{{ ucfirst($species->species_name) }}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('species_id')" class="mt-2" />

        </div>

        <div>
            <label for="skills">All skills you have. Please specify skill level with colon and
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
            <label for="qualifications">All qualifications you have. Please separate with commas</label>
            <input id="qualifications_list" type="text" name="qualifications" placeholder="" value="{{ old('qualifications') }}">
        </div>
        <div>
            <label for="qualifications_select">Select qualifications here</label>

            @php
                $qualifications = App\Models\Qualification::all();
            @endphp

            <select id="qualification_name" name="qualifications_select" id="qualifications_select">
                @foreach ($qualifications as $qualification)
                    <option value="{{ $qualification->qualification_name }}">{{ $qualification->qualification_name }}</option>
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

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-greenButtons hover:text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-greenButtons"
                href="{{ route('login') }}">
                {{ __('Already Registered?') }}
            </a>

            <x-primary-button
                class="ml-4 bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
