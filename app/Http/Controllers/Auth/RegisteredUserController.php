<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use App\Models\QualificationsUser;
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
        $formFields = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->hasFile('profile_pic')) {
            // dd($request->file('profile_pic'));
            $formFields['profile_pic'] = $request->file('profile_pic')->store('profile_pic', 'public');
        }

        $formFields['address'] = $request->address;
        $formFields['contact_number'] = $request->contact_number;
        $formFields['species_id'] = $request->species_id;

        // $user = User::create([
        //     'first_name' => $request->first_name,
        //     // 'second_name' => $request->second_name,
        //     'last_name' => $request->last_name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'address' => $request->address,
        //     'contact_number' => $request->contact_number,
        //     'species_id' => $request->species_id,
        //     'profile_pic' = $profile_pic,
        // ]);

        $user = User::create($formFields);


        $all_skills_unproc = array_filter(explode(",", $request->skills));

        $all_skills = [];

        // Processing skills. This basically creates an array where a user's skill is mapped to their level
        foreach ($all_skills_unproc as $skill) {
            $skill_attr = explode(":", $skill);

            $skill_name = $skill_attr[0];
            $skill_level = $skill_attr[1];

            $name_exists = Skill::all()->where('skill_name', '=', $skill_name);
            $level_exists = in_array($skill_level, ['BEGINNER', 'INTERMEDIATE', 'EXPERT']);

            if ($level_exists && $name_exists) {
                $all_skills[$skill_name] = $skill_level;
            }
        }


        foreach ($all_skills as $skill_name => $skill_level) {
            $skill_id = Skill::all()->where('skill_name', '=', $skill_name)->first()->skill_id;

            $skill_user = SkillsUser::create([
                'user_id' => $user->id,
                'skill_id' => $skill_id,
                'skill_level' => $skill_level,
            ]);
        }

        // Processing qualifications
        $all_quals = array_filter(explode(",", $request->qualifications));

        foreach ($all_quals as $qual_name) {
            $qual_id = Qualification::all()->where('qualification_name', '=', $qual_name);

            if (count($qual_id) != 0) {
                $qual_id = $qual_id->first()->qualification_id;
                $qual_user = QualificationsUser::create([
                    'user_id' => $user->id,
                    'qualification_id' => $qual_id,
                    // Date picker here?
                    'date_obtained' => Carbon::now(),
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect('home');
    }
}
