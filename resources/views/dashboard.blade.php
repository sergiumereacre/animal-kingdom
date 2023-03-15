<x-app-layout>
    <div class="py-12 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        <x-user-card>
        </x-user-card>
        <x-user-card>
        </x-user-card>
        <x-user-card>
        </x-user-card>
    </div>

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($organisations) == 0)

        @foreach($organisations as $organisation)
        <div>
            <a href="/organisations/{{$organisation->organisation_id}}">{{$organisation->organisation_name}}</a>
        </div>
        @endforeach

        @else
        <p>No organisations found</p>
        @endunless

      </div>
</x-app-layout>
