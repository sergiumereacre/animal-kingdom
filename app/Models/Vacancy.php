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
}
