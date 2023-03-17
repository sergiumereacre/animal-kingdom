<x-card-base class="max-w-md w-full h-max md:max-w-md">
    <div class="py-10 px-16 flex flex-col items-center gap-5">
        <!-- User avatar and name -->
        <div class="flex flex-col items-center">
            <img class="h-56 w-56 rounded-full shadow-lg border-greenButtons border-4" src="{{ asset('img/logo.png')}}" alt="Company Logo"/>
            <h1 class="text-4xl text-black font-black text-center p-5">Timmothy Turtle</h1>
            <p class="text-xl text-gray-700 font-thin text-center">Software Engineer</p>
        </div>
        <!-- Connect Button -->
        <div>
            <x-primary-button>{{ __('Connect') }}</x-primary-button>
        </div>
        <!-- Profile info section -->
        <div class="bg-appBackground rounded-2xl w-full p-10">
            <div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Pronouns:</h1>
                    <p class="text-lg">He/Him</p>
                </div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Location:</h1>
                    <p class="text-lg">Dublin, Ireland</p>
                </div>
            </div>
            <hr class="h-px my-10 bg-greenButtons border-0">
            <div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Species:</h1>
                    <p class="text-lg">Reptile</p>
                </div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Habitat:</h1>
                    <p class="text-lg">Water</p>
                </div>
            </div>
            <div class="py-5">
                <div class="flex flex-row items-center gap-2 justify-center">
                    <span class="material-symbols-rounded">call</span>
                    <h1 class="text-lg">+353 123 45678</h1>
                </div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <span class="material-symbols-rounded">mail</span>
                    <h1 class="text-lg">t.turt@gmail.com</h1>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center gap-2 justify-center">
                    <h1 class="text-lg text-black font-black text-center">Connections:</h1>
                    <p class="text-lg">26</p>
                </div>
            </div>
        </div>
    </div>
</x-card-base>