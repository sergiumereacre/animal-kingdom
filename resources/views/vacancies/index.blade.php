<x-app-layout>
    <div class="pt-10 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($vacancies as $vacancy)
            @php
                $organisation = App\Models\Organisation::all()->where('organisation_id', '=', $vacancy->organisation_id)->first();
            @endphp
            <x-vacancy :vacancy="$vacancy" :organisation="$organisation" />
        @endforeach
    </div>

    <div class="p-10">
        {{$vacancies->links()}}
    </div>
</x-app-layout>
