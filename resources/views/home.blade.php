

@php
    $skills = App\Models\SkillsUser::all()->where('user_id', '=', $user->id);
    // dd($skills);

    $quals = App\Models\QualificationsUser::all()->where('user_id', '=', $user->id);
@endphp


<x-app-layout>
    <div class="py-10 px-10 flex flex-col items-center md:flex-row md:justify-center gap-5 md:flex-wrap">


        <div class="flex flex-col lg:flex-row gap-5">
            <x-profile-info :user="$user" :species="$species" connections_num="{{ $connected_users->count() }}">
            </x-profile-info>
            <div class="flex flex-col items-center gap-5">
                <div class="flex lg:flex-row items-center gap-5 flex-col">
                    <div class="flex flex-col items-center gap-5">
                        <x-profile-bio :bio="$user->bio"></x-profile-bio>
                        <x-profile-skills :skills="$skills"></x-profile-skills>
                        <x-profile-qualifications :quals="$quals"></x-profile-qualifications>
                    </div>
                    <x-profile-connections :connected_users="$connected_users" class=" min-h-full"></x-profile-connections>
                </div>
                <x-profile-user-organisations :user="$user"></x-profile-user-organisations>
            </div>
        </div>

</x-app-layout>
