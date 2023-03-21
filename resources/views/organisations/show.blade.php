<x-app-layout>

    <x-organisation-full :organisation="$organisation"></x-organisation-full>


    @unless(count($vacancies) == 0)

        <div>All vacancies belonging to this company:</div>

        @foreach ($vacancies as $vacancy)
            <x-vacancy :vacancy="$vacancy" :organisation="$organisation"></x-vacancy>

           

        @endforeach
    @else
        <p>No vacancies found</p>
    @endunless

    @if ($owner->id == auth()->id())
        <a href="/vacancies/{{ $organisation->organisation_id }}/create">Create new vacancy</a>
    @else
    @endif
</x-app-layout>
