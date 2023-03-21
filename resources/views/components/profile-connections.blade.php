@props(['connected_users'])



<x-card-base class="max-w-md md:w-max md:max-w-md">
    <div class="p-10">
        <!-- User avatar and name -->
        <div class="flex flex-col">
            <h1 class="text-3xl text-black font-black pb-3">Connections</h1>
            <div class="flex flex-col items-center gap-5">
                <!-- Avatar and Name -->
                @unless(count($connected_users) == 0)
                    @foreach ($connected_users as $user)
                        <div class="flex flex-col items-center">
                            <img class="w-36 h-36 mb-3 rounded-full shadow-lg" src="{{$user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/logo.png')}}"
                                alt="Company Logo" />
                            <span class="text-lg text-black"><a href="/users/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></span>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 mb-3 rounded-full shadow-lg bg-gray-200"></div>
                        <span class="text-lg text-black">None</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 mb-3 rounded-full shadow-lg bg-gray-200"></div>
                        <span class="text-lg text-black">None</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 mb-3 rounded-full shadow-lg bg-gray-200"></div>
                        <span class="text-lg text-black">None</span>
                    </div>
                @endunless
            </div>
        </div>
    </div>
</x-card-base>
