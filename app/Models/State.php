<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'capital',
        'year',
        'latitude',
        'longitude'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'id', 'location_id');
    }
}
