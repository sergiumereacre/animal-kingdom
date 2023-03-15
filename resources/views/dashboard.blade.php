<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        <x-user-card>
        </x-user-card>
        <x-user-card>
        </x-user-card>
        <x-user-card>
        </x-user-card>
    </div>

    <div>

        @unless(count($organisations) == 0)

        @foreach($organisations as $organisation)
        <div>
            <a href="/organisations/{{$organisation->organisation_id}}">{{$organisation->organisation_name}}</a>
        </div>
        @endforeach

        @else
        <p>No organisations found</p>
        @endunless

      </div>

      {{-- <div>

        @unless(count($connections) == 0)


        @foreach($connections as $connection)
        <div>
            {{$connected_user = User::all()->where('id', '=', $connection->second_user_id)}}

            <a href="/users/{{$connected_user->id}}">{{$connected_user->id}}
            {{$connected_user->username}}</a>
        </div>
        @endforeach

        @else
        <p>No connections found</p>
        @endunless

      </div> --}}
</x-app-layout>
