@props(['vacancies'])

@php
    // dd($vacancies);
@endphp

<x-card-base class="max-w-md w-full md:max-w-4xl">
    <div class="flex flex-col p-10">
        <!-- Card Name -->
        <h1 class="text-3xl text-black font-black pb-3">Previous Jobs</h1>
        <!-- Card Content -->
        <div class=" flex flex-col gap-5">
            @if (count($vacancies) == 0)
                <div class="flex flex-col items-center md:flex-row">
                    This user doesn't have any previous jobs.
                </div>
            @else
                @if (count($vacancies) == 1)

                    @foreach ($vacancies as $vacancy)
                        @php
                            
                            $organisation = App\Models\Organisation::all()->find($vacancy->organisation_id);
                            
                            // dd($organisation);
                            
                        @endphp

                        <div class="flex flex-col items-center md:flex-row">
                            <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                                alt="Company Logo" />
                            <div class="flex flex-col items-center md:items-start md:ml-5">
                                <span
                                    class="text-xl text-greenButtons font-bold">{{ $organisation->organisation_name }}</span>
                                <span class="text-lg text-black font-semibold">{{ $vacancy->vacancy_title }}</span>
                                <div class="text-gray-800">
                                    <span>Time Range</span>
                                    <span>|</span>
                                    <span>{{ $organisation->address }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($vacancies as $vacancy)
                        @php
                            
                            $organisation = App\Models\Organisation::all()->find($vacancy->organisation_id);
                            
                            // dd($organisation);
                            
                        @endphp
                        <hr class="h-px my-5 bg-greenButtons border-0">
                        <div class="flex flex-col items-center md:flex-row">
                            <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                                alt="Company Logo" />
                            <div class="flex flex-col items-center md:items-start md:ml-5">
                                <span
                                    class="text-xl text-greenButtons font-bold">{{ $organisation->organisation_name }}</span>
                                <span class="text-lg text-black font-semibold">{{ $vacancy->vacancy_title }}</span>
                                <div class="text-gray-800">
                                    <span>Time Range</span>
                                    <span>|</span>
                                    <span>{{ $organisation->address }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            @endif


            <!-- Break Point -->
            {{-- <hr class="h-px my-5 bg-greenButtons border-0">
            <div class="flex flex-col items-center md:flex-row">
                <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                    alt="Company Logo" />
                <div class="flex flex-col items-center md:items-start md:ml-5">
                    <span class="text-xl text-greenButtons font-bold">Company Name</span>
                    <span class="text-lg text-black font-semibold">Job Position</span>
                    <div class="text-gray-800">
                        <span>Time Range</span>
                        <span>|</span>
                        <span>Location</span>
                    </div>
                </div>
            </div> --}}
            <!-- Break Point -->
            {{-- <hr class="h-px my-5 bg-greenButtons border-0">
            <div class="flex flex-col items-center md:flex-row">
                <img class="w-44 h-44 mb-3 rounded-full shadow-lg" src="{{ asset('img/logo.png') }}"
                    alt="Company Logo" />
                <div class="flex flex-col items-center md:items-start md:ml-5">
                    <span class="text-xl text-greenButtons font-bold">Company Name</span>
                    <span class="text-lg text-black font-semibold">Job Position</span>
                    <div class="text-gray-800">
                        <span>Time Range</span>
                        <span>|</span>
                        <span>Location</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</x-card-base>
