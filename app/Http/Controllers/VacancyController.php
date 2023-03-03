<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    // Some sort of index page for vacancies?
    // public function index(){
    //     return;
    // }

    // Showing individual vacancy
    public function show(Vacancy $vacancy){
        // return view('vacancies.show');

        return view('vacancies.show', [
            'vacancy' => $vacancy
        ]);
    }

    // public function show(Request $request){
    //             return view('vacancies.show');

    // }
}
