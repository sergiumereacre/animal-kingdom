<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{

    use HasFactory;

    protected $table = 'skills';
    protected $primaryKey = 'skill_id';
    protected $guarded = [];
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'skill_id',
        'skill_name',
        'skill_description',
    ];

    public function skillsUsers(): HasMany{
        return $this->hasMany(SkillsUser::class, 'skill_id');
    }

    public function skillsVacancies(): HasMany{
        return $this->hasMany(SkillsUser::class, 'skill_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function vacancies(): BelongsToMany
    {
        return $this->belongsToMany(Vacancy::class);
    }

    // public function vacancies(): belongsToMany {
    //     return $this->belongsToMany(Vacancy::class);
    // }
}
