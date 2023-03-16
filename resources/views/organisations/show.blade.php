<x-app-layout>
    This page will show individual organisations
    <div>
        <p>Name: {{$organisation->organisation_name}}</p>
    </div>

    @unless(count($vacancies) == 0)

    @foreach($vacancies as $vacancy)
    <div>
        <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
    </div>
    @endforeach

    @else
    <p>No vacancies found</p>
    @endunless
</x-app-layout>
