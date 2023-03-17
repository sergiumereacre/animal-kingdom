<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacancyController extends Controller
{
    // Some sort of index page for vacancies?
    public function index(){
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

    public function show(Vacancy $vacancy){
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
            'organisations' => Organisation::all()->where('owner_id', '=', auth()->id())
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
                'company' => ['required', Rule::unique('vacancies', 'company')],
                'location' => 'required',
                'website' => 'required',
                // Making sure it's in the email format
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required',
            ]
        );

        // if($request->category_requirement != "NULL"){
        //     $formFields['']
        // }

        // Check if file exists
        if ($request->hasFile('logo')) {
            // We want to store it in the logos folder
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        // If we're all good, you can just call the create() method of the model and that will generate an entry in the database

        // Make sure that the attributes in the model class are added to the fillable array! OR...
        Vacancy::create($formFields);


        return redirect('/home' );
    }

    public function edit(Request $request)
    {

        return view('vacancies.edit');
        return view('vacancies.edit', ['vacancy' => $vacancy]);
    }

    // Attempt to update vacancy
    public function update(Request $request, Vacancy $vacancy){

    }

    // Attempt to delete vacancy
    public function destroy(Vacancy $vacancy){

    }

    // Redirect to manage page
    public function manage(){
        return view('vacancies.manage');

        // Eventually, we should be able to map a user's vacancies to the vacancies variable
        return view('vacancies.manage', ['vacancies' => auth()->user()->vacancies()->get()]);

    }
}
