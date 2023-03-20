{{-- @php
    dd($connected_users);
@endphp --}}

@php
    $skills = App\Models\SkillsUser::all()->where('user_id', '=', $user->id);
    // dd($skills);

    $quals = App\Models\QualificationsUser::all()->where('user_id', '=', $user->id);
@endphp


<x-app-layout>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">


        <div class="flex flex-col lg:flex-row gap-5">
            <x-profile-info :user="$user" :species="$species" connections_num="{{ $connected_users->count() }}">
            </x-profile-info>
            <div class="flex flex-col items-center gap-5">
                <div class="flex lg:flex-row items-center gap-5 flex-col">
                    <div class="flex flex-col items-center gap-5">
                        <x-profile-bio :bio="$user->bio"></x-profile-bio>
                        <x-profile-skills :skills="$skills"></x-profile-skills>
                        <x-profile-qualifications :quals="$quals"></x-profile-qualifications>
                    </div>
                    <x-profile-connections :connected_users="$connected_users" class=" min-h-full"></x-profile-connections>
                </div>
                <x-profile-user-organisations :user="$user"></x-profile-user-organisations>
            </div>
        </div>

        {{-- 
        @unless(count($organisations) == 0)
            <p>Organisations owned: </p>
            @foreach ($organisations as $organisation)
                <div>

                    <a href="/organisations/{{ $organisation->organisation_id }}">{{ $organisation->organisation_name }}</a>

                    @if ($user->id == auth()->id())
                        <a href="/organisations/">Delete organisation</a>

                        @php
                        dd($organisation->organisation_id)
                        @endphp

                        <form action="/organisations/{{ $organisation->organisation_id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    @endif

                </div>
            @endforeach
        @else
            <p>No organisations found</p>
        @endunless


        @if ($user->id == auth()->id())
            <a href="/organisations/create">Create new organisation</a>
        @else
        @endif --}}

        {{-- @unless(count($users) == 0)
    
    
    {{-- <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

    </div>


        @unless(count($vacancies) == 0)

        @foreach ($vacancies as $vacancy)
            <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
        @endforeach

        @endunless --}}

        {{-- </x-app-layout> --}}


        {{-- <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">



            @unless(count($connected_users) == 0)


                @foreach ($connected_users as $user)
                    <x-user-card :user="$user"/>
                @endforeach

            @else
                <p>No connections found</p>
            @endunless
    </div> --}}


        {{-- <a href="/users/{{$user->id}}">{{$user->id}}
                {{$user->username}}</a> --}}

        {{-- <div class="">

        @unless(count($organisations) == 0)

        @foreach ($organisations as $organisation)


        @unless(count($vacancies) == 0)

        <div>All vacancies</div>

        @foreach ($vacancies as $vacancy)
        <div>
            <a href="/organisations/{{$organisation->organisation_id}}">{{$organisation->organisation_name}}</a>
            <x-company-full :organisation="$organisation"></x-company-full>
        </div>
        @endforeach

        @else
        <p>No vacancies found</p>
        @endunless

      </div>

      <div>
        <p>No organisations found</p>
        @endunless

    </div> --}}

        {{-- <div>

        @unless(count($connections) == 0)


        @foreach ($connections as $connection)
        <div>

            <a href="/users/{{$connection->id}}">{{$connection->id}}</a>
        </div>
        @endforeach

        @else
        <p>No connections found</p>
        @endunless

    </div> --}}

        {{-- <div>

        @unless(count($users) == 0)


        @foreach ($users as $user)
        <div>
            <x-user-card>
            </x-user-card>
            <a href="/users/{{$user->id}}">{{$user->id}}
            {{$user->username}}</a>
        </div>
        @endforeach

        @else
        <p>No users found</p>
        @endunless

    </div> --}}
</x-app-layout>
