<x-app-layout>
    This page will show individual vacancies

{{-- @php
    dd($organisation);
@endphp --}}

    <div>
        <a href="/organisations/{{$vacancy->organisation_id}}">Organisation name: {{$organisation->organisation_name}}</a>
    </div>
</x-app-layout>
