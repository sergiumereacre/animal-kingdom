<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Qualification;
use App\Models\Skill;
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



        // $formFields['vacancy_description'] = $request->vacancy_description;
        // $formFields['category_requirement'] = $request->category_requirement;
        // $formFields['can_fly_requirement'] = $request->can_fly_requirement;
        // $formFields['can_swim_requirement'] = $request->can_swim_requirement;
        // $formFields['can_climb_requirement'] = $request->can_climb_requirement;
        // $formFields['eating_style_requirement'] = $request->eating_style_requirement;
        // $formFields['produces_toxins_requirement'] = $request->produces_toxins_requirement;
        // $formFields['size_requirement'] = $request->size_requirement;
        // $formFields['speed_requirement'] = $request->speed_requirement;
        // $formFields['num_appendages_requirement'] = $request->num_appendages_requirement;

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
        Vacancy::create($formFields);


        return redirect('/home');
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
}
