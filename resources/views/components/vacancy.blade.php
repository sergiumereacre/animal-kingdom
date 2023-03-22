@props(['vacancy', 'organisation'])

<x-card-base class="md:flex md:flex-row">
    <!-- Company Logo and Name -->
    <div class="flex flex-col items-center py-5 md:px-5 md:pt-11 md:min-w-fit">
        <img class="w-36 h-36 mb-3 rounded-full shadow-lg aspect-square object-fill"
            src="{{ $organisation->picture ? asset('storage/' . $organisation->picture) : asset('img/logo.png') }}"
            alt="Company Logo" />
        <span class="text-sm text-black text-center"><a
                href="/organisations/{{ $organisation->organisation_id }}">{{ $organisation->organisation_name }}</a></span>
    </div>
    <!-- Main Section -->
    <div class="md:w-screen">
        <!-- Job Title and Salary Range -->
        <div class="flex flex-col items-center md:flex-row md:pt-5">
            <h1 class="font-bold text-2xl text-center md:text-left"><a
                    href="/vacancies/{{ $vacancy->vacancy_id }}">{{ $vacancy->vacancy_title }}</a> </h1>
            <p class="pt-5 md:pt-0 font-bold text-greenButtons md:ml-auto md:mr-10">${{ $vacancy->salary_range_lower }}
                -
                ${{ $vacancy->salary_range_upper }}</p>
        </div>
        <!-- Job Description -->
        <div class="py-5 md:mr-5">
            <p class="px-5 md:px-0 text-sm text-gray-700">{{ $vacancy->vacancy_description }}</p>
        </div>
        <!-- Skills -->
        <div class="pb-5 flex flex-col items-center justify-center gap-3 md:flex-row md:flex-wrap">
            @php
                $skills = App\Models\Skill::all()->whereIn(
                    'skill_id',
                    Illuminate\Support\Facades\DB::table('skills_vacancies')
                        ->where('vacancy_id', '=', $vacancy->vacancy_id)
                        ->pluck('skill_id'),
                );
                
                // dd($skills);
                
                $quals = App\Models\Qualification::all()->whereIn(
                    'qualification_id',
                    Illuminate\Support\Facades\DB::table('qualifications_vacancies')
                        ->where('vacancy_id', '=', $vacancy->vacancy_id)
                        ->pluck('qualification_id'),
                );
            @endphp
            <div class="flex items-center gap-3 flex-row text-md md:pb-0">
                <p class="font-medium text-black">Skills Needed: </p>
                @php
                    $skillIterations = 0;
                @endphp
                @if (count($skills) != 0)
                    @foreach ($skills as $skill)
                        @if ($skillIterations < 2)
                            @php
                                $skill_level = App\Models\SkillsVacancy::all()
                                    ->whereIn(
                                        'skills_vacancies_id',
                                        Illuminate\Support\Facades\DB::table('skills_vacancies')
                                            ->where('skill_id', '=', $skill->skill_id)
                                            ->pluck('skills_vacancies_id'),
                                    )
                                    ->first()->skill_level;
                            @endphp
                            @if ($skill_level == 'BEGINNER')
                                <x-skill style="background-color: rgb(231, 255, 231)">{{ $skill->skill_name }}</x-skill>
                            @endif
                            @if ($skill_level == 'INTERMEDIATE')
                                <x-skill style="background-color: rgb(224, 205, 255)">{{ $skill->skill_name }}</x-skill>
                            @endif
                            @if ($skill_level == 'EXPERT')
                                <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill->skill_name }}
                                </x-skill>
                            @endif
                            @php
                                $skillIterations++;
                            @endphp
                        @endif
                    @endforeach
                    @if (count($skills) > 2)
                        <x-skill>...</x-skill>
                    @endif
                @else
                    <x-skill>None</x-skill>
                @endif
            </div>
            <div class="flex items-center gap-3 flex-row text-md md:pb-0">
                <p class="font-medium text-black">Qualifications Needed: </p>
                @php
                    $qualIterations = 0;
                @endphp
                @if (count($quals) != 0)
                    @foreach ($quals as $qual)
                        @if ($qualIterations < 2)
                            <x-qualification>{{ $qual->qualification_name }}</x-qualification>
                            @php
                                $qualIterations++;
                            @endphp
                        @endif
                    @endforeach
                    @if (count($quals) > 2)
                        <x-skill>...</x-skill>
                    @endif
                @else
                    <x-qualification>None</x-qualification>
                @endif

                @php
                    $user_vacancy = App\Models\UsersVacancy::where([['user_id', '=', auth()->id()], ['vacancy_id', '=', $vacancy->vacancy_id]])->first();
                @endphp

                <!-- Check if the owner owns this organisation dont show apply button.-->
                {{-- @if ($organisation->owner_id != auth()->id()) --}}


            </div>
        </div>
        <!-- Remove and Apply Buttons -->
        <div class="flex flex-row items-center justify-center pb-4 gap-3 md:justify-end md:mr-5">
            @if ($organisation->owner_id == auth()->id())
                <form action="/vacancies/{{ $vacancy->vacancy_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- <button>Delete Vacancy</button> --}}
                    <x-remove-button>
                        <span class="material-symbols-rounded">delete_forever</span>
                        Remove
                    </x-remove-button>
                </form>
                {{-- @endif --}}

                <!-- Check if the owner owns this organisation dont show apply button.-->
                {{-- @if ($organisation->owner_id != auth()->id()) --}}
                {{-- <x-primary-button class="flex gap-1">
                    <span class="material-symbols-rounded">
                        handshake
                    </span>
                    Apply
                </x-primary-button> --}}
            @endif


            @php
                $is_eligible = checkEligibility(auth()->user(), $vacancy);
                // dd($is_eligible);
            @endphp

            @if ($is_eligible)
                @if ($user_vacancy)
                    <form method="POST" action="/vacancies/{{ $vacancy->vacancy_id }}/unapply">
                        @csrf
                        @method('PUT')
                        <x-primary-button class="flex gap-1">
                            <span class="material-symbols-rounded">
                                handshake
                            </span>
                            Unapply
                        </x-primary-button>
                    </form>
                @else
                    <form method="POST" action="/vacancies/{{ $vacancy->vacancy_id }}/apply">
                        @csrf
                        @method('PUT')

                        <x-primary-button class="flex gap-1">
                            <span class="material-symbols-rounded">
                                handshake
                            </span>
                            Apply
                        </x-primary-button>
                    </form>
                @endif
                    @else
                    <p>Not eligible for this vacancy.</p>
            @endif


        </div>
    </div>
</x-card-base>
