
<x-app-layout>
    
    @if(isset($users))
    <h1> Users </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
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
    </div>
    <a href="">View more users</a>
    @endif

    @if(isset($organisations))
    <h1> Organisations </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
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
    </div>
    <a href="">View more organisations</a>
    @endif

    @if(isset($vacancies))
    <h1> Vacancies </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
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
    </div>
    <a href="">View more vacancies</a>
    @endif
</x-app-layout>
