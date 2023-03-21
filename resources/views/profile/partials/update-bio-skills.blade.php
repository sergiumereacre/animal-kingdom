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
            <x-input-label for="skills">This box bellow is used for adding skills.</x-input-label>
            <x-text-input id="skills_list" type="text" name="skills" class="mt-1 block w-full"
                placeholder="" value="{{ old('skills') }}"></x-text-input>
        </div>

        <div class="flex flex-wrap flex-row items-center gap-3">
            @php
                $skills = App\Models\SkillsUser::all()->where('user_id', $user->id);
            @endphp

            @foreach ($skills as $skill)
                @php
                    $skill_name = App\Models\Skill::all()->find($skill->skill_id)->skill_name;
                    // dd($skill->skill_level);
                @endphp

                @if ($skill->skill_level == 'BEGINNER')
                    <x-skill style="background-color: rgb(231, 255, 231)">{{ $skill_name }}</x-skill>
                @endif

                @if ($skill->skill_level == 'INTERMEDIATE')
                    <x-skill style="background-color: rgb(224, 205, 255)">{{ $skill_name }}</x-skill>
                @endif

                @if ($skill->skill_level == 'EXPERT')
                    <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill_name }}</x-skill>
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
            <x-input-label for="qualifications" :value="__('Qualifications')" />
            <x-text-input id="qualifications" name="qualifications" type="text" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('qualifications')" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif

            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
