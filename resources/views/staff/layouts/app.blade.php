<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Hasil Pemeriksaan')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto">
            <a href="/" class="text-lg font-bold">Sistem Hasil Pemeriksaan</a>
        </div>
    </nav>

    <main class="container mx-auto">
        @yield('content')
    </main>

</body>
</html>
