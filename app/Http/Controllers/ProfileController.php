<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AnimalSpecies;
use App\Models\Connection;
use App\Models\Organisation;
use App\Models\Qualification;
use App\Models\QualificationsUser;
use App\Models\Skill;
use App\Models\SkillsUser;
use App\Models\User;
use App\Models\UsersVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

    public function index()
    {
        return view('profile.index', [
            'users' => User::paginate(6)
        ]);
    }

    public function show(User $user)
    {

        // Current user
        $user = User::all()->find($user->id);

        $past_vacancies = Vacancy::all()
            ->whereIn('vacancy_id', DB::table('users_vacancies')
                ->where(
                    'user_id',
                    '=',
                    auth()->id()
                )->pluck('vacancy_id'));

        $past_organisations = array();

        foreach ($past_vacancies as $vacancy) {
            $past_organisations[] = Organisation::all()->find($vacancy->organisation_id);
        }

        // Get all connections where selected user is in first_user_id
        $connected_users_first = User::all()->whereIn('id', DB::table('connections')->where(
            'first_user_id',
            '=',
            $user->id
        )->pluck('second_user_id'));

        // Get all connections where selected user is in second_user_id
        $connected_users_last = User::all()->whereIn('id', DB::table('connections')->where(
            'second_user_id',
            '=',
            $user->id
        )->pluck('first_user_id'));

        $all_connected_users = $connected_users_first->merge($connected_users_last);

        return view('profile.show', [
            'organisations' => Organisation::all()->where('owner_id', '=', $user->id),

            'connected_users' => $all_connected_users,
            'user' => $user,
            'species' => AnimalSpecies::all()->find($user->species_id),
            'past_vacancies' => $past_vacancies,
            'past_organisations' => $past_organisations,
        ]);
    }


    public function profile(Request $request)
    {
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

        if ($request->user()->id != auth()->id()) {
            abort(403, 'Unauthorized Action,you\'re not the right user!!');
        }

        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
        ]);

        $formFields['address'] = $request->address;
        $formFields['contact_number'] = $request->contact_number;

        if ($request->hasFile('profile_pic')) {
            $formFields['profile_pic'] = $request->file('profile_pic')->store('profile_pic', 'public');
        }


        $request->user()->update($formFields);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePersonal(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request);

        if ($request->user()->id != auth()->id()) {
            abort(403, 'Unauthorized Action,you\'re not the right user!!');
        }

        $formFields = $request->validate([
            'bio' => 'required',
        ]);

        $all_skills_users = SkillsUser::all()->where('user_id', '=', auth()->id());

        foreach ($all_skills_users as $skill_user) {
            $skill_user->delete();
        }

        // dd($all_skills_users);

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
                'user_id' => auth()->id(),
                'skill_id' => $skill_id,
                'skill_level' => $skill_level,
            ]);
        }

        // Processing qualifications
        $all_quals = array_filter(explode(",", $request->qualifications));


        $all_quals_users = QualificationsUser::all()->where('user_id', '=', auth()->id());

        foreach ($all_quals_users as $qual_user) {
            $qual_user->delete();
        }

        foreach ($all_quals as $qual_name) {
            $qual_id = Qualification::all()->where('qualification_name', '=', $qual_name);

            if (count($qual_id) != 0) {
                $qual_id = $qual_id->first()->qualification_id;
                $qual_user = QualificationsUser::create([
                    'user_id' => auth()->id(),
                    'qualification_id' => $qual_id,
                    // Date picker here?
                    'date_obtained' => Carbon::now(),
                ]);
            }
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

    /**
     * Delete the user's account.
     */
    public function destroyOther(User $user): RedirectResponse
    {

        $current_user = User::find(auth()->id());
        // Make sure logged in user is owner
        if (!$current_user->is_admin) {
            abort(403, 'Unauthorized Action, you\'re not an admin!!');
        }

        // Deleting profile pic
        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $user->delete();
        // return redirect('/users/'.auth()->id());
        return redirect()->route('users.index');
    }

    public function toggleBan(User $user)
    {
        $user->update(['is_banned' => !$user->is_banned]);
        return redirect()->back();
    }

    public function toggleConnect(User $user)
    {

        $connection = Connection::where([['first_user_id', '=', auth()->id()], ['second_user_id', '=', $user->id]])
            ->orWhere([['first_user_id', '=', $user->id], ['second_user_id', '=', auth()->id()]])
            ->first();

        if ($connection) {
            $connection->delete();
        } else {
            Connection::create([
                'first_user_id' => auth()->id(),
                'second_user_id' => $user->id,
                'time_created' => Carbon::now(),
            ]);
        }


        // $user->update(['is_banned' => !$user->is_banned]);
        return redirect()->back();
    }
}
