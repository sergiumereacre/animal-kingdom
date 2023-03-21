<x-app-layout>

    <div class="flex flex-col items-center justify-center py-10 gap-5">
        <x-organisation-full :organisation="$organisation"></x-organisation-full>
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col gap-5 items-center">
                @unless(count($vacancies) == 0)
                    <p class="text-white text-lg text-center font-bold bg-blue-500 w-max shadow-xl  rounded-lg p-3 flex gap-2"><span class="material-symbols-rounded">
                        receipt_long
                        </span>Vacancies Owned</p>
                    @foreach ($vacancies as $vacancy)
                        <x-vacancy :vacancy="$vacancy" :organisation="$organisation"></x-vacancy>
                    @endforeach
                @else
                <p class="text-white text-lg text-center font-bold bg-blue-500 w-max shadow-xl  rounded-lg p-3 flex gap-2"><span class="material-symbols-rounded">
                    receipt_long
                    </span>No Vacancies Owned</p>
                @endunless
            </div>
            @if ($owner->id == auth()->id())
                <x-primary-button class="flex gap-1">
                    <span class="material-symbols-rounded">
                        edit
                    </span>
                    <a href="/vacancies/{{ $organisation->organisation_id }}/create">Create new vacancy</a>
                </x-primary-button>
            @else
            @endif
        </div>
    </div>
</x-app-layout>
