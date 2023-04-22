<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. All of your information stored will be removed from our database.') }}
        </p>
    </header>

    <div class="flex justify-end gap-2">
        @if (auth()->user()->id != $user->id)
            {{-- <form action="/users/{{ $user->id }}" method="post">
                @csrf
                @method('DELETE')
                <x-remove-button class="flex gap-2"><span class="material-symbols-rounded">delete_forever</span>REMOVE
                </x-remove-button>
            </form> --}}

            @if (auth()->user()->is_admin && !$user->is_admin)
                @if (!$user->is_banned)
                    <form method="POST" class="md:ml-auto" action="/users/{{ $user->id }}/toggleBan">
                        @csrf
                        @method('PUT')
                        <x-remove-button class="flex gap-2">
                            <span class="material-symbols-rounded">do_not_disturb_on</span> BAN
                        </x-remove-button>
                    </form>
                @else
                    <form method="POST" action="/users/{{ $user->id }}/toggleBan">
                        @csrf
                        @method('PUT')
                        <x-primary-button class="flex gap-2">
                            <span class="material-symbols-rounded">check_circle</span>UNBAN
                        </x-primary-button>
                    </form>
                @endif
                <form action="/users/{{ $user->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-remove-button class="flex gap-2"><span
                            class="material-symbols-rounded">delete_forever</span>REMOVE</x-remove-button>
                </form>
            @endif
        @else
            <x-remove-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="flex flex-row gap-1">
                <span class="material-symbols-rounded">
                    delete
                </span>{{ __('Delete Account') }}
            </x-remove-button>
        @endif

    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="flex flex-row gap-1">
                    <span class="material-symbols-rounded">
                        close
                    </span>
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-remove-button class="ml-3 flex flex-row gap-2">
                    <span class="material-symbols-rounded">
                        delete
                    </span>
                    {{ __('Delete Account') }}
                </x-remove-button>
            </div>
        </form>
    </x-modal>
</section>
