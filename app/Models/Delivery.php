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

    protected $hidden = [
        'user_id',
        'car_located_id',
        'delivery_location_id',
        'created_at',
        'updated_at',
        'deleted_at'
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

    public function scopeRequested($query): void
    {
        $query->where('delivered', false);
    }

    public function scopeCompleted($query): void
    {
        $query->where('delivered', true);
    }
}
