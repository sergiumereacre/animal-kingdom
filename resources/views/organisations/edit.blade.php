{{-- @php
    dd($organisation)
@endphp --}}

<x-app-layout>
    <div class="py-12 flex flex-col items-center max-w-2xl mx-auto">
        <x-card-base>
            <form method="POST" action="/organisations/{{ $organisation->organisation_id }}" enctype="multipart/form-data"
                class="p-10 flex flex-col items-center gap-5">
                @csrf
                @method('PUT')
                {{-- @method_field('PUT') --}}
                <!-- Form Title -->
                <div>
                    <p class="font-bold text-2xl md:text-3xl">Edit {{ $organisation->organisation_name }}</p>
                </div>

                <!-- Form Inputs -->
                <div class="flex flex-col gap-5 md:w-full">
                    <div>
                        <x-input-label for="organisation_name">Organisation Name</x-input-label>
                        <x-text-input type="text" name="organisation_name" class="mt-1 block w-full"
                            placeholder="{{ $organisation->organisation_name }}"
                            value="{{ $organisation->organisation_name }}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('organisation_name')" />
                    </div>

                    <div>
                        <x-input-label for="picture">Organisation Logo</x-input-label>
                        <div class="flex items-center justify-center w-full">
                            <label for="picture"
                                class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-80 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <img class="w-40 h-40 rounded-xl" id="picture_preview"
                                        src="{{ $organisation->picture ? asset('storage/' . $organisation->picture) : asset('img/logo.png') }}"
                                        alt="Rounded avatar">
                                </div>
                                <input id="picture" type="file" name="picture" class="hidden"
                                    accept="image/png, image/gif, image/jpeg" onchange="validateFileType()" />
                            </label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('picture')" />

                        <script>
                            // Method that validates the file input to only be jpeg png or gif
                            function validateFileType() {
                                var picture = document.getElementById("picture").value;
                                var idxDot = picture.lastIndexOf(".") + 1;
                                var extFile = picture.substr(idxDot, picture.length).toLowerCase();
                                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                                    // Change preview image to the uploaded image
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("picture").files[0]);
                                    oFReader.onload = function(oFREvent) {
                                        document.getElementById("picture_preview").src = oFREvent.target.result;
                                    };
                                } else {
                                    alert("Only jpg/jpeg, png and gif files are allowed!");
                                }
                            }
                        </script>
                    </div>

                    <div>
                        <x-input-label for="address">Organisation Address</x-input-label>
                        <x-text-input type="text" name="address" class="mt-1 block w-full" placeholder=""
                            value="{{ $organisation->address }}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div>
                        <x-input-label for="email">Organisation Email</x-input-label>
                        <x-text-input type="email" name="email" class="mt-1 block w-full" placeholder=""
                            value="{{ $organisation->email }}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="contact_number">Organisation Contact Number</x-input-label>
                        <x-text-input type="text" name="contact_number" class="mt-1 block w-full" placeholder=""
                            value="{{ $organisation->contact_number }}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                    </div>

                    <div>
                        <x-input-label for="description">Organisation Description</x-input-label>
                        <textarea onkeydown="limitTextArea(this, 200)" onkeyup="limitTextArea(this, 200)" name="description" id="description"
                            rows="8"
                            class="mt-1 block w-full border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md"
                            placeholder="Organisation Description...">{{ $organisation->description }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex justify-center gap-2 md:gap-5">
                        {{-- Possibly go straight to the created organisation page? --}}
                        {{-- <a href="{{ route('home') }}"> --}}
                        <a href="/organisations/{{ $organisation->organisation_id }}">
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
