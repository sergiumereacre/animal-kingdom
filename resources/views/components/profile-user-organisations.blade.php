@props(['vacancy','user'])

<x-card-base class="max-w-md w-full md:max-w-6xl">
    <div class="flex flex-col p-10">
        <!-- Card Name -->
        <h1 class="text-3xl text-black font-black pb-3">Organisations Owned</h1>
        <!-- Card Content -->
        <div class="flex flex-col gap-5 items-center">
            @php
                $organisations = App\Models\Organisation::all()->where('owner_id', '=', $user->id);
            @endphp

            @unless(count($organisations) == 0)
                @foreach ($organisations as $organisation)
                    <div class="flex flex-col items-center md:flex-row md:w-full">
                        <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}" alt="Company Logo" />
                        <div class="flex flex-col items-center md:items-start md:ml-5">
                            <span class="text-xl text-greenButtons font-bold"><a href="/organisations/{{ $organisation->organisation_id }}">{{ $organisation->organisation_name }}</a></span>
                            <div class="text-gray-800 text-center">
                                <span>{{ $organisation->address }}</span>
                            </div>
                        </div>
                        @if ($user->id == auth()->id())
                        <form action="/organisations/{{ $organisation->organisation_id }}" class="pt-2 md:ml-auto" method="post">
                            @csrf
                            @method('DELETE')
                            <x-remove-button><span class="material-symbols-rounded">delete</span></x-remove-button>
                        </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p>No organisations found</p>
            @endunless

            @if ($user->id == auth()->id())
                <a href="/organisations/create">
                    <x-primary-button>
                        {{ __('Create New') }}
                    </x-primary-button>
                </a>
            @else
            @endif
        </div>
    </div>
</x-card-base>
