@props(['skills'])

<x-card-base class="max-w-md w-ful md:max-w-2xl">
    <div class="p-10">
        <!-- User avatar and name -->
        <div class="flex flex-col">
            <h1 class="text-3xl text-black font-black pb-3">Skills</h1>
            <div class="text-lg flex flex-wrap items-center flex-row gap-5">



                @foreach ($skills as $skill)
                    @php
                        $skill_name = App\Models\Skill::all()->find($skill->skill_id)->skill_name;
                        // dd($skill->skill_level);
                    @endphp

                    @if ($skill->skill_level == 'BEGINNER')
                        <x-skill style="background-color: rgb(231, 255, 231)">{{ $skill_name }}</x-skill>
                    @endif

                    @if ($skill->skill_level == 'INTERMEDIATE')
                        <x-skill style="background-color: rgb(224, 205, 255)">{{ $skill_name }}</x-skill>
                    @endif

                    @if ($skill->skill_level == 'EXPERT')
                        <x-skill style="background-color: rgb(255, 207, 207)">{{ $skill_name }}</x-skill>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-card-base>
