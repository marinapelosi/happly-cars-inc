<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersLocation extends Model
{
    use HasFactory;

    protected $table = 'users_locations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'state_id',
        'current'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
