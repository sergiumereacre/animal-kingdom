<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

    </div>

    <div>

        @unless(count($vacancies) == 0)

        @foreach($vacancies as $vacancy)
        <div>
            <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>

<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

        <div>


            @unless(count($users) == 0)


                @foreach($users as $user)
                    <x-user-card :user="$user"/>
                @endforeach

                @else
                <p>No users found</p>
            @endunless
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

      {{-- <div>
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
