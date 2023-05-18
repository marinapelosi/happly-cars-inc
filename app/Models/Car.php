<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }
}
