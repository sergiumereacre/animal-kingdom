<x-app-layout>
    This page will show individual vacancies

    <div>
        <a href="/organisations/{{$vacancy->organisation_id}}">{{$vacancy->vacancy_title}}</a>
    </div>
</x-app-layout>
