<x-app-layout>
    This page will show an index of users

    @foreach ($users as $user)
    <div>
        {{$user->username}}

    </div>
    @endforeach
</x-app-layout>
