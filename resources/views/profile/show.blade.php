{{-- @php
    dd($connected_users);
@endphp --}}


<x-app-layout>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">


        <div class="flex flex-col lg:flex-row gap-5">
            <x-profile-info :user="$user" :species="$species" connections_num="{{ $connected_users->count() }}">
            </x-profile-info>
            <div class="flex flex-col items-center gap-5">
                <div class="flex lg:flex-row items-center gap-5 flex-col">
                    <div class="flex flex-col items-center gap-5">
                        <x-profile-bio :bio="$user->bio"></x-profile-bio>

                     
                        <x-profile-skills></x-profile-skills>
                        <x-profile-qualifications></x-profile-qualifications>
                    </div>
                    <x-profile-connections :connected_users="$connected_users"></x-profile-connections>
                </div>
                <x-profile-user-organisations :user="$user"></x-profile-user-organisations>
            </div>
        </div>


        {{-- @unless(count($organisations) == 0)
            <p>Organisations owned: </p>
            @foreach ($organisations as $organisation)
                <div>

                    <a href="/organisations/{{ $organisation->organisation_id }}">{{ $organisation->organisation_name }}</a>

                    @if ($user->id == auth()->id())

                        <form action="/organisations/{{ $organisation->organisation_id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    @endif

                </div>
            @endforeach
        @else
            <p>No organisations found</p>
        @endunless


        @if ($user->id == auth()->id())
            <a href="/organisations/create">Create new organisation</a>
        @else
        @endif --}}

</x-app-layout>
