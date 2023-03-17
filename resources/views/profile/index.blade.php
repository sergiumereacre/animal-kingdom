<x-app-layout>
    This page will show an index of users

    @foreach ($users as $user)
    <div>
        <a href="{{$user->id}}">        {{$user->username}}
        </a>

    </div>
    @endforeach
</x-app-layout>
