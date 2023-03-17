<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $primaryKey = 'vacancy_id';
    public $timestamps = false;

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
}
