<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

    </div>

    <div>

        @unless(count($vacancies) == 0)

        @foreach($vacancies as $vacancy)
        <div>
            <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
        </div>
        @endforeach

        @else
        <p>No vacancies found</p>
        @endunless

      </div>

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
