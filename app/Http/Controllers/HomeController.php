<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $studios = [
            [
                'name' => 'Studio A — Amplify',
                'type' => 'Studio band',
                'capacity' => '6 orang',
                'facilities' => 'AC, Wi-Fi, Drum, Gitar',
                'price' => 80000,
                'image' => 'images/studio-a.jpg',
                'slug' => 'studio-a',
            ],

            [
                'name' => 'Studio B — Rhythm',
                'type' => 'Studio latihan',
                'capacity' => '4 orang',
                'facilities' => 'AC, Wi-Fi, Drum, Monitor',
                'price' => 80000,
                'image' => 'images/studio-b.jpg',
                'slug' => 'studio-b',
            ],

            [
                'name' => 'Studio C — Session',
                'type' => 'Studio premium',
                'capacity' => '8 orang',
                'facilities' => 'AC, Wi-Fi, Drum, Keyboard',
                'price' => 80000,
                'image' => 'images/studio-c.jpg',
                'slug' => 'studio-c',
            ],
        ];

        return view('home', compact('studios'));
    }
}
