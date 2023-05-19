<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarLocation extends Model
{
    use HasFactory;

    protected $table = 'cars_locations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'car_id',
        'state_id',
        'available'
    ];

    public function car(): HasOne
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
