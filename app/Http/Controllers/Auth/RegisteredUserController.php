<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
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

        

        $formFields['password'] = Hash::make($request->password);

        $user = User::create($formFields);

        ProfileController::addSkillsAndQualifications($request->skills, $request->qualifications, $user);

        event(new Registered($user));

        Auth::login($user);

        return redirect('home');
    }
}
