<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Semua studio aktif: dipakai untuk dropdown "Studio" dan kartu "Studio pilihan"
        $studios = Studio::where('is_active', true)->get();

        // Hasil pencarian ketersediaan (null jika form belum dikirim)
        $searchResults = null;

        // Form "Cari ketersediaan" dikirim lewat GET: ?studio=..&date=..&time=..
        if ($request->filled('date') && $request->filled('time')) {
            $request->validate([
                'studio' => 'nullable|exists:studios,id',
                'date'   => 'required|date|after_or_equal:today',
                'time'   => 'required|date_format:H:i',
            ]);

            $start = Carbon::parse($request->date . ' ' . $request->time);

            // Ambil reservasi aktif (bukan cancelled) pada tanggal tersebut
            $bookings = Booking::whereDate('booking_date', $request->date)
                ->where('status', '!=', 'cancelled')
                ->get();

            // Cari studio yang bentrok dengan jam yang dipilih
            $busyStudioIds = $bookings->filter(function ($b) use ($start) {
                $bookingStart = Carbon::parse($b->booking_date->format('Y-m-d') . ' ' . $b->start_time);
                $bookingEnd   = $bookingStart->copy()->addHours($b->duration_hours);
                return $start->gte($bookingStart) && $start->lt($bookingEnd);
            })->pluck('studio_id')->unique();

            // Studio yang dicari (semua, atau satu studio saja jika dipilih)
            $candidates = $request->filled('studio')
                ? $studios->where('id', $request->studio)
                : $studios;

            // Sisakan studio yang tidak bentrok
            $searchResults = $candidates->whereNotIn('id', $busyStudioIds)->values();
        }

        // Kirim data ke view resources/views/customer/home.blade.php
        return view('customer.home', [
            'studios'       => $studios,
            'featured'      => $studios->take(3), // 3 kartu di bagian "Studio pilihan"
            'searchResults' => $searchResults,
        ]);
    }
}
