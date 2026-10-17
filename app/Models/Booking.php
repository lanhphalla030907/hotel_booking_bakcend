<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = ['booking_code', 'user_id', 'hotel_id', 'check_in_date', 'check_out_date', 'total_guests', 'subtotal', 'tax_amount', 'total_amount', 'currency', 'status', 'checked_in_at', 'checked_in_by', 'checked_out_at', 'checked_out_by', 'cancelled_at', 'cancellation_reason', 'special_requests',];
    protected function casts(): array
    {
        return ['check_in_date' => 'date', 'check_out_date' => 'date', 'total_guests' => 'integer', 'subtotal' => 'decimal:2', 'tax_amount' => 'decimal:2', 'total_amount' => 'decimal:2', 'checked_in_at' => 'datetime', 'checked_out_at' => 'datetime', 'cancelled_at' => 'datetime',];
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }
    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }
    public function items(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }
}
