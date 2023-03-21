<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($organisations as $organisation)
            <x-organisation-full :organisation="$organisation"></x-organisation-full>
        @endforeach
    </div>
</x-app-layout>
