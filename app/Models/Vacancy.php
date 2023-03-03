<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $primaryKey = 'vacancy_id';

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
        'eating_style_requirement',
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
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'organisation_id');
    }
}
