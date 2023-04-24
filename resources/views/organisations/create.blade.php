<x-app-layout>
    <div class="py-12 flex flex-col items-center max-w-2xl mx-auto">
        <x-card-base>
            <form method="POST" action="/organisations" enctype="multipart/form-data" class="p-10 flex flex-col items-center gap-5">
                @csrf
                <!-- Form Title -->
                <div>
                    <p class="font-bold text-2xl md:text-3xl">Create Organisation</p>
                </div>
                
                <!-- Form Inputs -->
                <div class="flex flex-col gap-5 md:w-full">
                    <div>
                        <x-input-label for="organisation_name">Organisation Name</x-input-label>
                        <x-text-input type="text" name="organisation_name" class="mt-1 block w-full" placeholder="" value="{{old('organisation_name')}}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('organisation_name')" />
                    </div>
                    
                    <div>
                        <x-input-label for="picture">Organisation Logo</x-input-label>
                        <div class="flex items-center justify-center w-full">
                            <label for="picture" class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-80 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG (MAX. 800x400px)</p>
                                </div>
                                <input id="picture" type="file" name="picture" class="hidden"/>
                            </label>
                        </div> 
                        <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                    </div>
        
                    <div>
                        <x-input-label for="address">Organisation Address</x-input-label>
                        <x-text-input type="text" name="address" class="mt-1 block w-full" placeholder="" value="{{old('address')}}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div> 
                    
                    <div>
                        <x-input-label for="email">Organisation Email</x-input-label>
                        <x-text-input type="email" name="email" class="mt-1 block w-full" placeholder="" value="{{old('email')}}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div> 
                    
                    <div>
                        <x-input-label for="contact_number">Organisation Contact Number</x-input-label>
                        <x-text-input type="text" name="contact_number" class="mt-1 block w-full" placeholder="" value="{{old('contact_number')}}"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                    </div> 
        
                    <div>
                        <x-input-label for="description">Organisation Description</x-input-label>
                        <textarea onkeydown="limitTextArea(this, 200)" onkeyup="limitTextArea(this, 200)" name="description" id="description" rows="8" class="mt-1 block w-full border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md" placeholder="Organisation Description...">{{old('description')}}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
        
                    <div class="flex justify-center gap-2 md:gap-5">
                        {{-- Possibly go straight to the created organisation page? --}}
                        <a href="{{ URL::previous() }}">
                            <x-secondary-button class="flex flex-row gap-1 items-center">
                                <span class="material-symbols-rounded">
                                    arrow_back
                                    </span>
                                {{ __('Go Back') }}
                            </x-secondary-button>
                        </a>
                        <x-primary-button class="flex flex-row gap-2 items-center">
                            <span class="material-symbols-rounded">
                                home_work
                                </span>
                            Create Organisation
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </x-card-base>
    </div>
</x-app-layout>
