@props(['vacancy', 'organisation'])

<x-card-base class="md:flex md:flex-row">
    <!-- Company Logo and Name -->
    <div class="flex flex-col items-center py-5 md:px-5 md:pt-11">
        <img class="w-24 md:w-auto md:h-auto h-24 mb-3 rounded-full shadow-lg" src="{{$organisation->picture ? asset('storage/' . $organisation->picture) : asset('img/logo.png')}}"
            alt="Company Logo" />
        <span class="text-sm text-black"><a
                href="/organisations/{{ $organisation->organisation_id }}">{{ $organisation->organisation_name }}</a></span>
    </div>
    <!-- Main Section -->
    <div>
        <!-- Job Title and Salary Range -->
        <div class="flex flex-col items-center md:flex-row md:pt-10">
            <h1 class="font-bold text-2xl"><a
                    href="/vacancies/{{ $vacancy->vacancy_id }}">{{ $vacancy->vacancy_title }}</a> </h1>
            <p class="pt-5 md:pt-0 font-bold text-greenButtons md:ml-auto md:mr-10">${{ $vacancy->salary_range_lower }} -
                ${{ $vacancy->salary_range_upper }}</p>
        </div>
        <!-- Job Description -->
        <div class="py-5">
            <p class="px-5 md:px-0 text-sm text-gray-700">{{ $vacancy->vacancy_description }}</p>
        </div>
        <!-- Skills and Buttons -->
        <div class="pb-5 flex flex-col items-center md:flex-row">
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
            <div class="flex items-center pb-5 gap-3 flex-row text-xs md:pb-0">
                <p class="font-medium text-black">Skills Needed: </p>
                @if (count($skills) != 0)
                    @foreach ($skills as $skill)
                        @php
                            // dd($skill);
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
                            <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill->skill_name }}</x-skill>
                        @endif
                    @endforeach
                @else
                    <x-skill>None</x-skill>
                @endif
                {{-- @foreach ($skills as $skill)
                    <x-skill>{{ $skill->skill_name }}</x-skill>
                @endforeach --}}
            </div>

            <div class="flex items-center pb-5 gap-3 flex-row text-xs md:pb-0">
                <p class="font-medium text-black">Qualifications Needed: </p>
                @if (count($quals) != 0)
                    @foreach ($quals as $qual)
                        <x-qualification>{{ $qual->qualification_name }}</x-qualification>
                    @endforeach
                @else
                    <x-qualification>None</x-qualification>
                @endif

            </div>
            <!-- Remove and Apply Buttons -->
            <div class="flex flex-row gap-3 md:ml-auto md:mr-5">
                @if ($organisation->owner_id == auth()->id())
                    <form action="/vacancies/{{ $vacancy->vacancy_id }}" method="post">
                        @csrf
                        @method('DELETE')
                        {{-- <button>Delete Vacancy</button> --}}
                        <x-remove-button>
                            Remove
                        </x-remove-button>
                    </form>
                @endif

                <x-primary-button>
                    Apply
                </x-primary-button>
            </div>
        </div>
    </div>
</x-card-base>
