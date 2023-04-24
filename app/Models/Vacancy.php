<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;


class Vacancy extends Model
{
    use HasFactory, HasEagerLimit;

    protected $primaryKey = 'vacancy_id';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vacancy_id',
        'time_created',
        'organisation_id',
        'vacancy_title',
        'vacancy_description',
        'category_requirement',
        'can_fly_requirement',
        'can_swim_requirement',
        'can_climb_requirement',
        'eating_style_requirement',
        'produces_toxins_requirement',
        'size_requirement',
        'speed_requirement',
        'num_appendages_requirement',
        'salary_range_lower',
        'salary_range_upper',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_created' => 'datetime',
        'can_fly_requirement' => 'boolean',
        'can_swim_requirement' => 'boolean',
        'can_climb_requirement' => 'boolean',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'organisation_id');
    }

    public function skillsVacancy(): hasMany
    {
        return $this->hasMany(SkillsVacancy::class, 'vacancy_id');
    }

    public function qualificationsVacancy(): hasMany
    {
        return $this->hasMany(QualificationsVacancy::class, 'vacancy_id');
    }

    public function skills(): BelongsToMany
    {
        return $this->BelongsToMany(Skill::class, 'skills_vacancies', 'vacancy_id', 'skill_id');
    }

    public function qualifications(): BelongsToMany
    {
        return $this->BelongsToMany(Qualification::class, 'qualifications_vacancies', 'vacancy_id', 'qualification_id');
    }
    public function scopeCategory($query, $category)
    {
        if ($category ?? false) {
            $query->where('category_requirement', '=', request('category'));
        }
    }

    public function scopeCanFly($query, $can_fly)
    {

        if ($can_fly != null) {

            $query->where('can_fly_requirement', '=', request('can_fly'));
        }
    }

    public function scopeCanSwim($query, $can_swim)
    {

        $result = request('can_swim');

        if ($can_swim != null) {

            $query->where('can_swim_requirement', '=', request('can_swim'));
        }
    }

    public function scopeCanClimb($query, $can_climb)
    {
        if ($can_climb != null) {
            $query->where('can_climb_requirement', '=', request('can_climb'));
        }
    }

    public function scopeEatingStyle($query, $eating_style)
    {
        if ($eating_style ?? false) {
            $query->where('eating_style_requirement', '=', request('eating_style'));
        }
    }

    public function scopeProducesToxins($query, $produces_toxins)
    {
        if ($produces_toxins != null) {
            $query->where('produces_toxins_requirement', '=', request('produces_toxins'));
        }
    }

    public function scopeSize($query, $size)
    {
        if ($size ?? false) {
            $query->where('size_requirement', '=', request('size'));
        }
    }

    public function scopeSpeed($query, $speed)
    {
        if ($speed ?? false) {
            $query->where('speed_requirement', '=', request('speed'));
        }
    }

    public function scopeNumAppendages($query, $num_appendages)
    {
        if ($num_appendages ?? false) {
            $query->where('num_appendages_requirement', '=', request('num_appendages'));
        }
    }

    public function scopeSkills($query, $skills)
    {
        $all_skills_unproc = array_filter(explode(",", $skills));

        $all_skills = [];

        // Processing skills. This basically creates an array where a user's skill is mapped to their level
        foreach ($all_skills_unproc as $skill) {
            $skill_attr = explode(":", $skill);

            $skill_name = 0;
            $skill_level = 0;

            if (count($skill_attr) == 2) {
                $skill_name = $skill_attr[0];
                $skill_level = $skill_attr[1];
            }


            $name_exists = Skill::all()->where('skill_name', '=', $skill_name)->first();
            $skill_id = $name_exists->skill_id;
            $level_exists = in_array($skill_level, ['BEGINNER', 'INTERMEDIATE', 'EXPERT']);

            if ($level_exists && $name_exists) {
                // $all_skills[$skill_name] = $skill_level;
                $all_skills[$skill_id] = $skill_level;
            }
        }



        $eligible_vacancies = [];


        if ($skills ?? false) {

            foreach (Vacancy::all() as $vacancy) {
                $eligible = false;
                $vacancy_skills = SkillsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);

                foreach ($all_skills as $skill_id => $skill_level) {
                    $eligible = false;
                    foreach ($vacancy_skills as $vacancy_skill) {
                        if ($skill_id == $vacancy_skill->skill_id) {
                            if (!$skill_level || $skill_level == $vacancy_skill->skill_level) {
                                $eligible = true;
                                break;
                            }
                        }
                    }

                    if (!$eligible) {
                        break;
                    }
                }

                if ($eligible) {
                    $eligible_vacancies[] = $vacancy->vacancy_id;
                }
            }

            $query->whereIn('vacancy_id', $eligible_vacancies);

            // dd($query);
        }
    }



    public function scopeQualifications($query, $quals)
    {
        // Processing qualifications
        $all_quals = array_filter(explode(",", request()->qualifications));

        $qual_ids = [];

        foreach ($all_quals as $qual_name) {
            $name_exists = Qualification::all()->where('qualification_name', '=', $qual_name)->first();
            $qual_id = $name_exists->qualification_id;
            $qual_ids[] = $qual_id;
        }

        $eligible_vacancies = [];
        // dd($all_quals);

        if ($quals ?? false) {

            // Checking all users
            foreach (Vacancy::all() as $vacancy) {
                $eligible = false;
                $vacancy_quals = QualificationsVacancy::all()->where('vacancy_id', '=', $vacancy->vacancy_id);

                // For each user, iterate through all required skills
                foreach ($qual_ids as $qual_id) {
                    $eligible = false;
                    // Compare required skill to all user skills to see if a match exists
                    foreach ($vacancy_quals as $vacancy_qual) {
                        if ($qual_id == $vacancy_qual->qualification_id) {
                            $eligible = true;
                            break;
                        }
                    }

                    if (!$eligible) {
                        break;
                    }
                }

                if ($eligible) {
                    $eligible_vacancies[] = $vacancy->vacancy_id;
                }
            }
            // dd($eligible_vacancies);
            $query->whereIn('vacancy_id', $eligible_vacancies);
        }
    }
}
