@props(['bio'])

<x-card-base class="max-w-md w-full md:max-w-2xl">
    <div class="p-10">
        <!-- User avatar and name -->
        <div class="flex flex-col">
            <h1 class="text-3xl text-black font-black pb-3">Bio</h1>
            <p class="text-lg text-gray-700 font-thin">{{$bio}}</p>
        </div>
    </div>
</x-card-base>