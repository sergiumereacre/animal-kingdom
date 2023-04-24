<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Qualification extends Model
{
    use HasFactory;

    protected $primaryKey = 'qualification_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qualification_id',
        'qualification_name',
        'qualification_description',
    ];

    public function qualificationsUsers(): HasMany{
        return $this->hasMany(QualificationsUser::class, 'qualification_id');
    }

    public function qualificationsVacancies(): HasMany{
        return $this->hasMany(QualificationsVacancy::class, 'qualification_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
