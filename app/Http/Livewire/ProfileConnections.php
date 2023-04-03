<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProfileConnections extends Component
{
    protected $listeners = ['refreshConnections' => '$refresh'];
    // public $connected_users;

    public $user;

    // public $counter = 0;


    public function render()
    {
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
    
      

        return view('livewire.profile-connections', [
            'connected_users' => $all_connected_users
        ]);
    }
}
