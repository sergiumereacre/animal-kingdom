<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function create()
    {
        return view('search.create');
    }

    public function query(Request $request)
    {
        //TODO: validate $request
        //TODO: extend search to work on users and organisations
        //TODO: extend search to have toggleable skills

        $searchString = $request;

        $results = DB::select('SELECT vacancies.vacancy_id, CONCAT_WS(' ', organisations.organisation_name, vacancies.vacancy_title, vacancies.vacancy_description) AS vacancy
        FROM (vacancies INNER JOIN organisations ON vacancies.organisation_id = organisations.organisation_id)
        HAVING vacancy LIKE \'%?%\'', $searchString);

        //debug, pls remove
        print($results);
        print_r($results);

        //sort results
        $results = sortResults($results);
        return view('search.query');
    }

    private function sortResults($results)
    {
        $rankings = array();
        foreach($)
    }
}
