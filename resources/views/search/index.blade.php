
<x-app-layout>
    
    <h1> users! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @unless(count($users) == 0 || $users == null)
            @foreach($users as $user)
                <x-user-card :user="$user"/>
            @endforeach
        @else
            <p>No users found</p>
        @endunless
    </div>

    <h1> orgs! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @unless(count($organisations) == 0 || $organisations == null)
            @foreach($organisations as $organisation)
            <div>
                <x-company-full :organisation="$organisation"></x-company-full>
            </div>
            @endforeach
        @else
            <p>No organisations found</p>
        @endunless
    </div>

    <h1> vacancies! </h1>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @unless(count($vacancies) == 0 || $vacancies == null)
            @foreach($vacancies as $vacancy)
                <div>
                    <x-vacancy :vacancy="$vacancy"></x-vacancy>
                </div>
            @endforeach
        @else
            <p>No users found</p>
        @endunless
    </div>
</div>
</x-app-layout>
