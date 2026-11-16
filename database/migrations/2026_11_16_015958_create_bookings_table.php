<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel studios; kalau studio dihapus, reservasinya ikut terhapus
            $table->foreignId('studio_id')->constrained()->cascadeOnDelete();
            // Relasi ke pelanggan (boleh kosong dulu, nanti dihubungkan ke fitur login)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->date('booking_date');                 // tanggal latihan
            $table->time('start_time');                   // jam mulai
            $table->unsignedTinyInteger('duration_hours')->default(1); // durasi (jam)
            $table->unsignedInteger('total_price')->default(0);        // total biaya
            $table->string('status')->default('pending'); // pending / confirmed / cancelled
            $table->timestamps();

            // Mempercepat pencarian ketersediaan (studio + tanggal)
            $table->index(['studio_id', 'booking_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
