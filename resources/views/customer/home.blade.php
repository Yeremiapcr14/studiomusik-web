@extends('layouts.app')

@section('title', 'Beranda — Studio Positif')

@section('content')

{{-- ===== JUDUL HALAMAN ===== --}}
<p class="text-[11px] font-medium text-gray-500">Studio Positif</p>
<h1 class="mt-1 text-2xl font-extrabold">Beranda</h1>
<p class="mb-5 text-xs text-gray-500">Selamat datang di Studio Positif. Tentukan sesi latihanmu hari ini.</p>

{{-- ===== HERO ===== --}}
<section class="grid overflow-hidden rounded-2xl bg-white shadow-sm md:grid-cols-2">
    <div class="flex flex-col justify-center p-8">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-400">Reservasi Studio Musik</p>
        <h2 class="mt-3 text-4xl font-extrabold leading-tight">Ruang untuk<br>musik terbaikmu.</h2>
        <p class="mt-3 max-w-sm text-xs text-gray-500">
            Pilih studio favorit, tentukan waktu, dan datang untuk bermain. Cukup beberapa langkah, reservasi langsung tercatat.
        </p>
        <div class="mt-5 flex gap-2 text-xs font-semibold">
            <a href="#studio" class="rounded-lg bg-[#0f1f3d] px-4 py-2 text-white hover:bg-[#1b2f57]">Temukan studio →</a>
            <a href="#" class="rounded-lg border border-gray-300 px-4 py-2 hover:bg-gray-50">Lihat kalender</a>
        </div>
    </div>

    <div class="min-h-[260px] bg-gradient-to-br from-[#2b3a55] to-[#0f1f3d]">
        @if (file_exists(public_path('images/hero.png')))
    <img src="{{ asset('images/hero.png') }}">
        @endif
    </div>
</section>

{{-- ===== FORM CARI KETERSEDIAAN ===== --}}
<section id="cari" class="mt-5 rounded-2xl bg-white p-6 shadow-sm">
    <h3 class="text-base font-bold">Kapan mau latihan?</h3>
    <p class="mb-4 text-xs text-gray-500">Cek ketersediaan studio sebelum memesan.</p>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="mb-3 rounded-lg bg-red-50 px-3 py-2 text-xs text-red-600">{{ $errors->first() }}</div>
    @endif

    {{-- Form dikirim lewat GET ke HomeController@index --}}
    <form action="{{ route('home') }}#cari" method="GET">
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block text-[11px] font-semibold">Studio</label>
                <select name="studio" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-xs">
                    <option value="">Semua studio</option>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}" @selected(request('studio') == $studio->id)>{{ $studio->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-[11px] font-semibold">Tanggal latihan</label>
                <input type="date" name="date" min="{{ date('Y-m-d') }}" value="{{ request('date', date('Y-m-d')) }}"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-xs">
            </div>
            <div>
                <label class="mb-1 block text-[11px] font-semibold">Jam mulai</label>
                <select name="time" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-xs">
                    @for ($h = 8; $h <= 22; $h++)
                        @php $jam = sprintf('%02d:00', $h); @endphp
                        <option value="{{ $jam }}" @selected(request('time', '15:00') == $jam)>{{ $jam }} WIB</option>
                    @endfor
                </select>
            </div>
        </div>

        <button type="submit" class="mt-4 rounded-lg bg-[#0f1f3d] px-4 py-2 text-xs font-semibold text-white hover:bg-[#1b2f57]">
            Cari ketersediaan →
        </button>
    </form>

    {{-- Hasil pencarian (hanya tampil setelah form dikirim) --}}
    @if (!is_null($searchResults))
        <div class="mt-5 border-t border-gray-100 pt-4">
            @forelse ($searchResults as $studio)
                <div class="mb-2 flex items-center justify-between rounded-lg bg-[#f4f4ea] px-4 py-3 text-xs">
                    <div>
                        <p class="font-semibold">{{ $studio->name }}</p>
                        <p class="text-gray-500">Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }} / jam</p>
                    </div>
                    <span class="rounded-full bg-green-100 px-3 py-1 font-semibold text-green-700">Tersedia</span>
                </div>
            @empty
                <p class="text-xs text-red-600">Maaf, tidak ada studio yang tersedia pada waktu tersebut.</p>
            @endforelse
        </div>
    @endif
