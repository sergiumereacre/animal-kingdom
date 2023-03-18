<x-app-layout>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

        <div class="flex flex-col lg:flex-row gap-5">
            <x-profile-info></x-profile-info>
            <div class="flex flex-col items-center gap-5">
                <div class="flex lg:flex-row items-center gap-5 flex-col">
                    <div class="flex flex-col items-center gap-5">
                        <x-profile-bio></x-profile-bio>
                        <x-profile-skills></x-profile-skills>
                    </div>
                    <x-profile-connections></x-profile-connections>
                </div>
                <x-profile-previous-jobs></x-profile-previous-jobs>
            </div>
        </div>

            {{-- @unless(count($users) == 0)
    
    
    {{-- <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

    </div>


        @unless(count($vacancies) == 0)

        @foreach($vacancies as $vacancy)
            <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
        @endforeach

        @endunless --}}

{{-- </x-app-layout> --}}


    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">



            @unless(count($users) == 0)


                @foreach($users as $user)
                    <x-user-card :user="$user"/>
                @endforeach

            @else
                <p>No users found</p>
            @endunless --}}
    </div>


                {{-- <a href="/users/{{$user->id}}">{{$user->id}}
                {{$user->username}}</a> --}}

    {{-- <div class="">

        @unless(count($organisations) == 0)

        @foreach($organisations as $organisation)


        @unless(count($vacancies) == 0)

        <div>All vacancies</div>

        @foreach($vacancies as $vacancy)
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


        @foreach($connections as $connection)
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


        @foreach($users as $user)
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
