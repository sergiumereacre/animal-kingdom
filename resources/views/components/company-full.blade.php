<x-card-base>
    <!-- Avatar and Company Name -->
    <div class="flex flex-col items-center py-5 md:px-5">
        <img class="w-36 h-36 mb-5 rounded-full shadow-lg" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
        <span class="text-3xl font-bold text-black px-10 text-center">Some Company Name Ltd.</span>
    </div>
    <!-- Main Section -->
    <div>
        <!-- Overview -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:p-5 md:w-44 md:text-right">Overview:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum augue efficitur, auctor massa sit amet, efficitur tortor. Phasellus a odio fringilla, varius nisl non, condimentum purus. Donec sed nisl dictum, cursus dolor sit amet, mollis magna. Pellentesque blandit augue eget tellus gravida, rhoncus volutpat justo congue. Sed mollis auctor malesuada. Aenean ac tempus mauris, nec condimentum tortor. Pellentesque mauris ligula, aliquet sit amet iaculis at, efficitur eu enim. Duis posuere neque quis eros accumsan, vitae pulvinar ex mattis. Quisque mattis dictum nisl vitae elementum. Vivamus ac nibh eleifend eros elementum commodo a id orci. Nam id gravida ex, ut cursus ante. Aenean aliquet, nulla et luctus tempor, ligula augue egestas odio, ac volutpat ligula ex sed mi. Morbi vitae bibendum massa, sit amet aliquet orci.</p>
        </div>
        <!-- Contact Us -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Contact Us:</p>
            <div class="flex flex-col items-center">
                <!-- Phone -->
                <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">call</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">(555) 555-1234</p>
                </div>
                <!-- Email -->
                <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">mail</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">example@example.com</p>
                </div>
                <!-- Website -->
                <div class="flex flex-row items-center p-2">
                    <span class="material-symbols-rounded">public</span>
                    <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">example.com</p>
                </div>
            </div>
        </div>
        <!-- Location -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Location:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">Los Angelos, California</p>
        </div>
        <!-- Industry -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Industry:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">Technology</p>
        </div>
        <!-- Company Size -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:px-5 md:w-44 md:text-right">Company Size:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700 mx-2">4,000</p>
        </div>
        <!-- Remove Button -->
        <div class="px-5 pb-5 flex flex-col items-center md:items-end">
            <x-remove-button>
                Remove
            </x-remove-button>
        </div>
    </div>
</x-card-base>