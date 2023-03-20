<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillsUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

    
        $user = User::create([
            'first_name' => $request->first_name,
            // 'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'species_id' => $request->species_id,
        ]);

            // dd($request->skills);
        // dd(explode(",", $request->skills));

        $all_skills_unproc = array_filter(explode(",", $request->skills));

        $all_skills = [];

        // Processing skills. This basically creates an array where a user's skill is mapped to their level
        foreach ($all_skills_unproc as $skill) {
            $skill_attr = explode(":", $skill);
            // dd($skill_level);

            $skill_name = $skill_attr[0];
            $skill_level = $skill_attr[1];

            $all_skills[$skill_name] = $skill_level;
        }


        foreach ($all_skills as $skill_name=>$skill_level) {
            // dd($skill_name);
            $skill_id = Skill::all()->where('skill_name', '=', $skill_name)->first()->skill_id;

            $skill_user = SkillsUser::create([
                'user_id' => $user->id,
                'skill_id' => $skill_id,
                'skill_level' => $skill_level,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
