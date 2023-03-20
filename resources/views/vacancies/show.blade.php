<x-app-layout>
    This page will show individual vacancies

{{-- @php
    dd($organisation);
@endphp --}}

    <div>
        {{-- @php
            dd($vacancy);
        @endphp --}}
        <a href="/organisations/{{$vacancy->organisation_id}}">Organisation name: {{$organisation->organisation_name}}</a>
            @foreach ($vacancy->getAttributes() as $key=>$attr)
                <p>{{$key}}: {{$attr}}</p>
            @endforeach
    </div>

    {{-- Check if the current user isn't the owner --}}
    @if (auth()->id() != $organisation->owner_id)
        <a href="/vacancies/{{$vacancy->vacancy_id}}/apply">Apply for vacancy</a>
    @endif
</x-app-layout>
