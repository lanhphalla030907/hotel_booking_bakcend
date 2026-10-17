<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomAvailability extends Model
{
    protected $fillable = [
        'room_type_id',
        'availability_date',
        'total_rooms',
        'available_rooms',
        'price_per_night',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'availability_date' => 'date',
            'total_rooms' => 'integer',
            'available_rooms' => 'integer',
            'price_per_night' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
}
