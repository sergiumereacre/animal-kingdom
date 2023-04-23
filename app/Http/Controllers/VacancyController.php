<?php

namespace App\Http\Controllers;

use App\Models\AnimalSpecies;
use App\Models\Organisation;
use App\Models\Qualification;
use App\Models\QualificationsUser;
use App\Models\QualificationsVacancy;
use App\Models\Skill;
use App\Models\SkillsUser;
use App\Models\SkillsVacancy;
use App\Models\UsersVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    // Some sort of index page for vacancies?
    public function index()
    {
        $vacancies = Vacancy::category(request('category'))->canFly(request('can_fly'))->canSwim(request('can_swim'))->canClimb(request('can_climb'))->eatingStyle(request('eating_style'))->producesToxins(request('produces_toxins'))->size(request('size'))->speed(request('speed'))->numAppendages(request('num_appendages'))->skills(request('skills'))->qualifications(request('qualifications'))->distinct()->paginate(8);

        // return vacancies inlcuding their respective organisations
        return view('vacancies.index', [
            'vacancies' => $vacancies,
        ]);
    }

    public function recommended()
    {
        $vacancies = Vacancy::all();

        // dd($vacancies);


        foreach ($vacancies as $key => $vacancy) {
            if (!checkEligibility(auth()->user(), $vacancy)) {
                // dd($vacancy);
                unset($vacancies[$key]);
            }
        }

        // dd($vacancies);
        // return vacancies inlcuding their respective organisations
        return view('vacancies.index', [
            'vacancies' => $this->paginateCollection($vacancies, 9),
        ]);
    }

    public function paginateCollection($items, $perPage = 9, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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

        $formFields = VacancyController::generateVacancyFormField($request);

        // Make sure that the attributes in the model class are added to the fillable array! OR...
        // If we're all good, you can just call the create() method of the model and that will generate an entry in the database
        $vacancy = Vacancy::create($formFields);

        VacancyController::updateVacancySkillsQualifications($request, $vacancy);

        // return redirect('/home');
        return redirect('/organisations/' . $request->organisation_id);
        // return redirect()->back();
    }

    private static function generateVacancyFormField(Request $request)
    {
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

        // dd($request->input('category_requirement', 1));

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

        // dd($formFields);
        return $formFields;
    }

    private static function updateVacancySkillsQualifications(Request $request, Vacancy $vacancy)
    {
        $all_skills_unproc = array_filter(explode(",", $request->skills));

        $all_skills = [];

        // Processing skills. This basically creates an array where a vacancies's skill is mapped to their level
        foreach ($all_skills_unproc as $skill) {
            $skill_attr = explode(":", $skill);

            $skill_name = $skill_attr[0];
            $skill_level = $skill_attr[1];

            $all_skills[$skill_name] = $skill_level;
        }


        foreach ($all_skills as $skill_name => $skill_level) {

            $skill = Skill::all()->where('skill_name', '=', $skill_name);

            if (count($skill) > 0) {
                $skill_id = Skill::all()->where('skill_name', '=', $skill_name)->first()->skill_id;
                $skill_vacancy = SkillsVacancy::create([
                    'vacancy_id' => $vacancy->vacancy_id,
                    'skill_id' => $skill_id,
                    'skill_level' => $skill_level,
                ]);
            }
        }

        // Processing qualifications
        $all_quals = array_filter(explode(",", $request->qualifications));

        foreach ($all_quals as $qual_name) {
            // Get qualification from qual_name
            $quals = Qualification::all()->where('qualification_name', '=', $qual_name);

            if (count($quals) > 0) {
                $qual_id = $quals->first()->qualification_id;

                $qual_user = QualificationsVacancy::create([
                    'vacancy_id' => $vacancy->vacancy_id,
                    'qualification_id' => $qual_id,
                ]);
            }
        }
    }

    public function edit(Request $request, Vacancy $vacancy)
    {
        //dd($vacancy -> vacancy_title);
        // return view('vacancies.edit');
        return view('vacancies.edit', ['vacancy' => $vacancy]);
    }

    // Attempt to update vacancy
    public function update(Request $request, Vacancy $vacancy)
    {
        $organisation = Organisation::find($vacancy->organisation_id);

        // dd($organisation);

        if ($organisation->owner_id == auth()->id() || auth()->user()->is_admin) {
            // dd($vacancy);
            // $request->organisation_id = $vacancy->organisation_id;


            $all_skills_vacancies = SkillsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);

            foreach ($all_skills_vacancies as $skill_vacancy) {
                $skill_vacancy->delete();
            }

            // dd($all_skills_users);

            $all_quals_vacancies = QualificationsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);

            foreach ($all_quals_vacancies as $qual_vacancy) {
                $qual_vacancy->delete();
            }

            $formFields = VacancyController::generateVacancyFormField($request);
            // Make sure that the attributes in the model class are added to the fillable array! OR...
            // If we're all good, update vacancy
            $vacancy->update($formFields);
            // dd($request);

            VacancyController::updateVacancySkillsQualifications($request, $vacancy);
        } else {
            abort(403, 'Can\'t update vacancy');
        }

        return back()->with('message', 'Vacancy updated successfully!');
        // dd('hi');
        // return redirect('/organisations/' . $organisation->organisation_id);
    }

    // Attempt to delete vacancy
    public function destroy(Vacancy $vacancy)
    {
        $organisation = Organisation::find($vacancy->organisation_id);

        // dd(auth()->user()->is_admin);

        // dd($organisation);
        // Make sure logged in user is owner
        if ($organisation->owner_id == auth()->id() || auth()->user()->is_admin) {
            $vacancy->delete();
        } else {
            abort(403, deleteError);
        }

        // return redirect('/organisations/' . $organisation->organisation_id);
        // return redirect()->back();
        return redirect('/vacancies/index');
    }



    public function apply(Vacancy $vacancy)
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

        if (!$eligible) {
            return redirect()->back();
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
                    if ($vacancy_skill->skill_id == $user_skill->skill_id) {
                        if (!$vacancy_skill->skill_level || $vacancy_skill->skill_level == $user_skill->skill_level) {
                            $eligible = true;
                            break;
                        }
                    }
                }

                if (!$eligible) {
                    break;
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


        // Do a check to see if user is eligible here?
        // if (true) {
        //     abort(403, 'Unauthorized Action, you\'re not the owner!!');
        // }

        if ($eligible) {
            $formFields['user_id'] = auth()->id();
            $formFields['vacancy_id'] = $vacancy->vacancy_id;
            $formFields['time_joined'] = Carbon::now();


            UsersVacancy::create($formFields);
        }


        // return redirect('/organisations/' . $organisation->organisation_id);
        return redirect()->back();
    }

    public function unapply(Vacancy $vacancy)
    {
        $uservacancy = UsersVacancy::all()->where('user_id', '=', auth()->id())->first();

        if ($uservacancy) {
            $uservacancy->delete();
        }

        return redirect()->back();
    }
}
