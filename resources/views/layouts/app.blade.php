<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Studio Positif')</title>

    {{-- Font Inter dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind lewat CDN (cukup untuk development, tanpa npm) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ALTERNATIF CEPAT: kalau Tailwind belum terpasang, hapus baris @vite di atas
         lalu aktifkan baris CDN di bawah ini (cukup untuk development).
    <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body class="bg-[#d9d9bd] text-[#1b2a41] antialiased" style="font-family: 'Inter', sans-serif;">

    {{-- ===== NAVBAR ===== --}}
    <header class="bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm font-bold">
                <span
                    class="flex h-6 w-6 items-center justify-center rounded-md bg-[#0f1f3d] text-xs text-white">♪</span>
                Studio Positif
            </a>

            <nav class="hidden items-center gap-6 text-xs font-medium md:flex">
                <a href="{{ route('home') }}" class="border-b-2 border-[#0f1f3d] pb-1 font-semibold">Beranda</a>
                <a href="#studio" class="text-gray-500 hover:text-[#0f1f3d]">Studio</a>
                <a href="#" class="text-gray-500 hover:text-[#0f1f3d]">Kalender</a>
                <a href="#" class="text-gray-500 hover:text-[#0f1f3d]">Reservasi Saya</a>
                <a href="#" class="text-gray-500 hover:text-[#0f1f3d]">Lapor Pemakaian</a>
            </nav>

            <div class="flex items-center gap-2 text-xs font-semibold">
                <a href="#" class="rounded-md border border-gray-300 px-3 py-1.5 hover:bg-gray-50">Login</a>
                <a href="#" class="rounded-md bg-[#0f1f3d] px-3 py-1.5 text-white hover:bg-[#1b2f57]">Daftar</a>
            </div>
        </div>
    </header>

    {{-- Isi halaman --}}
    <main class="mx-auto max-w-6xl px-6 py-8">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-white">
        <div class="mx-auto grid max-w-6xl gap-8 px-6 py-8 text-xs md:grid-cols-3">
            <div>
                <p class="text-sm font-bold">StudioKu</p>
                <p class="mt-2 max-w-xs text-gray-500">Ruang latihan musik yang nyaman. Tentukan studio, pilih jadwal,
                    dan datang untuk bermain.</p>
            </div>
            <div>
                <p class="font-semibold">Jelajahi</p>
                <ul class="mt-2 space-y-1 text-gray-500">
                    <li>Reservasi</li>
                    <li>Studio</li>
                    <li>Kalender</li>
                    <li>Reservasi Saya</li>
                    <li>Lapor Pemakaian</li>
                </ul>
            </div>
            <div>
                <p class="font-semibold">Hubungi Kami</p>
                <ul class="mt-2 space-y-1 text-gray-500">
                    <li>Jl. Merdeka No. 12, Bandung</li>
                    <li>(022) 0000 0000 · halo@studioku.id</li>
                </ul>
            </div>
        </div>
        <div class="mx-auto max-w-6xl border-t border-gray-100 px-6 py-3 text-[11px] text-gray-400">
            © {{ date('Y') }} StudioKu. Semua hak dilindungi.
        </div>
    </footer>
</body>

</html>
