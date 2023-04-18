<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

// Use livewire in views folder


class ProfileInfo extends Component
{
    public $user;
    public $species;
    public $counter = 0;
    public $connections_num;

    public function refreshConnections(User $user)
    {
        // dd('Testing component');

        toggleConnect($user);

        // Get all connections where selected user is in first_user_id
        $connected_users_first = User::all()->whereIn('id', DB::table('connections')->where(
            'first_user_id',
            '=',
            $this->user->id
        )->pluck('second_user_id'));

        // Get all connections where selected user is in second_user_id
        $connected_users_last = User::all()->whereIn('id', DB::table('connections')->where(
            'second_user_id',
            '=',
            $this->user->id
        )->pluck('first_user_id'));

        $all_connected_users = $connected_users_first->merge($connected_users_last);


        $this->emit('refreshConnections');
        $this->counter++;
        $this->connections_num = $all_connected_users->count();
    }

    public function render()
    {

        return view('livewire.profile-info');
    }
}
