<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'car_located_id',
        'delivery_location',
        'delivered',
        'delivery_deadline_in_days',
        'delivery_start_date',
        'delivery_finish_date'
    ];

    protected $hidden = [
        'user_id',
        'car_located_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

    public function car(): HasOne
    {
        return $this->hasOne(CarLocation::class, 'id', 'car_located_id');
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
