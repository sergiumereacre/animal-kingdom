<x-app-layout>
    This page will show individuals
    {{-- <div>
        <p>{{$organisation->organisation_name}}</p>
    </div> --}}

    @unless(count($vacancies) == 0)

    @foreach($vacancies as $vacancy)
    <div>
        <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
    </div>
    @endforeach

    @else
    <p>No vacancies found</p>
    @endunless

    @unless(count($organisations) == 0)

    @foreach($organisations as $organisation)
    <div>
        <a href="/organisations/{{$organisation->organisation_id}}">{{$organisation->organisation_name}}</a>
    </div>
    @endforeach

    @else
    <p>No organisations found</p>
    @endunless
</x-app-layout>
