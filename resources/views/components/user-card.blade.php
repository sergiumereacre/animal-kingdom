@props(['user'])

@php
    $current_user = App\Models\User::find(auth()->id());
@endphp

<x-card-base class="md:flex md:flex-row md:max-w-xl">
    <!-- Avatar and Current Positon -->
    <div class="flex flex-col items-center py-5 md:mx-5 md:w-max md:h-max md:pt-10">
        <img class="w-36 h-36 min-w-max mb-3 rounded-full shadow-lg" src="{{$user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png')}}"
            alt="Company Logo" />
        <span class="text-md text-gray-800 font-bold text-center">{{ $user->username }}</span>
    </div>
    <div class="md:mr-5 md:max-w-sm">
        <!--User Name and Location-->
        <div class="flex flex-col items-center md:flex-row md:pt-8">
            <h1 class="font-bold text-2xl"><a
                    href="/users/{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</a> </h1>
            <div class="flex flex-row items-center pt-5 md:pt-0 md:ml-auto mr-5 md:mr-0">
                <p class="md:pt-0 font-bold text-greenButtons ml-5 md:ml-0 text-center md:text-end">{{ $user->address }}
                </p>
                <span class="material-symbols-rounded text-greenButtons ml-2">location_on</span>
            </div>
        </div>
        <!--User profile description.-->
        <div class="p-5 md:p-0 md:py-5 md:min-h-max">
            <p class="md:px-0 text-sm text-gray-700">{{ $user->bio }}</p>
        </div>
        <!-- User Skills -->
        <div class="flex flex-row justify-center md:justify-start gap-2 flex-wrap pb-5">
            @php
                $skills = App\Models\SkillsUser::all()->where('user_id', $user->id);
            @endphp

            @php
                $iteration = 0;
            @endphp
            @foreach ($skills as $skill)
                @if ($iteration < 3)
                    @php
                        $skill_name = App\Models\Skill::all()->find($skill->skill_id)->skill_name;
                        // dd($skills);
                    @endphp

                    @if ($skill->skill_level == 'BEGINNER')
                        <x-skill style="background-color: rgb(231, 255, 231)">{{ $skill_name }}</x-skill>
                    @endif

                    @if ($skill->skill_level == 'INTERMEDIATE')
                        <x-skill style="background-color: rgb(224, 205, 255)">{{ $skill_name }}</x-skill>
                    @endif

                    @if ($skill->skill_level == 'EXPERT')
                        <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill_name }}</x-skill>
                    @endif
                @endif
                @php
                    $iteration++;
                @endphp
            @endforeach
            <!-- Check if skills is greater than 0 -->
            @if ($skills->count() >= 3)
                <x-skill>...</x-skill>
            @endif
        </div>
        <!--Connect Button-->
        <div class="pb-5 flex flex-col items-center md:items-end">
            
            {{-- Make sure that the current user can't ban themselves!! --}}
            @if ($user->id != $current_user->id)
            
            {{-- Only show these buttons if the current user is an admin and the selected user isn't --}}
                @if ($current_user->is_admin && !$user->is_admin)
                    @if (!$user->is_banned)
                        <form method="POST" action="/users/{{ $user->id }}/toggleBan">
                            @csrf
                            @method('PUT')
                            <x-primary-button>
                                Ban
                            </x-primary-button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{ $user->id }}/toggleBan">
                            @csrf
                            @method('PUT')
                            <x-primary-button>
                                Unban
                            </x-primary-button>
                        </form>
                    @endif
                    <form action="/users/{{ $user->id }}" class="pt-2 md:ml-auto" method="post">
                        @csrf
                        @method('DELETE')
                        <x-remove-button><span class="material-symbols-rounded">delete</span></x-remove-button>

                    </form>
                @endif

                <x-primary-button>
                    Connect
                </x-primary-button>
            @endif

        </div>
    </div>
</x-card-base>

