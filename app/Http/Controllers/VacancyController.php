<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Qualification;
use App\Models\QualificationsVacancy;
use App\Models\Skill;
use App\Models\SkillsVacancy;
use App\Models\UsersVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacancyController extends Controller
{
    // Some sort of index page for vacancies?
    public function index()
    {
        return view('vacancies.index');
    }

    // Showing individual vacancy
    // public function show(Vacancy $vacancy){
    //     // return view('vacancies.show');

    //     return view('vacancies.show', [
    //         'vacancy' => $vacancy
    //     ]);
    // }

    // REMEMBER TO SWITCH ALL REQUESTS TO VACANCIES FOR DEPENDENCY INJECTION

    public function show(Vacancy $vacancy)
    {
        return view('vacancies.show', [
            // 'organisation' => Organisation::all()->where('organisation_id', '=', $vacancy->organisation_id)->,
            'organisation' => Organisation::all()->find($vacancy->organisation_id),
            'vacancy' => $vacancy
        ]);
    }

    public function create(Organisation $organisation)
    {
        return view('vacancies.create', [
            'organisation' => $organisation,
            'organisations' => Organisation::all()->where('owner_id', '=', auth()->id()),
            'skills' => Skill::all(),
            'qualifications' => Qualification::all(),
        ]);
    }

    // Store vacancy data with dependency injection
    public function store(Request $request)
    {
        // dd($request->vacancy_title);
        // CODE FOR VALIDATING, STORING IN DATABASE, ETC.

        // By default, files will be stored in the app folder in the storage folder
        // $request->file('logo')->store();

        // Handy way to validate form stuff using the validate() method
        $formFields = $request->validate(
            [
                'vacancy_title' => 'required',
                // Making sure that company is unique by checking the company column in the vacancies table
                // 'organisation_id' => ['required', Rule::unique('vacancies', 'company')],
                'organisation_id' => 'required',

                'salary_range_lower' => 'required',

                'salary_range_upper' => 'required',
            ]
        );

        $formFields = $request->all();

        // dd($formFields['salary_range_lower']);
        $formFields['category_requirement'] = $request->input('category_requirement', 1);

        if ($request->category_requirement == "NULL") {
            $formFields['category_requirement'] = NULL;
        }

        if ($request->can_fly_requirement == "NULL") {
            $formFields['can_fly_requirement'] = NULL;
        }

        if ($request->can_swim_requirement == "NULL") {
            $formFields['can_swim_requirement'] = NULL;
        }

        if ($request->can_climb_requirement == "NULL") {
            $formFields['can_climb_requirement'] = NULL;
        }

        if ($request->eating_style_requirement == "NULL") {
            $formFields['eating_style_requirement'] = NULL;
        }

        if ($request->produces_toxins_requirement == "NULL") {
            $formFields['produces_toxins_requirement'] = NULL;
        }

        if ($request->size_requirement == "NULL") {
            $formFields['size_requirement'] = NULL;
        }

        if ($request->speed_requirement == "NULL") {
            $formFields['speed_requirement'] = NULL;
        }

        if ($request->num_appendages_requirement == "NULL") {
            $formFields['num_appendages_requirement'] = NULL;
        }

        if ($request->salary_range_lower > $request->salary_range_upper) {
            abort(403, 'The lower salary range can\'t exceed the upper range');
        }

        $formFields['salary_range_lower'] = $request->salary_range_lower;
        $formFields['salary_range_upper'] = $request->salary_range_upper;


        $formFields['time_created'] = Carbon::now();


        // If we're all good, you can just call the create() method of the model and that will generate an entry in the database

        // Make sure that the attributes in the model class are added to the fillable array! OR...
        $vacancy = Vacancy::create($formFields);

        $all_skills_unproc = array_filter(explode(",", $request->skills));

        $all_skills = [];

        // Processing skills. This basically creates an array where a vacancies's skill is mapped to their level
        foreach ($all_skills_unproc as $skill) {
            $skill_attr = explode(":", $skill);

            $skill_name = $skill_attr[0];
            $skill_level = $skill_attr[1];

            $all_skills[$skill_name] = $skill_level;
        }


        foreach ($all_skills as $skill_name=>$skill_level) {
            $skill_id = Skill::all()->where('skill_name', '=', $skill_name)->first()->skill_id;

            $skill_user = SkillsVacancy::create([
                'vacancy_id' => $vacancy->vacancy_id,
                'skill_id' => $skill_id,
                'skill_level' => $skill_level,
            ]);
        }

        // Processing qualifications
        $all_quals = array_filter(explode(",", $request->qualifications));

        foreach ($all_quals as $qual_name) {
            $qual_id = Qualification::all()->where('qualification_name', '=', $qual_name)->first()->qualification_id;

            $qual_user = QualificationsVacancy::create([
                'vacancy_id' => $vacancy->vacancy_id,
                'qualification_id' => $qual_id,
            ]);
        } 


        // return redirect('/home');
        return redirect('/organisations/' . $request->organisation_id);
        // return redirect()->back();
    }

    public function edit(Request $request)
    {

        return view('vacancies.edit');
        return view('vacancies.edit', ['vacancy' => $vacancy]);
    }

    // Attempt to update vacancy
    public function update(Request $request, Vacancy $vacancy)
    {
    }

    // Attempt to delete vacancy
    public function destroy(Vacancy $vacancy)
    {
        $organisation = Organisation::find($vacancy->organisation_id);

        // dd($organisation);
        // Make sure logged in user is owner
        if ($organisation->owner_id != auth()->id()) {
            abort(403, 'Unauthorized Action, you\'re not the owner!!');
        }

        $vacancy->delete();
        return redirect('/organisations/' . $organisation->organisation_id);
    }

    // Redirect to manage page
    public function manage()
    {
        return view('vacancies.manage');

        // Eventually, we should be able to map a user's vacancies to the vacancies variable
        return view('vacancies.manage', ['vacancies' => auth()->user()->vacancies()->get()]);
    }

    public function apply(Vacancy $vacancy){
        $organisation = Organisation::find($vacancy->organisation_id);

        // Do a check to see if user is eligible here?
        // if (true) {
        //     abort(403, 'Unauthorized Action, you\'re not the owner!!');
        // }

        $formFields['user_id'] = auth()->id();
        $formFields['vacancy_id'] = $vacancy->vacancy_id;
        $formFields['time_joined'] = Carbon::now();


        UsersVacancy::create($formFields);


        return redirect('/organisations/' . $organisation->organisation_id);
    }
}
