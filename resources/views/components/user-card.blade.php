@props(['user'])


<x-card-base class="md:flex md:flex-row md:max-w-xl">
    <!-- Avatar and Current Positon -->
    <div class="flex flex-col items-center py-5 md:mx-5 md:w-max md:h-max md:pt-10">
        <img class="w-36 h-36 min-w-max mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
        <span class="text-md text-gray-800 font-bold text-center">{{$user->username}}</span>
    </div>
    <div class="md:mr-5 md:max-w-sm">
        <!--User Name and Location-->
        <div class="flex flex-col items-center md:flex-row md:pt-8">
            <h1 class="font-bold text-2xl">{{$user->first_name." ".$user->last_name}}</h1>
            <div class="flex flex-row items-center pt-5 md:pt-0 md:ml-auto mr-5 md:mr-0">
                <p class="md:pt-0 font-bold text-greenButtons ml-5 md:ml-0 text-center md:text-end">{{$user->address}}</p>
                <span class="material-symbols-rounded text-greenButtons ml-2">location_on</span>
            </div>
        </div>
        <!--User profile description.-->
        <div class="p-5 md:p-0 md:py-5 md:min-h-max">
            <p class="md:px-0 text-sm text-gray-700">{{$user->bio}}</p>
        </div>
        <!--Connect Button-->
        <div class="pb-5 flex flex-col items-center md:items-end">
            <x-primary-button>
                Connect
            </x-primary-button>
        </div>
    </div>
</x-card-base>