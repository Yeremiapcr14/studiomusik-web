<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudioKu | Beranda</title>

    <link rel="stylesheet"
          href="{{ asset('css/home.css') }}">
</head>
<body>

    <!-- Isi halaman Beranda di sini -->

    <script src="{{ asset('js/home.js') }}"></script>

</body>
</html>
@foreach ($studios as $studio)

    <article class="studio-card">

        <img
            src="{{ asset($studio['image']) }}"
            alt="{{ $studio['name'] }}"
        >

        <h3>{{ $studio['name'] }}</h3>

        <p>{{ $studio['capacity'] }}</p>

        <p>{{ $studio['facilities'] }}</p>

        <strong>
            Rp{{ number_format($studio['price'], 0, ',', '.') }}
        </strong>

    </article>

@endforeach
