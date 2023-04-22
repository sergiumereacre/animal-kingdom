<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile picture, names, email, address and phone number.") }}
        </p>
    </header>

    @if (auth()->user()->id != $user->id)
        <form method="post" enctype="multipart/form-data" action="{{ route('profile.updateOther', $user->id) }}" class="space-y-6">

            @php
                // dd(route('profile.updateOther', $user->id));
            @endphp
    @else
        <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="space-y-6">
    @endif

    @csrf
    @method('patch')

    <div>
        <x-input-label for="profile_pic">Profile Picture</x-input-label>
        <div class="flex items-center justify-center w-full">
            <label for="profile_pic"
                class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-80 hover:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img class="w-40 h-40 rounded-xl" id="profile_pic_preview"
                        src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png') }}"
                        alt="Rounded avatar">
                </div>
                <input id="profile_pic" type="file" name="profile_pic" class="hidden"
                    accept="image/png, image/gif, image/jpeg" onchange="validateFileType()" />
            </label>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
    </div>

    <script>
        // Method that validates the file input to only be jpeg png or gif
        function validateFileType() {
            var profile_pic = document.getElementById("profile_pic").value;
            var idxDot = profile_pic.lastIndexOf(".") + 1;
            var extFile = profile_pic.substr(idxDot, profile_pic.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                // Change preview image to the uploaded image
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("profile_pic").files[0]);
                oFReader.onload = function(oFREvent) {
                    document.getElementById("profile_pic_preview").src = oFREvent.target.result;
                };
            } else {
                alert("Only jpg/jpeg, png and gif files are allowed!");
            }
        }
    </script>

    <div>
        <x-input-label for="first_name" :value="__('First Name')" />
        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)"
            required autofocus autocomplete="first_name" />
        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
    </div>

    <div>
        <x-input-label for="last_name" :value="__('Last Name')" />
        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)"
            required autofocus autocomplete="last_name" />
        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
    </div>

    <div>
        <x-input-label for="address" :value="__('Address')" />
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required
            autocomplete="address" />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>

    <div>
        <x-input-label for="contact_number" :value="__('Phone Number')" />
        <x-text-input id="contact_number" name="contact_number" type="tel" class="mt-1 block w-full"
            :value="old('contact_number', $user->contact_number)" required autocomplete="contact_number" />
        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required
            autocomplete="email" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

    </div>

    <div class="flex items-center gap-4 justify-end">
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Updated.') }}</p>
        @endif

        <x-primary-button class="flex flex-row items-center gap-2"><span class="material-symbols-rounded">
                save
            </span>{{ __('Save') }}</x-primary-button>
    </div>
    </form>
</section>
