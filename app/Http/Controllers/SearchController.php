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
        print_r($searchString);
        $searchTerms = explode(' ', $searchString);

        //vacancy search
        $vacancyResults = DB::table('vacancies')
        ->join('organisations', 'vacancies.organisation_id', '=', 'organisations.organisation_id')
        ->selectRaw('vacancies.vacancy_id, CONCAT_WS(\' \', organisations.organisation_name, vacancies.vacancy_title, vacancies.vacancy_description) AS merged')
        ->havingRaw('merged LIKE \'%'.$searchString.'%\'')
        ->get();
        //dd($results);

        //debug, pls remove
        //print($results);
        //print_r($results);

        //sort results
        if (count($vacancyResults) > 0)
        {
            $this->sortResults($vacancyResults, $searchTerms);
            $vacancyResults = $this->replaceVacancies($vacancyResults);
        }
        return view('search.index', ['vacancies' => $vacancyResults]);
    }

    private function replaceVacancies($vacancyResults)
    {
        $output = array();
        foreach($vacancyResults as $key => $value)
        {
            $id = $value->vacancy_id;
            $output[] = DB::table('vacancies')
            ->select('*')
            ->where('vacancies.vacancy_id', '=', $id)
            ->get()[0];
        }
        return $output;
    }

    private function sortResults(&$results, $searchTerms)
    {
        $rankings = array();
        foreach($results as $result)
        {
            $rankings[] = $this->rank($result, $searchTerms);
        }

        $this->sortArray($results, $rankings, 0, count($rankings) - 1);
    }

    private function rank($result, $searchTerms)
    {
        $rank = 0;
        foreach ($searchTerms as $term)
        {
            if (str_contains($result->merged, $term))
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
        if ($left < $index - 1)
        {
            $this->sortArray($results, $ranks, $left, $index);
        }
        else if ($index < $right)
        {
            $this->sortArray($results, $ranks, $index, $right);
        }
    }

    private function partitionArrays(&$results, &$ranks, $left, $right)
    {
        $pivot = $ranks[($left + $right)/2];
        while ($left < $right)
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
                $tmp = $ranks[$left];
                $ranks[$left] = $ranks[$right];
                $ranks[$right] = $tmp;
                //swap results
                $tmp = $results[$left];
                $results[$left] = $results[$right];
                $results[$right] = $results[$left];
                $left++;
                $right--;
            }
        }
        return $left;
    }
}
