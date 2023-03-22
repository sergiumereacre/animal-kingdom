<x-app-layout>

    <div class="pt-10 px-12 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">
        @foreach ($users as $user)
            <x-user-card :user="$user"/>
        @endforeach
    </div>
    
    <div class="p-10">
        {{$users->links()}}
    </div>
</x-app-layout>
