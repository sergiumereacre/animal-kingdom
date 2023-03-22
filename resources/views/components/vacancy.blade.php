@props(['vacancy'])

<x-card-base class="md:flex md:flex-row">
    <!-- Company Logo and Name -->
    <div class="flex flex-col items-center py-5 md:px-5 md:pt-11">
        <img class="w-24 md:w-auto md:h-auto h-24 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
        <span class="text-sm text-black">{{isset($vacancy->organisation) ? $vacancy->organisation : "Company Name"}}</span>
    </div>
    <!-- Main Section -->
    <div>
        <!-- Job Title and Salary Range -->
        <div class="flex flex-col items-center md:flex-row md:pt-10">
            <h1 class="font-bold text-2xl">{{$vacancy->vacancy_title}}</h1>
            <p class="pt-5 md:pt-0 font-bold text-greenButtons md:ml-auto md:mr-10">${{$vacancy->salary_range_lower." - ".$vacancy->salary_range_upper}}</p>
        </div>
        <!-- Job Description -->
        <div class="py-5">
            <p class="px-5 md:px-0 text-sm text-gray-700">{{$vacancy->vacancy_description}}</p>
        </div>
        <!-- Skills and Buttons -->
        <div class="pb-5 flex flex-col items-center md:flex-row">
            <div class="flex items-center pb-5 gap-3 flex-row text-xs md:pb-0">
                <p class="font-medium text-black">Skills Needed: </p>
                <x-skill>Skill1</x-skill>
                <x-skill>Skill2</x-skill>
                <x-skill>Skill3</x-skill>
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