<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'car_located_id',
        'delivery_location_id',
        'delivered'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function car(): HasOne
    {
        return $this->hasOne(CarLocation::class, 'id', 'car_located_id');
    }

    public function location(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'delivery_location_id');
    }
}
