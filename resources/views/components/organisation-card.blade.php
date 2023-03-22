{{-- Receives an organisation variable --}}
@props(['organisation'])

<x-card-base class="md:max-w-2xl">
    <div class="flex flex-col items-center md:flex-row">
        <!-- Avatar and Company Name -->
        <div class="flex flex-col items-center py-5 md:px-5 md:min-w-fit">
            {{-- <img class="w-36 h-36 mb-5 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}" alt="Company Logo" /> --}}
            <img class="w-36 h-36 mb-5 rounded-full shadow-lg aspect-square object-fill"
                src="{{ $organisation->picture ? asset('storage/' . $organisation->picture) : asset('img/logo.png') }}"
                alt="Company Logo" />
            <a href="/organisations/{{ $organisation->organisation_id }}" class="flex items-center"><span class="text-2xl md:text-xl font-bold text-black px-10 md:px-0 text-center md:max-w-md">{{ $organisation->organisation_name }}</span></a>
        </div>
        <!-- Main Section -->
        <div class="md:w-screen">
            @php
                $owner = App\Models\User::find($organisation->owner_id);
            @endphp
            <div class="px-5 pb-5 md:pt-5 flex flex-row items-center justify-center">
                <p class="text-sm font-bold">Owned by: </p>
                <a href="/users/{{ $owner->id }}" class="text-sm text-gray-700 mx-2 flex items-center flex-row">
                    <span class="material-symbols-rounded">
                        person
                    </span>
                    {{ $owner->first_name }}
                    {{ $owner->last_name }}</a>
            </div>
            <!-- Overview -->
            <div class="px-5 pb-2 flex flex-col md:flex-row items-center">
                <p class="text-sm text-gray-700">{{ $organisation->description }}</p>
            </div>
            <div class="flex flex-col items-center pb-5 pt-2 gap-3 mx-10 md:items-start md:mx-0 md:ml-5 md:mr-10">
                <!-- Time Created -->
                <div class="flex flex-row items-center gap-2">
                    <span class="material-symbols-rounded">schedule</span>
                    <p class="text-sm text-gray-700">{{ $organisation->time_created }}</p>
                </div>
                <!-- Phone -->
                <div class="flex flex-row items-center gap-2">
                    <span class="material-symbols-rounded">call</span>
                    <p class="text-sm text-gray-700">{{ $organisation->contact_number }}</p>
                </div>
                <!-- Email -->
                <div class="flex flex-row items-center gap-2">
                    <span class="material-symbols-rounded">mail</span>
                    <p class="text-sm text-gray-700">{{ $organisation->email }}</p>
                </div>
                <!-- Location -->
                <div class="flex flex-row items-center gap-2">
                    <span class="material-symbols-rounded">location_on</span>
                    <p class="text-sm text-gray-700">{{ $organisation->address }}</p>
                </div>
            </div>
            <!-- Remove or Edit Button -->
            @if ($owner->id == auth()->id())
                <div class="px-5 pb-5 flex flex-row items-center justify-center gap-3 md:items-end md:justify-end">
                    <form action="/organisations/{{ $organisation->organisation_id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-remove-button class="flex gap-2">
                            <span class="material-symbols-rounded">delete_forever</span>
                            Remove
                        </x-remove-button>
                    </form>
                    <a href="/organisations/{{ $organisation->organisation_id }}/edit">
                        <x-secondary-button class="flex gap-2">
                            <span class="material-symbols-rounded">edit</span>
                            Edit
                        </x-secondary-button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-card-base>
