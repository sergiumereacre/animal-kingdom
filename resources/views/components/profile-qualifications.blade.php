@props(['quals'])

<x-card-base class="max-w-md w-ful md:max-w-2xl">
    <div class="p-10">
        <!-- User avatar and name -->
        <div class="flex flex-col">
            <h1 class="text-3xl text-black font-black pb-3">Qualifications</h1>
            <div class="text-lg flex flex-wrap items-center flex-row gap-5">
                @if (count($quals) != 0)
                    @foreach ($quals as $qual)
                        @php
                            $qual_name = App\Models\Qualification::all()->find($qual->qualification_id)->qualification_name;
                        @endphp

                        <x-qualification>{{ $qual_name }}</x-qualification>
                    @endforeach
                @else
                    <x-qualification>None</x-qualification>

                @endif
            </div>
        </div>
    </div>
</x-card-base>
