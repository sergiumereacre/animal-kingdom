<x-app-layout>
    This page will show individual organisations
    <div>
        <p>Organisation Name: {{$organisation->organisation_name}}</p>
        <p>Owner Name: <a href="/users/{{$owner->id}}">{{$owner->username}}</a></p>
    </div>

    @unless(count($vacancies) == 0)

    <div>All vacancies belonging to this company:</div>

    @foreach($vacancies as $vacancy)
    <div>
        <a href="/vacancies/{{$vacancy->vacancy_id}}">{{$vacancy->vacancy_title}}</a>
    </div>
    @endforeach

    @else
    <p>No vacancies found</p>
    @endunless
</x-app-layout>
