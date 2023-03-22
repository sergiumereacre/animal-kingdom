
<x-app-layout>
    
    <h1> users! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @if(isset($users))
            @unless(count($users) == 0)
                @foreach($users as $count => $user)
                    @if(App\Http\Controllers\SearchController::DISPLAY_LIMIT <= $count)
                        @break
                    @endif
                    <x-user-card :user="$user"/>
                @endforeach
            @else
                <p>No users found</p>
            @endunless
        @endif
    </div>
    <a href="{{route('users.index')}}">View more users</a>

    <h1> orgs! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @if(isset($organisations))
            @unless(count($organisations) == 0)
                @foreach($organisations as $count => $organisation)
                    @if(App\Http\Controllers\SearchController::DISPLAY_LIMIT <= $count)
                        @break
                    @endif
                    <x-company-full :organisation="$organisation"></x-company-full>
                @endforeach
            @else
                <p>No organisations found</p>
            @endunless
        @endif
    </div>
    <a href="/organisations">View more organisations</a>

    <h1> vacancies! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @if(isset($vacancies))
            @unless(count($vacancies) == 0)
                @foreach($vacancies as $count => $vacancy)
                    @if(App\Http\Controllers\SearchController::DISPLAY_LIMIT <= $count)
                        @break
                    @endif
                    <x-vacancy :vacancy="$vacancy"></x-vacancy>
                @endforeach
            @else
                <p>No users found</p>
            @endunless
        @endif
    </div>
    <a href="/vacancies">View more vacancies</a>
</div>
</x-app-layout>
