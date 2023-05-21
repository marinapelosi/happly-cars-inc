<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'id';

    protected $fillable = [
        'car_type_id',
        'display_name',
        'key_name'
    ];

    protected $hidden = [
        'car_type_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    public function location(): HasMany
    {
        return $this->HasMany(CarLocation::class);
    }
}
