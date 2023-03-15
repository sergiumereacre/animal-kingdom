<x-card-base class="md:flex md:flex-row md:max-w-xl md:min-w-lg">
    <!-- Avatar and Current Positon -->
    <div class="flex flex-col items-center py-5 md:mx-5 md:pt-10 md:w-max">
        <img class="w-36 h-36 md:h-max md:w-max mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
        <span class="text-sm text-black text-center">Software Engineer</span>
    </div>
    <div class="md:mr-5">
        <!--User Name and Location-->
        <div class="flex flex-col items-center md:flex-row md:pt-8">
            <h1 class="font-bold text-2xl">Timmothy Stevens</h1>
            <div class="flex flex-row items-center pt-5 md:pt-0 md:ml-auto">
                <p class="md:pt-0 font-bold text-greenButtons">California</p>
                <span class="material-symbols-rounded text-greenButtons ml-2">location_on</span>
            </div>
        </div>
        <!--User profile description.-->
        <div class="p-5 md:p-0 md:py-5">
            <p class="md:px-0 text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum augue efficitur, auctor massa sit amet, efficitur tortor. Phasellus a odio fringilla, varius nisl non, condimentum purus. Donec sed nisl dictum, cursus dolor sit amet, mollis magna. Pellentesque blandit augue eget tellus gravida, rhoncus volutpat justo congue. Sed mollis auctor malesuada. Aenean ac tempus mauris, nec condimentum tortor.</p>
        </div>
        <!--Connect Button-->
        <div class="pb-5 flex flex-col items-center md:items-end">
            <x-primary-button>
                Connect
            </x-primary-button>
        </div>
    </div>
</x-card-base>