<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">

        <div>


            @unless(count($users) == 0)
    
    
            @foreach($users as $user)
            <div>
                <x-user-card :user="$user"/>

            </div>
            @endforeach
    
            @else
            <p>No users found</p>
            @endunless 
    
        </div>
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
