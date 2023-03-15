<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    use HasFactory;

    protected $primaryKey = 'connection_id';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'connection_id',
        'first_user_id',
        'second_user_id',
        'time_created',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_created' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first_user_id', 'user_id');
    }

    public function userSecond(): BelongsTo
    {
        return $this->belongsTo(User::class, 'second_user_id', 'user_id');
    }
}
