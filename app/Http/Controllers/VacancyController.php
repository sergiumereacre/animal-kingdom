<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    // Some sort of index page for vacancies?
    public function index(){
        return;
    }

    // Showing individual vacancy
    // public function show(Vacancy $vacancy){
    //     // return view('vacancies.show');

    //     return view('vacancies.show', [
    //         'vacancy' => $vacancy
    //     ]);
    // }

    // REMEMBER TO SWITCH ALL REQUESTS TO VACANCIES FOR DEPENDENCY INJECTION

    public function show(Request $request){
                return view('vacancies.show');
    }

    public function create()
    {
        return view('vacancies.create');
    }

    // Store vacancy data with dependency injection
    public function store(Request $request)
    {
        // CODE FOR VALIDATING, STORING IN DATABASE, ETC.

        return redirect('/dashboard');
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
