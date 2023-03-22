<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="profile_pic">Profile Picture</x-input-label>
            <div class="flex items-center justify-center w-full">
                <label for="profile_pic"
                    class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-80 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
                        <p class="text-xs text-gray-500">SVG, PNG, JPG and GIF</p>
                    </div>
                    <input id="profile_pic" type="file" name="profile_pic" class="hidden" />
                </label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
        </div>


        <!-- First Name -->
        <div class="mt-4">
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
            <x-select name="species_id" id="species_id" required class="select w-full">
                <option selected value="">What type of species?</option>

                @foreach ($all_species as $species)
                    <option value="{{ $species->species_id }}">{{ ucfirst($species->species_name) }}</option>
                @endforeach
            </x-select>

            <x-input-error :messages="$errors->get('species_id')" class="mt-2" />

        </div>

        <div>
            <div class="mt-4">
                <x-input-label for="skills">Specify skills using the selections and button bellow.</x-input-label>
                <x-text-input id="skills_list" type="text" name="skills" class="block mt-1 w-full">
                </x-text-input>
            </div>
            <div class="mt-4 flex flex-col items-center gap-4">
                @php
                    $skills = App\Models\Skill::all();
                @endphp
                <div class="block mt-1 w-full">
                    <x-input-label for="skills_select">Select skills here.</x-input-label>
                    <x-select id="skill_name" name="skills_select" class="block mt-1 w-full">
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->skill_name }}">{{ $skill->skill_name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="block mt-1 w-full">
                    <x-input-label for="skills_level_select">Select skill level here.</x-input-label>
                    <x-select id="skill_level" name="skills_level_select" class="block mt-1 w-full">
                        <option value="BEGINNER">Beginner</option>
                        <option value="INTERMEDIATE">Intermediate</option>
                        <option value="EXPERT">Expert</option>
                    </x-select>
                </div>
                <div class="flex flex-col items-center">
                    <p id="skills_error" hidden class="text-center text-white bg-redButtons w-max px-2 rounded-lg">
                        Can't
                        have duplicate
                        skills.</p>
                </div>
                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                <x-secondary-button onclick="addSkill()" type="button">Add Skill</x-secondary-button>
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
        </div>

        <div>
            <div class="mt-4">
                <x-input-label for="qualifications">Specify qualifications using the selection and button bellow.
                </x-input-label>
                <x-text-input id="qualifications_list" type="text" name="qualifications"
                    class="block mt-1 w-full" placeholder="" value="{{ old('qualifications') }}"></x-text-input>
            </div>
            <div class="mt-4 flex flex-col items-center gap-4">
                @php
                    $qualifications = App\Models\Qualification::all();
                @endphp
                <div class="block mt-1 w-full">
                    <x-input-label for="qualifications_select">Select qualifications here.</x-input-label>
                    <x-select id="qualification_name" name="qualifications_select" class="block mt-1 w-full">
                        @foreach ($qualifications as $qualification)
                            <option value="{{ $qualification->qualification_name }}">
                                {{ $qualification->qualification_name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex flex-col items-center">
                    <p id="qualifications_error" hidden
                        class="text-center text-white bg-redButtons w-max px-2 rounded-lg">Can't
                        have duplicate
                        qualifications.</p>
                </div>
                <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                <x-secondary-button onclick="addQualification()" type="button">Add Qualification</x-secondary-button>
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
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-greenButtons hover:text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-greenButtons"
                href="{{ route('login') }}">
                {{ __('Already Registered?') }}
            </a>

            <x-primary-button
                class="ml-4 bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex gap-1">
                <span class="material-symbols-rounded">
                    design_services</span>
                {{ __('Sign Up') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
