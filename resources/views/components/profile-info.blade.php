@props(['user', 'species', 'connections_num'])

<x-card-base class="max-w-md w-full h-max md:max-w-sm">
    <div class="py-10 px-16 flex flex-col items-center gap-5">
        <!-- User avatar and name -->
        <div class="flex flex-col items-center">
            {{-- <img class="h-56 w-56 rounded-full shadow-lg border-greenButtons border-4" src="{{ asset('img/logo.png') }}"
                alt="Company Logo" /> --}}
            <img class="h-56 w-56 rounded-full shadow-lg border-greenButtons border-4"
                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png') }}"
                alt="Company Logo" />
            <h1 class="text-4xl text-black font-black text-center p-5">{{ $user->first_name }} {{ $user->last_name }}
            </h1>
            {{-- <p class="text-xl text-gray-700 font-thin text-center">Software Engineer</p> --}}

            <p class="text-xl text-gray-700 font-thin text-center">{{ $user->username }}</p>


            @if ($user->is_admin)
                <div class="flex flex-row gap-1 items-center mt-3 bg-red-800 p-1 rounded-md">
                    <span class="material-symbols-rounded text-white">
                        admin_panel_settings
                    </span>
                    <p class="text-xs text-white font-bold text-center">Administrator</p>
                </div>
            @endif
        </div>
        <!-- Connect Button -->

        {{-- Check if connection exists --}}
        @php
            
            // Check if connection exists
            $connection = App\Models\Connection::where([['first_user_id', '=', auth()->id()], ['second_user_id', '=', $user->id]])
                ->orWhere([['first_user_id', '=', $user->id], ['second_user_id', '=', auth()->id()]])
                ->first();
            
        @endphp

        <div class="flex flex-col gap-2 items-center">
            {{-- You can't connect to yourself --}}
            @if ($user->id != auth()->id())
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

                {{-- Admins can only edit non admins --}}
                @if (auth()->user()->is_admin && !$user->is_admin)
                    <a href="/profile/{{ $user->id }}/edit">
                        <x-secondary-button class="flex items-center gap-2"><span class="material-symbols-rounded">
                                edit
                            </span>{{ __('Edit Profile') }}</x-secondary-button>
                    </a>
                @endif
            @else
                <a href="/profile/edit">
                    <x-secondary-button class="flex items-center gap-2"><span class="material-symbols-rounded">
                            edit
                        </span>{{ __('Edit Profile') }}</x-secondary-button>
                </a>
            @endif


        </div>
        <!-- Profile info section -->
        <div class="bg-appBackground rounded-2xl w-full p-10">
            <div>
                {{-- <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Pronouns:</h1>
                    <p class="text-lg">He/Him</p>
                </div> --}}
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Location:</h1>
                    <p class="text-lg">{{ $user->address }}</p>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Species:</h1>
                    <p class="text-lg">{{ $species->species_name }}</p>
                </div>
                {{-- <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Habitat:</h1>
                    <p class="text-lg">Water</p>
                </div> --}}
            </div>
            <hr class="h-px my-5 bg-greenButtons border-0">
            <div class="pb-5">
                <div class="flex flex-row items-center gap-2 justify-center">
                    <span class="material-symbols-rounded">call</span>
                    <h1 class="text-lg">{{ $user->contact_number }}</h1>
                </div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <span class="material-symbols-rounded">mail</span>
                    <h1 class="text-lg">{{ $user->email }}</h1>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Connections:</h1>
                    <p class="text-lg">{{ $connections_num }}</p>
                </div>
            </div>
        </div>
    </div>
</x-card-base>
