<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualificationsVacancy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qualifications_vacancies_id',
        'qualification_id',
        'vacancy_id',
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'qualification_id');
    }

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id', 'vacancy_id');
    }
}
