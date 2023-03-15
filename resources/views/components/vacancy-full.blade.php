<x-card-base>
    <!-- Company Logo And Name -->
    <div class="flex flex-col items-center py-5 md:px-5 md:pt-5">
        <img class="w-36 h-36 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
        <span class="text-sm text-black">Company Name that is actually very long</span>
    </div>
    <!-- Main Section -->
    <div>
        <!-- Job Title -->
        <div class="flex flex-col items-center md:flex-row">
            <h1 class="font-bold text-2xl md:mx-auto">Job Title</h1>
        </div>
        <!-- Salary Range -->
        <div class="px-5 py-5 flex flex-col md:flex-row items-center md:py-0">
            <p class="font-medium text-black md:p-5 md:w-44">Salary Range:</p>
            <p class="font-bold text-greenButtons">$49,000- $56,000</p>
        </div>
        <!-- Job Description -->
        <div class="px-5 pb-5 flex flex-col md:flex-row items-center">
            <p class="font-medium text-black md:p-5 md:w-44">Job Description:</p>
            <p class="md:px-0 md:w-500 text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum augue efficitur, auctor massa sit amet, efficitur tortor. Phasellus a odio fringilla, varius nisl non, condimentum purus. Donec sed nisl dictum, cursus dolor sit amet, mollis magna. Pellentesque blandit augue eget tellus gravida, rhoncus volutpat justo congue. Sed mollis auctor malesuada. Aenean ac tempus mauris, nec condimentum tortor. Pellentesque mauris ligula, aliquet sit amet iaculis at, efficitur eu enim. Duis posuere neque quis eros accumsan, vitae pulvinar ex mattis. Quisque mattis dictum nisl vitae elementum. Vivamus ac nibh eleifend eros elementum commodo a id orci. Nam id gravida ex, ut cursus ante. Aenean aliquet, nulla et luctus tempor, ligula augue egestas odio, ac volutpat ligula ex sed mi. Morbi vitae bibendum massa, sit amet aliquet orci.</p>
        </div>
        <!-- Skills Needed and Buttons -->
        <div class="pb-5 px-5 flex flex-col items-center md:flex-row">
            <div class="flex items-center pb-5 gap-3 md:gap-0 flex-row md:pb-0">
                <p class="font-medium text-black md:p-5 md:w-44">Skills Needed: </p>
                <!-- Automated Skills List -->
                <div class="flex gap-3">
                    <x-skill>Skill1</x-skill>
                    <x-skill>Skill2</x-skill>
                    <x-skill>...</x-skill>
                    <x-skill class="hidden">Skill3</x-skill>
                    <x-skill class="hidden">Skill3</x-skill>
                </div>
            </div>
            <!-- Remove and Apply Buttons -->
            <div class="flex flex-row gap-3 md:ml-auto md:mr-5">
                <x-remove-button>
                    Remove
                </x-remove-button>
                <x-primary-button>
                    Apply
                </x-primary-button>
            </div>
        </div>
    </div>
</x-card-base>