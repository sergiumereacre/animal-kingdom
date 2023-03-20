<x-app-layout>
    <x-vacancy-full :vacancy="$vacancy" :organisation="$organisation"></x-vacancy-full>
    <a href="/organisations/{{$vacancy->organisation_id}}">Organisation name: {{$organisation->organisation_name}}</a>
</x-app-layout>
