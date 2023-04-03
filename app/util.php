<?php

use App\Models\User;
use App\Models\Vacancy;
use App\Models\Organisation;
use App\Models\AnimalSpecies;
use App\Models\Connection;
use App\Models\QualificationsUser;
use App\Models\QualificationsVacancy;
use App\Models\SkillsUser;
use App\Models\SkillsVacancy;
use App\Models\UsersVacancy;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function checkEligibility(User $user, $vacancy)
{
    $organisation = Organisation::find($vacancy->organisation_id);
    $user = auth()->user();
    $species = AnimalSpecies::all()->whereIn('species_id', DB::table('users')
        ->where(
            'id',
            '=',
            $user->id
        )->pluck('species_id'))->first();

    // dd($species);

    $eligible = true;

    if($organisation->owner_id == $user->id){
        $eligible = false;
    }

    if ($vacancy->category_requirement && $vacancy->category_requirement != $species->category) {
        $eligible = false;
    }

    if ($vacancy->can_fly_requirement && $vacancy->can_fly_requirement != $species->can_fly) {
        $eligible = false;
    }

    if ($vacancy->can_swim_requirement && $vacancy->can_swim_requirement != $species->can_swim) {
        $eligible = false;
    }

    if ($vacancy->can_climb_requirement && $vacancy->can_climb_requirement != $species->can_climb) {
        $eligible = false;
    }

    if ($vacancy->eating_style_requirement && $vacancy->eating_style_requirement != $species->eating_style) {
        $eligible = false;
    }

    if ($vacancy->produces_toxins_requirement && $vacancy->produces_toxins_requirement != $species->produces_toxins) {
        $eligible = false;
    }

    if ($vacancy->size_requirement && $vacancy->size_requirement != $species->size) {
        $eligible = false;
    }

    if ($vacancy->speed_requirement && $vacancy->speed_requirement != $species->speed) {
        $eligible = false;
    }

    if ($vacancy->num_appendages_requirement && $vacancy->num_appendages_requirement != $species->num_appendages) {
        $eligible = false;
    }

    // dd($eligible);

    if (!$eligible) {
        return false;
    }

    $user_skills = SkillsUser::all()->where('user_id', '=', $user->id);
    $vacancy_skills = SkillsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);

    // dd($vacancy_skills);

    if (count($vacancy_skills) == 0) {
        $eligible = true;
    } else {

        foreach ($vacancy_skills as $vacancy_skill) {
            $eligible = false;

            foreach ($user_skills as $user_skill) {
                if (!$vacancy_skill->skill_level || $vacancy_skill->skill_id == $user_skill->skill_id) {
                    if($vacancy_skill->skill_level == $user_skill->skill_level){
                        $eligible = true;
                        break;
                    }
                }
            }
        }
    }


    // dd($eligible);

    // Checking for qualifications
    $user_quals = QualificationsUser::all()->where('user_id', '=', $user->id);
    $vacancy_quals = QualificationsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);


    if (count($vacancy_quals) == 0) {
    } else {


        foreach ($vacancy_quals as $vacancy_qual) {
            $eligible = false;
            foreach ($user_quals as $user_qual) {
                if ($vacancy_qual->qualification_id == $user_qual->qualification_id) {
                    $eligible = true;
                    break;
                }
            }
        }
    }

    // dd($eligible);


    // Do a check to see if user is eligible here?
    // if (true) {
    //     abort(403, 'Unauthorized Action, you\'re not the owner!!');
    // }

    return $eligible;
}

function toggleConnect(User $user)
    {
        
        // dd('Testing function');
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
        // return redirect()->back();
    }
