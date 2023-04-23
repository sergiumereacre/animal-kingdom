@props(['vacancy', 'organisation'])

@php
    $no_matter = "Doesn't matter";
@endphp

<x-card-base>
    <!-- Company Logo And Name -->
    <div class="flex flex-col items-center py-5 md:px-5 md:pt-5">
        <img class="w-36 h-36 mb-3 rounded-full shadow-lg"
            src="{{ $organisation->picture ? asset('storage/' . $organisation->picture) : asset('img/logo.png') }}"
            alt="Company Logo" />
        <span class="text-sm text-black"><a
                href="/organisations/{{ $vacancy->organisation_id }}">{{ $organisation->organisation_name }}</a></span>
    </div>
    <!-- Main Section -->
    <div>
        <!-- Job Title -->
        <div class="flex flex-col items-center md:flex-row">
            <h1 class="font-bold text-2xl md:mx-auto">{{ $vacancy->vacancy_title }}</h1>
        </div>
        <!-- Salary Range -->
        <div class="px-5 py-5 flex flex-col md:flex-row items-center md:py-0">
            <p class="font-medium text-black md:p-5 md:w-44">Salary Range:</p>
            <p class="font-bold text-greenButtons">${{ $vacancy->salary_range_lower }} -
                ${{ $vacancy->salary_range_upper }}</p>
        </div>
        <!-- Job Description -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:p-5 md:w-44">Job Description:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700">
                @if ($vacancy->vacancy_description == '')
                    None
                @endif
                {{ $vacancy->vacancy_description }}
            </p>
        </div>

        <!-- Lots of questions -->
        <div class="grid md:grid-cols-2 gap-5 pb-5">
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Time Created:</p>
                <p class="md:px-0 text-sm text-gray-700">{{ $vacancy->time_created }}</p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Category Requirement:</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->category_requirement;

                        if (!is_null($var)) {
                            echo ucfirst(strtolower($var));
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Should Applicants be Able to Fly?</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->can_fly_requirement;

                        if (!is_null($var)) {
                            if ($var == true) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Should Applicants be Able to Swim?</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->can_swim_requirement;

                        if (!is_null($var)) {
                            if ($var == true) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Should Applicants be Able to Climb?</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->can_climb_requirement;

                        if (!is_null($var)) {
                            if ($var == true) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Should Applicants be Able to Produce Toxins?</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->produces_toxins_requirement;

                        if (!is_null($var)) {
                            if ($var == true) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Eating Style Requirement:</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->eating_style_requirement;

                        if (!is_null($var)) {
                            echo ucfirst(strtolower($var));
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Size Requirement:</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->size_requirement;

                        if (!is_null($var)) {
                            echo ucfirst(strtolower($var));
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44">Speed Requirement:</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->speed_requirement;

                        if (!is_null($var)) {
                            echo ucfirst(strtolower($var));
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
            <div class="px-5 flex flex-col md:flex-row items-center">
                <p class="font-medium text-black md:p-5 md:w-44 text-center md:text-left">How Many Appendages Should
                    Applicants Have?</p>
                <p class="md:px-0 text-sm text-gray-700">
                    @php
                        $var = $vacancy->num_appendages_requirement;

                        if (!is_null($var)) {
                            echo ucfirst(strtolower($var));
                        } else {
                            echo $no_matter;
                        }
                    @endphp
                </p>
            </div>
        </div>

        <!-- Skills Needed and Buttons -->
        <div class="pb-5 px-5 flex flex-col items-center md:flex-row md:flex-wrap">
            <div class="flex items-center pb-5 gap-3 md:gap-0 flex-row md:pb-0">

                @php
                    $skills = App\Models\Skill::all()->whereIn(
                        'skill_id',
                        Illuminate\Support\Facades\DB::table('skills_vacancies')
                            ->where('vacancy_id', '=', $vacancy->vacancy_id)
                            ->pluck('skill_id'),
                    );

                    $quals = App\Models\Qualification::all()->whereIn(
                        'qualification_id',
                        Illuminate\Support\Facades\DB::table('qualifications_vacancies')
                            ->where('vacancy_id', '=', $vacancy->vacancy_id)
                            ->pluck('qualification_id'),
                    );
                @endphp

                <p class="font-medium text-black md:p-5 md:w-44">Skills Needed: </p>
                <!-- Automated Skills List -->
                <div class="flex gap-3 text-xs">
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
                                <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill->skill_name }}
                                </x-skill>
                            @endif
                        @endforeach
                    @else
                        <x-skill>None</x-skill>
                    @endif
                </div>
            </div>

            <div class="flex items-center pb-5 gap-3 md:gap-0 flex-row md:pb-0">
                <p class="font-medium text-black md:p-5 md:w-44">Qualifications Needed: </p>
                <div class="flex gap-3 text-xs">
                    @if (count($quals) != 0)
                        @foreach ($quals as $qual)
                            <x-qualification>{{ $qual->qualification_name }}</x-qualification>
                        @endforeach
                    @else
                        <x-qualification>None</x-qualification>
                    @endif
                </div>
            </div>
        </div>

        <!-- Remove and Apply Buttons -->
        <div class="flex flex-row items-center justify-center pb-4 gap-3 md:justify-end md:mr-5">
            @php
                $user_vacancy = App\Models\UsersVacancy::where([['user_id', '=', auth()->id()], ['vacancy_id', '=', $vacancy->vacancy_id]])->first();
            @endphp
            @if ($organisation->owner_id == auth()->id() || auth()->user()->is_admin)

                <form action="/vacancies/{{ $vacancy->vacancy_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-remove-button>
                        <span class="material-symbols-rounded">delete_forever</span>
                        Remove
                    </x-remove-button>
                </form>
                <a href="/vacancies/{{ $vacancy->vacancy_id }}/edit">
                    <x-secondary-button class="flex gap-2">
                        <span class="material-symbols-rounded">edit</span>
                        Edit
                    </x-secondary-button>
                </a>

            @else
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
                    <x-primary-button
                        class="flex gap-1 disabled bg-slate-600 hover:bg-slate-800 focus:bg-slate-900 focus:ring-slate-600">
                        <span class="material-symbols-rounded">
                            heart_broken
                        </span>
                        Not Eligible
                    </x-primary-button>
                @endif


            @endif

        </div>
    </div>
</x-card-base>
