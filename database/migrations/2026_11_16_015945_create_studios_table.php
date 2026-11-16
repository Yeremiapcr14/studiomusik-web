<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // contoh: "Studio A — Amplify"
            $table->string('slug')->unique();             // untuk URL, contoh: studio-a-amplify
            $table->string('type')->nullable();           // label di kartu, contoh: "Studio latihan"
            $table->string('badge')->nullable();          // label kecil di pojok kartu, contoh: "Tersedia"
            $table->text('description')->nullable();      // deskripsi singkat
            $table->unsignedInteger('capacity')->default(5);  // kapasitas orang
            $table->json('facilities')->nullable();       // daftar fasilitas, disimpan sebagai array JSON
            $table->unsignedInteger('price_per_hour');    // harga per jam (rupiah)
            $table->string('image')->nullable();          // path foto studio
            $table->boolean('is_active')->default(true);  // tampil/tidak di website
            $table->timestamps();                         // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};
