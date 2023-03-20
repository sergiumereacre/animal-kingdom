<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Bio, Skills and Qualifications') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile bio, skills and qualifications that show up on your personal profile.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full h-max" :value="old('bio', $user->bio)" required autofocus autocomplete="bio" />
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        <div>
            <x-input-label for="qualifications" :value="__('Qualifications')" />
            <x-text-input id="qualifications" name="qualifications" type="text" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('qualifications')" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
            
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
