<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'studio_id', 'user_id', 'booking_date', 'start_time',
        'duration_hours', 'total_price', 'status',
    ];

    // booking_date otomatis jadi objek Carbon (mudah diformat/dibandingkan)
    protected $casts = [
        'booking_date' => 'date',
    ];

    // Setiap reservasi milik satu studio
    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    // Setiap reservasi milik satu pelanggan (boleh kosong)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
