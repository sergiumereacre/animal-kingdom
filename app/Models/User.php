<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'is_admin',
        'species_id',
        'username',
        'password',
        'email',
        'address',
        'date_of_birth',
        'organisation_id',
        'contact_number',
        'is_banned',
        'bio',
        'profile_pic',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'date_of_birth' => 'date',
        'is_banned' => 'boolean',
    ];

    public function animalSpecies(): BelongsTo
    {
        return $this->belongsTo(AnimalSpecies::class, 'species_id', 'species_id');
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'organisation_id');
    }

    public function organisations(): HasMany
    {
        // return $this->hasMany(Organisation::class, 'id', 'owner_id');
        return $this->hasMany(Organisation::class, 'owner_id');
    }

    public function skillsUsers(): HasMany
    {
        return $this->hasMany(SkillsUser::class, 'user_id');
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class, 'first_user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'connections', 'id', 'first_user_id');
        // User::all()->where()
    }

    public function scopeCategory($query, $category)
    {
        if ($category ?? false) {
            $query->join('animal_species', function ($join) {
                $join->on('users.species_id', '=', 'animal_species.species_id')
                    ->where('category', '=', request('category'));
            });
        }
    }

    public function scopeCanFly($query, $can_fly)
    {
        // dd($query->getQuery()->joins);

        if ($can_fly ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('can_fly', '=', request('can_fly'));
                });
            } else {
                $query->where('can_fly', '=', request('can_fly'));
            }
        }
    }

    public function scopeCanSwim($query, $can_swim)
    {

        if ($can_swim ?? false) {
            // dd((int) request('can_swim'));

            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('can_swim', '=', (int) request('can_swim'));
                });
            } else {
                $query->where('can_swim', '=', (int) request('can_swim'));
            }
        }
    }

    public function scopeCanClimb($query, $can_climb)
    {
        if ($can_climb ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('can_climb', '=', request('can_climb'));
                });
            } else {
                $query->where('can_climb', '=', request('can_climb'));
            }
        }
    }

    public function scopeEatingStyle($query, $eating_style)
    {
        if ($eating_style ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('eating_style', '=', request('eating_style'));
                });
            } else {
                $query->where('eating_style', '=', request('eating_style'));
            }
        }
    }

    public function scopeProducesToxins($query, $produces_toxins)
    {
        if ($produces_toxins ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('produces_toxins', '=', request('produces_toxins'));
                });
            } else {
                $query->where('produces_toxins', '=', request('produces_toxins'));
            }
        }
    }

    public function scopeSize($query, $size)
    {
        if ($size ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('size', '=', request('size'));
                });
            } else {
                $query->where('size', '=', request('size'));
            }
        }
    }

    public function scopeSpeed($query, $speed)
    {
        if ($speed ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('speed', '=', request('speed'));
                });
            } else {
                $query->where('speed', '=', request('speed'));
            }
        }
    }

    public function scopeNumAppendages($query, $num_appendages)
    {
        if ($num_appendages ?? false) {
            if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
                $query->join('animal_species', function ($join) {
                    $join->on('users.species_id', '=', 'animal_species.species_id')
                        ->where('num_appendages', '=', request('num_appendages'));
                });
            } else {
                $query->where('num_appendages', '=', request('num_appendages'));
            }
        }
    }

    // public function scopeAnimalTraits($query, array $filters){
    //     foreach ($filters as $trait) {
    //         if ($trait ?? false) {
    //             if ($query->getQuery()->joins == null || count($query->getQuery()->joins) == 0) {
    //                 $query->join('animal_species', function ($join) {
    //                     $join->on('users.species_id', '=', 'animal_species.species_id')
    //                         ->where('num_appendages', '=', request('num_appendages'));
    //                 });
    //             } else {
    //                 $query->where('num_appendages', '=', request('num_appendages'));
    //             }
    //         }
    //     }
    // }
}
