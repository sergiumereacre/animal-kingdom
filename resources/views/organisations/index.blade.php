<x-app-layout>
    <div class="pt-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($organisations as $organisation)
            <x-organisation-card :organisation="$organisation"></x-organisation-card>
        @endforeach
    </div>

    <div class="p-10">
        {{$organisations->links()}}
    </div>
</x-app-layout>
