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
</x-app-layout>
