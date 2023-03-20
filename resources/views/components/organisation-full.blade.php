{{-- Receives an organisation variable --}}
@props(['organisation'])

<x-card-base>
    <!-- Avatar and Company Name -->
    <div class="flex flex-col items-center py-5 md:px-5">
        <img class="w-36 h-36 mb-5 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}" alt="Company Logo" />
        <span class="text-3xl font-bold text-black px-10 text-center">{{ $organisation->organisation_name }}</span>
    </div>
    <!-- Main Section -->
    <div>

        @php
            $owner = App\Models\User::find($organisation->owner_id);
        @endphp

        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Owner:</p>
            <a href="/users/{{ $owner->id }}"
                class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $owner->first_name }} {{ $owner->last_name }}</a>
        </div>
        <!-- Overview -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:p-5 md:w-44 md:text-right">Overview:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->description }}</p>
        </div>
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Time Created:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->time_created }}</p>
        </div>
        <!-- Contact Us -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Contact Us:</p>
            <div class="flex flex-col items-center">
                <!-- Phone -->
                <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">call</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->contact_number }}</p>
                </div>
                <!-- Email -->
                <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">mail</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->email }}</p>
                </div>
                <!-- Website -->
                {{-- <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">public</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">example.com</p>
                </div> --}}
            </div>
        </div>
        <!-- Location -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Location:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->address }}</p>
        </div>
        <!-- Industry -->
        {{-- <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Industry:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">Technology</p>
        </div> --}}
        <!-- Company Size -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Company Size:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">{{ $organisation->size }}</p>
        </div>
        <!-- Remove Button -->
        @if ($owner->id == auth()->id())
            <div class="px-5 pb-5 flex flex-col items-center md:items-end">
                <a href="/organisations/{{ $organisation->organisation_id }}/edit">
                    <button>Edit</button>

                </a>
                <form action="/organisations/{{ $organisation->organisation_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-remove-button>
                        Remove
                    </x-remove-button>
                </form>

            </div>
        @endif

    </div>
</x-card-base>
