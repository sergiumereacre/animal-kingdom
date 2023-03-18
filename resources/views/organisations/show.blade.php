<x-app-layout>
    This page will show individual organisations
    <div>
        <p>Organisation Name: {{ $organisation->organisation_name }}</p>
        <p>Owner Name: <a href="/users/{{ $owner->id }}">{{ $owner->username }}</a></p>
        @if ($owner->id == auth()->id())
            <a href="/organisations/{{ $organisation->organisation_id }}/edit">Edit Organisation</a>
        @else
        @endif
    </div>

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
