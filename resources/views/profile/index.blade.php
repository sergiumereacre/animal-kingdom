<x-app-layout>
    This page will show an index of users

    @foreach ($users as $user)
    <div>
        <div>
            <a href="/users/{{$user->id}}">{{$user->username}}</a>
        </div>
    </div>
    @endforeach
</x-app-layout>
