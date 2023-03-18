<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Organisation;
use App\Models\User;
use App\Models\UsersVacancy;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function index(){
        return view('profile.index', [
            'users' => User::all()
        ]);
    }

    public function show(User $user){


        return view('profile.show', [
            'user' => $user,
            'vacancies' => UsersVacancy::all()->where('user_id', '=', $user->id),
            'organisations' => Organisation::all()->where('owner_id', '=', $user->id),
        ]);
    }

    public function profile(Request $request){
        return view('profile.show', [
            'user' => auth(),
                'vacancies' => UsersVacancy::all()->where('user_id', '=', auth()->id())
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request);

        if($request->user()->id != auth()->id()) {
            abort(403, 'Unauthorized Action,you\'re not the right user!!');
        }

        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
        ]);

        $formFields['address'] = $request->address;
        $formFields['contact_number'] = $request->contact_number;

        if($request->hasFile('profile_pic')) {
            $formFields['profile_pic'] = $request->file('profile_pic')->store('profile_pic', 'public');
        }


        $request->user()->update($formFields);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
