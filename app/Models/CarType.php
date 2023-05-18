<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends Model
{
    use HasFactory;

    protected $table = 'car_types';
    protected $primaryKey = 'id';

    protected $fillable = [
        'display_name',
        'key_name'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Car::class, 'car_type_id', 'id');
    }
}
