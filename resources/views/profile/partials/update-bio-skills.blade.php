<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Bio, Skills and Qualifications') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile bio, skills and qualifications that show up on your personal profile.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.updatePersonal') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full h-max" :value="old('bio', $user->bio)"
                required autofocus autocomplete="bio" />
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>

            {{-- Getting value for skills as text --}}
            @php
                $final_text_skills = '';
                $skills_users = App\Models\SkillsUser::all()->where('user_id', '=', auth()->id());
                
                // We need to get the level and name of each
                foreach ($skills_users as $skill_user) {
                    $skill_name = App\Models\Skill::where('skill_id', '=', $skill_user->skill_id)->first()->skill_name;
                
                    // dd($skill_name);
                
                    $skill_level = $skill_user->skill_level;
                
                    $current_skill_text = $skill_name . ':' . $skill_level . ',';
                    $final_text_skills = $final_text_skills . $current_skill_text;
                    // dd($current_skill_text);
                }
                
                $final_text_quals = '';
                $quals_users = App\Models\QualificationsUser::all()->where('user_id', '=', auth()->id());

                
                
                foreach ($quals_users as $qual_user) {
                    $qual_name = App\Models\Qualification::where('qualification_id', '=', $qual_user->qualification_id)->first()->qualification_name;
                
                
                
                    $current_qual_text = $qual_name.',';
                    $final_text_quals = $final_text_quals . $current_qual_text;
                }

                // dd($final_text_quals);
            @endphp

            <x-input-label for="skills">This box bellow is used for adding skills.</x-input-label>
            {{-- <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full"
                placeholder="" value="{{ old('skills') }}"></x-text-input> --}}
            <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full" placeholder=""
                value="{{ $final_text_skills }}"></x-text-input>
        </div>

        <div class="flex flex-wrap flex-row items-center gap-3" id="all_skills">
            @php
                $skills = App\Models\SkillsUser::all()->where('user_id', $user->id);
            @endphp

            @foreach ($skills as $skill)
                @php
                    $skill_name = App\Models\Skill::all()->find($skill->skill_id)->skill_name;
                    // dd($skill->skill_level);
                @endphp

                @if ($skill->skill_level == 'BEGINNER')
                    <x-skill onclick="removeSkill('{{ $skill_name }}')" style="background-color: rgb(231, 255, 231)">
                        {{ $skill_name }}</x-skill>
                @endif

                @if ($skill->skill_level == 'INTERMEDIATE')
                    <x-skill onclick="removeSkill('{{ $skill_name }}')" style="background-color: rgb(224, 205, 255)">
                        {{ $skill_name }}</x-skill>
                @endif

                @if ($skill->skill_level == 'EXPERT')
                    <x-skill onclick="removeSkill('{{ $skill_name }}')" style="background-color: rgb(255, 207, 207)">
                        {{ $skill_name }}</x-skill>
                @endif
            @endforeach
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
                <p id="skills_error" hidden class="text-center text-white bg-redButtons w-max px-2 rounded-lg">Can't
                    have duplicate
                    skills.</p>
            </div>

            <div class="flex flex-col items-center">
                <x-primary-button class="w-max" onclick="addSkill()" type="button">Add Skill
                </x-primary-button>
            </div>
        </div>

        <script>
            function removeSkill(skill) {
                // var all_skillsList = document.getElementById('all_skills');
                // var all_skills = document.getElementById('all_skills').children;

                // for (var i = 0; i < all_skills.length; i++) {
                //     if (all_skills[i].innerText == skill) {
                //         console.log("Oh Yes baby");
                //         all_skillsList.removeChild(all_skills[i]);
                //         return;
                //     } else {
                //         console.log("Oh No baby");

                //     }
                // }

                // console.log(all_skills.innerText == skill);

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
            }
        </script>

        @error('skills')
            <p>{{ $message }}</p>
        @enderror

        {{-- <div>
            <x-input-label for="qualifications" :value="__('Qualifications')" />
            <x-text-input id="qualifications" name="qualifications" type="text" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('qualifications')" />
        </div> --}}

        <div>
            <x-input-label for="qualifications">All qualifications applicants should have. Please separate
                with
                commas.</x-input-label>
            <x-text-input id="qualifications_list" type="text" name="qualifications" class="mt-1 block w-full"
                placeholder="" value="{{ $final_text_quals }}">
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
                <p id="qualifications_error" hidden class="text-center text-white bg-redButtons w-max px-2 rounded-lg">
                    Can't have duplicate qualifications.</p>
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


        <div class="flex items-center gap-4 justify-end">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif

            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>

    </form>
</section>
