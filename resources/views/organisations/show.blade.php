<x-app-layout>

    <x-organisation-full :organisation="$organisation"></x-organisation-full>


    @unless(count($vacancies) == 0)

        <div>All vacancies belonging to this company:</div>

        @foreach ($vacancies as $vacancy)
            <div>
                <a href="/vacancies/{{ $vacancy->vacancy_id }}">{{ $vacancy->vacancy_title }}</a>
            </div>

            @if ($organisation->owner_id == auth()->id())
                <form action="/vacancies/{{ $vacancy->vacancy_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>Delete Vacancy</button>
                </form>
            @endif

        @endforeach
    @else
        <p>No vacancies found</p>
    @endunless

    @if ($owner->id == auth()->id())
        <a href="/vacancies/{{ $organisation->organisation_id }}/create">Create new vacancy</a>
    @else
    @endif
</x-app-layout>
