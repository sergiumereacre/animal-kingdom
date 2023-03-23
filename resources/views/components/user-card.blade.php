@props(['user'])

@php
    $current_user = App\Models\User::find(auth()->id());
    $skills = App\Models\SkillsUser::all()->where('user_id', $user->id);
    // Check if connection exists
    $connection = App\Models\Connection::where([['first_user_id', '=', auth()->id()], ['second_user_id', '=', $user->id]])
        ->orWhere([['first_user_id', '=', $user->id], ['second_user_id', '=', auth()->id()]])
        ->first();
    
@endphp

<x-card-base class="md:flex md:flex-row md:max-w-xl">
    <!-- Avatar and Current Positon -->
    <div class="flex flex-col items-center py-5 md:mx-5 md:m-auto md:min-w-fit">
        <img class="w-36 h-36 object-fill mb-3 rounded-full shadow-lg aspect-square"
            src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png') }}"
            alt="Company Logo" />
        <span class="text-md text-gray-800 font-bold text-center">{{ $user->username }}</span>
        @if ($user->is_admin)
            <div class="flex flex-row gap-1 items-center mt-3 bg-red-800 p-1 rounded-md">
                    <span class="material-symbols-rounded text-white">
                        admin_panel_settings
                    </span>
                    <p class="text-xs text-white font-bold text-center">Administrator</p>
            </div>
        @endif
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
        <div
            class="pb-5 flex flex-row items-center justify-center  md:justify-end flex-wrap gap-2 px-5 md:px-0 md:items-end">

            {{-- Make sure that the current user can't ban themselves!! --}}
            @if ($user->id != auth()->id())

                {{-- Only show these buttons if the current user is an admin and the selected user isn't --}}
                @if (auth()->user()->is_admin && !$user->is_admin)
                    @if (!$user->is_banned)
                        <form method="POST" class="md:ml-auto" action="/users/{{ $user->id }}/toggleBan">
                            @csrf
                            @method('PUT')
                            <x-remove-button class="flex gap-2">
                                <span class="material-symbols-rounded">do_not_disturb_on</span> BAN
                            </x-remove-button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{ $user->id }}/toggleBan">
                            @csrf
                            @method('PUT')
                            <x-primary-button class="flex gap-2">
                                <span class="material-symbols-rounded">check_circle</span>UNBAN
                            </x-primary-button>
                        </form>
                    @endif
                    <form action="/users/{{ $user->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-remove-button class="flex gap-2"><span
                                class="material-symbols-rounded">delete_forever</span>REMOVE</x-remove-button>
                    </form>
                @endif

                @if ($connection)
                    <form method="POST" action="/users/{{ $user->id }}/toggleConnect">
                        @csrf
                        @method('PUT')
                        <x-remove-button class="flex items-center gap-2"><span class="material-symbols-rounded">
                                person_remove
                            </span>{{ __('Disconnect') }}</x-remove-button>

                    </form>
                @else
                    <form method="POST" action="/users/{{ $user->id }}/toggleConnect">
                        @csrf
                        @method('PUT')
                        <x-primary-button class="flex items-center gap-2"><span class="material-symbols-rounded">
                                person_add
                            </span>{{ __('Connect') }}</x-primary-button>
                    </form>
                @endif
            @endif

        </div>
    </div>
</x-card-base>
