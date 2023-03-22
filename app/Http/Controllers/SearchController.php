<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function query(Request $request)
    {
        //TODO: validate $request
        //TODO: extend search to work on users and organisations
        //TODO: extend search to have toggleable skills

        $searchString = $request->input('search');
        if ($searchString == null) $searchString = "";
        $searchTerms = explode(' ', $searchString);

        //user search
        $userResults = $this->getUsers($searchTerms);
        if (count($userResults) > 0)
        {
            $this->sortResults($userResults, $searchTerms);
            $userResults = $this->replaceUsers($userResults);
        }

        //organisation search
        $organisationResults = $this->getVacancies($searchTerms);
        if (count($organisationResults) > 0)
        {
            $this->sortResults($organisationResults, $searchTerms);
            $organisationResults = $this->replaceVacancies($organisationResults);
        }

        //vacancy search
        $vacancyResults = $this->getVacancies($searchTerms);
        if (count($vacancyResults) > 0)
        {
            $this->sortResults($vacancyResults, $searchTerms);
            $vacancyResults = $this->replaceVacancies($vacancyResults);
        }

        //debug, pls remove
        //print($results);
        //print_r($results);

        //sort results
        
        return view('search.index', ['users' => $userResults, 'organisations' => $organisationResults,'vacancies' => $vacancyResults]);
    }


    //validation
    private function validateSearchRequest($searchTerms)
    {

    }

    //running queries
    private function getUsers($searchTerms)
    {
        return DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.organisation_id')
        ->selectRaw('users.id, CONCAT_WS(\' \', organisations.organisation_name, users.first_name, users.last_name, users.bio) AS merged')
        ->get();
    }

    private function getOrganisations($searchTerms)
    {

    }

    private function getVacancies($searchTerms)
    {
        return DB::table('vacancies')
        ->join('organisations', 'vacancies.organisation_id', '=', 'organisations.organisation_id')
        ->selectRaw('vacancies.vacancy_id, CONCAT_WS(\' \', organisations.organisation_name, vacancies.vacancy_title, vacancies.vacancy_description) AS merged')
        ->get();
    }

    //getting objects by id
    private function replaceUsers($userResults)
    {
        $output = array();
        $userResults = $userResults>reverse();
        foreach($userResults as $user)
        {
            $output[] = DB::table('users')
            ->select('*')
            ->where('users.id', '=', $user->id)
            ->get()[0];
        }
        return $output;
    }

    private function replaceOrganisations($organisationResults)
    {

    }

    private function replaceVacancies($vacancyResults)
    {
        $output = array();
        $vacancyResults = $vacancyResults->reverse();
        foreach($vacancyResults as $vacancy)
        {
            $output[] = DB::table('vacancies')
            ->join('organisations', 'vacancies.organisation_id', '=', 'organisations.organisation_id')
            ->select('*')
            ->where('vacancies.vacancy_id', '=', $vacancy->vacancy_id)
            ->get()[0];
        }
        return $output;
    }

    // sorting functions
    private function sortResults(&$results, $searchTerms)
    {
        $rankings = array();
        foreach($results as $result)
        {
            $rankings[] = $this->rank($result, $searchTerms);
        }
        $this->trimArray($results, $rankings);
        $this->sortArray($results, $rankings, 0, count($rankings) - 1);
    }

    private function trimArray(&$results, &$rankings)
    {
        foreach ($rankings as $index => $rank)
        {
            if ($rank == 0)
            {
                unset($rankings[$index]);
                unset($results[$index]);
            }
        }
        $rankings = array_values($rankings);
        $results = $results->values();
    }

    private function rank($result, $searchTerms)
    {
        $rank = 0;
        foreach ($searchTerms as $term)
        {
            $rank += substr_count(strtolower($result->merged), strtolower($term));
        }
        return $rank;
    }

    //sorts $results based on $ranks using a quicksort implementation
    private function sortArray(&$results, &$ranks, $left, $right)
    {
        $index = $this->partitionArrays($results, $ranks, $left, $right);
        if ($left < $right)
        {
            $this->sortArray($results, $ranks, $left, $index - 1);
            $this->sortArray($results, $ranks, $index, $right);
        }
    }

    private function partitionArrays(&$results, &$ranks, $left, $right)
    {
        $pivot = $ranks[($left + $right)/2];
        while ($left <= $right)
        {
            while ($ranks[$left] < $pivot)
            {
                $left++;
            }
            while ($ranks[$right] > $pivot)
            {
                $right--;
            }
            if ($left <= $right)
            {
                //swap ranks
                $tmpRank = $ranks[$left];
                $ranks[$left] = $ranks[$right];
                $ranks[$right] = $tmpRank;
                //swap results
                $tmpResult = $results[$left];
                $results[$left] = $results[$right];
                $results[$right] = $tmpResult;
                $left++;
                $right--;
            }
        }
        return $left;
    }
}
