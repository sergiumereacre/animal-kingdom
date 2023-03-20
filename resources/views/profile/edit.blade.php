<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <div class="p-8 bg-white shadow-xl md:rounded-3xl hover:shadow-2xl transition ease-in-out duration-300">
                <div class="max-w-3xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-xl md:rounded-3xl hover:shadow-2xl transition ease-in-out duration-300">
                <div class="max-w-3xl">
                    @include('profile.partials.update-bio-skills')
                </div>
            </div>

            <div class="p-8 bg-white shadow-xl md:rounded-3xl hover:shadow-2xl transition ease-in-out duration-300">
                <div class="max-w-3xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-xl md:rounded-3xl hover:shadow-2xl transition ease-in-out duration-300">
                <div class="max-w-3xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
