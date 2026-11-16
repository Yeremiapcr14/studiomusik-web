<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Studio extends Model
{
    // Kolom yang boleh diisi lewat create()/seeder
    protected $fillable = [
        'name', 'slug', 'type', 'badge', 'description',
        'capacity', 'facilities', 'price_per_hour', 'image', 'is_active',
    ];

    // Kolom JSON otomatis diubah jadi array PHP, dan boolean jadi true/false
    protected $casts = [
        'facilities' => 'array',
        'is_active'  => 'boolean',
    ];

    // Satu studio punya banyak reservasi
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
