<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        // Data contoh sesuai wireframe (Studio A, B, C). Sesuaikan isinya dengan studiomu.
        $studios = [
            [
                'name' => 'Studio A — Amplify',
                'slug' => 'studio-a-amplify',
                'type' => 'Studio latihan',
                'badge' => 'Tersedia',
                'description' => 'Cocok untuk band kecil dan latihan santai.',
                'capacity' => 5,
                'facilities' => ['AC', 'Drum set', 'Amplifier gitar', 'Mic'],
                'price_per_hour' => 60000,
                'image' => 'images/studios/studio-a.jpg',
            ],
            [
                'name' => 'Studio B — Rhythm',
                'slug' => 'studio-b-rhythm',
                'type' => 'Studio latihan',
                'badge' => 'Tersedia',
                'description' => 'Ruang lebih luas dengan peralatan drum lengkap.',
                'capacity' => 6,
                'facilities' => ['AC', 'Drum set', 'Amplifier bass', 'Mic'],
                'price_per_hour' => 80000,
                'image' => 'images/studios/studio-b.jpg',
            ],
            [
                'name' => 'Studio C — Session',
                'slug' => 'studio-c-session',
                'type' => 'Studio rekaman',
                'badge' => 'Tersedia',
                'description' => 'Ideal untuk sesi rekaman dan latihan intensif.',
                'capacity' => 8,
                'facilities' => ['AC', 'Drum set', 'Keyboard', 'Mixer'],
                'price_per_hour' => 80000,
                'image' => 'images/studios/studio-c.png',
            ],
        ];

        $this->call(StudioSeeder::class); // jalankan seeder studio

        foreach ($studios as $data) {
            // updateOrCreate: aman dijalankan berulang, tidak membuat data ganda
            Studio::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
