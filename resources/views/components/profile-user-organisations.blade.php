@props(['vacancy','user'])

<x-card-base class="max-w-md w-full md:max-w-6xl">
    <div class="flex flex-col p-10">
        <!-- Card Name -->
        <h1 class="text-3xl text-black font-black pb-3">Organisations Owned</h1>
        <!-- Card Content -->
        <div class="flex flex-col gap-5 items-center">
            @php
                $organisations = App\Models\Organisation::all()->where('owner_id', '=', auth()->id());
            @endphp

            {{--@if (count($uservacancies) == 1)

                    @foreach ($uservacancies as $vacancy)
                        @php
                            
                            $vacancy = App\Models\Vacancy::all()->find($uservacancy->vacancy_id);
                            $organisation = App\Models\Organisation::all()->find($vacancy->organisation_id);

                            // dd($uservacancy);
                            // dd($organisation);
                        @endphp
                        <div class="flex flex-col items-center md:flex-row">
                            <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                                alt="Company Logo" />
                            <div class="flex flex-col items-center md:items-start md:ml-5">
                                <span
                                    class="text-xl text-greenButtons font-bold">{{ $organisation->organisation_name }}</span>
                                <span class="text-lg text-black font-semibold">{{ $vacancy->vacancy_title }}</span>
                                <div class="text-gray-800">
                                    <span>Time Joined: {{ $uservacancy->time_joined }}</span>
                                    <span>|</span>
                                    <span>{{ $organisation->address }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($uservacancies as $uservacancy)
                        @php
                            
                            $vacancy = App\Models\Vacancy::all()->find($uservacancy->vacancy_id);
                            $organisation = App\Models\Organisation::all()->find($vacancy->organisation_id);
                        @endphp
                        <hr class="h-px my-5 bg-greenButtons border-0">
                        <div class="flex flex-col items-center md:flex-row">
                            <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                                alt="Company Logo" />
                            <div class="flex flex-col items-center md:items-start md:ml-5">
                                <span
                                    class="text-xl text-greenButtons font-bold">{{ $organisation->organisation_name }}</span>
                                <span class="text-lg text-black font-semibold">{{ $vacancy->vacancy_title }}</span>
                                <div class="text-gray-800">

                                    <span>Time Joined: {{ $uservacancy->time_joined }}</span>
                                    <span>|</span>
                                    <span>{{ $organisation->address }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            @endif --}}

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
                            <button><x-remove-button>{{ __('Remove') }}</x-remove-button></button>
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
