<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-greenButtons shadow-xl focus:ring-greenButtons" name="remember">
                <span class="ml-2 text-sm text-greenButtons">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-5">
            <div class="">
                <!-- Sign up button that leads them to register page-->
                <a href="{{ route('register') }}">
                    <x-secondary-button class="ml-3">
                        {{ __('Sign Up') }}
                    </x-secondary-button>
                </a>
                <!-- Login button. -->
                <x-primary-button class="ml-3">
                    {{ __('Log In') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