</section>

{{-- ===== STUDIO PILIHAN ===== --}}
<section id="studio" class="mt-5 rounded-2xl bg-[#e8e8d2] p-6 shadow-sm">
    <h3 class="text-base font-bold">Studio pilihan untuk setiap sesi</h3>
    <p class="mb-4 text-xs text-gray-500">Dari latihan santai sampai persiapan pentas.</p>

    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($featured as $studio)
            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                {{-- Foto studio; kalau file belum ada, tampil warna pengganti --}}
                <div class="h-32 bg-gradient-to-br from-gray-300 to-gray-500">
                    @if ($studio->image && file_exists(public_path($studio->image)))
                        <img src="{{ asset($studio->image) }}" alt="{{ $studio->name }}" class="h-full w-full object-cover">
                    @endif
                </div>

                <div class="p-4">
                    <div class="flex items-center justify-between text-[10px] text-gray-400">
                        <span>{{ $studio->type }}</span>
                        <span class="rounded bg-green-100 px-2 py-0.5 font-semibold text-green-700">{{ $studio->badge }}</span>
                    </div>
                    <h4 class="mt-1 text-sm font-bold">{{ $studio->name }}</h4>
                    <p class="mt-1 text-[11px] text-gray-500">
                        {{ $studio->capacity }} orang · {{ implode(' · ', $studio->facilities ?? []) }}
                    </p>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <p class="text-base font-extrabold">Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }}</p>
                            <p class="text-[10px] text-gray-400">per jam</p>
                        </div>
                        <a href="#cari" class="rounded-lg border border-gray-300 px-3 py-1.5 text-[11px] font-semibold hover:bg-gray-50">
                            Lihat detail →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="#" class="mt-4 inline-block rounded-lg border border-gray-400 px-3 py-1.5 text-[11px] font-semibold hover:bg-white">
        Lihat semua studio →
    </a>
</section>

{{-- ===== ALUR RESERVASI ===== --}}
<section class="mt-5 grid gap-6 rounded-2xl bg-white p-6 shadow-sm md:grid-cols-2">
    <div>
        <h3 class="text-base font-bold">Dari rencana jadi sesi latihan</h3>
        <p class="mb-4 text-xs text-gray-500">Reservasi cepat, tanpa ribet.</p>

        @php
            $steps = [
                ['Tentukan studio yang cocok', 'Bandingkan fasilitas, kapasitas, dan harga per jam.'],
                ['Pilih jadwal latihan', 'Cek slot kosong, lalu pilih tanggal dan jam.'],
                ['Konfirmasi dan mulai bermusik', 'Kirim reservasi, datang tepat waktu, dan bermain.'],
            ];
        @endphp

        <ol class="space-y-4">
            @foreach ($steps as $i => $step)
                <li class="flex gap-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#0f1f3d] text-[11px] font-bold text-white">{{ $i + 1 }}</span>
                    <div>
                        <p class="text-xs font-bold">{{ $step[0] }}</p>
                        <p class="text-[11px] text-gray-500">{{ $step[1] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>

    <div class="flex flex-col justify-center rounded-xl bg-[#e8e8d2] p-6">
        <h4 class="text-lg font-extrabold leading-snug">Latihan nyaman,<br>persiapan lebih tenang.</h4>
        <p class="mt-2 text-[11px] text-gray-600">Semua studio dilengkapi peralatan standar dan pendingin ruangan.</p>
        <p class="mt-3 text-[11px] text-gray-600">Jam operasional: 10.00–22.00 WIB<br>Bantuan reservasi: (022) 0000 0000</p>
        <a href="#cari" class="mt-4 w-fit rounded-lg bg-[#0f1f3d] px-4 py-2 text-xs font-semibold text-white hover:bg-[#1b2f57]">Mulai reservasi</a>
    </div>
</section>

@endsection
