<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    const USERS = 'Users';
    const ORGANISATIONS = 'Organisations';
    const VACANCIES = 'Vacancies';
    const DISPLAY_LIMIT = 8;

    public function query(Request $request)
    {
        //TODO: validate $request
        //TODO: extend search to have toggleable skills

        $searchString = $request->input('search');
        if ($searchString == null) $searchString = '';
        $searchTerms = explode(' ', $searchString);

        $category = $request->input('category');
        // dd($category);
        $userResults = null;
        $organisationResults = null;
        $vacancyResults = null;

        //user search
        if ($category != SearchController::ORGANISATIONS && $category != SearchController::VACANCIES)
        {
            $userResults = $this->getUsers($searchTerms);
            if (count($userResults) > 0)
            {
                $count = $this->sortResults($userResults, $searchTerms);
                if ($count > 0) $userResults = $this->replaceUsers($userResults);
            }
        }

        //organisation search
        if ($category != SearchController::USERS && $category != SearchController::VACANCIES)
        {
            $organisationResults = $this->getOrganisations($searchTerms);
            if (count($organisationResults) > 0)
            {
                $count = $this->sortResults($organisationResults, $searchTerms);
                if ($count > 0) $organisationResults = $this->replaceOrganisations($organisationResults);
            }
        }
        //vacancy search
        if ($category != SearchController::USERS && $category != SearchController::ORGANISATIONS)
        {
            $vacancyResults = $this->getVacancies($searchTerms);
            if (count($vacancyResults) > 0)
            {
                $count = $this->sortResults($vacancyResults, $searchTerms);
                if ($count > 0) $vacancyResults = $this->replaceVacancies($vacancyResults);
            }
        }
    
        return view('search.index', ['users' => $userResults, 'organisations' => $organisationResults,'vacancies' => $vacancyResults]);
    }


    //validation
    private function validateSearchRequest($searchTerms)
    {
        //TODO
    }

    //running queries
    private function getUsers($searchTerms)
    {
        return DB::table('users')
        ->leftJoin('organisations', 'users.organisation_id', '=', 'organisations.organisation_id')
        ->selectRaw('users.id, CONCAT_WS(\' \', organisations.organisation_name, users.first_name, users.last_name, users.bio) AS merged')
        ->get();
    }

    private function getOrganisations($searchTerms)
    {
        return DB::table('organisations')
        ->selectRaw('organisations.organisation_id, CONCAT_WS(\' \', organisations.organisation_name, organisations.description, organisations.address) AS merged')
        ->get();
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
        $userResults = $userResults->reverse();
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
        $output = array();
        $organisationResults = $organisationResults->reverse();
        foreach($organisationResults as $organisation)
        {
            $output[] = DB::table('organisations')
            ->select('*')
            ->where('organisations.organisation_id', '=', $organisation->organisation_id)
            ->get()[0];
        }
        return $output;
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
        if (count($rankings) > 1)
        {
            $this->sortArray($results, $rankings, 0, count($rankings) - 1);
        }
        return count($rankings);
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
            if ($term != null && $term != "")
            {
                $rank += substr_count(strtolower($result->merged), strtolower($term));
            }
            else
            {
                $rank++;
            }
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
