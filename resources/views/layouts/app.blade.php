<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelkoMedika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        :root {
            --telkomedika-red: #E4002B; /* Merah Telkom (contoh) */
            --telkomedika-gray-dark: #343a40; /* Abu-abu gelap untuk teks */
            --telkomedika-gray-light: #f8f9fa; /* Abu-abu terang untuk background elemen */
            --telkomedika-gray-border: #dee2e6; /* Abu-abu untuk border */
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--telkomedika-gray-light); /* Background body abu-abu terang */
            color: var(--telkomedika-gray-dark); /* Warna teks default */
        }

        .navbar {
            background-color: #ffffff !important; /* Navbar putih */
            border-bottom: 3px solid var(--telkomedika-red); /* Garis merah di bawah navbar */
            padding-top: 0.5rem !important; /* Kurangi padding atas */
            padding-bottom: 0.5rem !important; /* Kurangi padding bawah */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Bayangan lembut */
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: var(--telkomedika-gray-dark) !important; /* Warna teks navigasi */
        }

        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: var(--telkomedika-red) !important; /* Hover warna merah */
            
        }

        .navbar-nav .nav-link.active {
            color: var(--telkomedika-red) !important; /* Link aktif merah */
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--telkomedika-red);
            border-color: var(--telkomedika-red);
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #c70025; /* Sedikit lebih gelap saat hover */
            border-color: #c70025;
        }

        .btn-info {
            background-color: var(--telkomedika-gray-dark); /* Tombol Lihat/Info abu-abu gelap */
            border-color: var(--telkomedika-gray-dark);
        }
        .btn-info:hover {
            background-color: #212529; /* Sedikit lebih gelap */
            border-color: #212529;
        }

        .btn-warning {
            background-color: #ffc107; /* Warna kuning Bootstrap default untuk warning */
            border-color: #ffc107;
            color: #212529; /* Teks gelap */
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-danger {
            background-color: var(--telkomedika-red); /* Tombol Hapus merah */
            border-color: var(--telkomedika-red);
        }
        .btn-danger:hover {
            background-color: #c70025;
            border-color: #c70025;
        }

        .table {
            background-color: #ffffff; /* Background tabel putih */
            border: 1px solid var(--telkomedika-gray-border); /* Border keseluruhan tabel */
            border-radius: 8px; /* Sudut membulat pada tabel */
            overflow: hidden; /* Penting untuk radius border */
        }

        .table th, .table td {
            vertical-align: middle; /* Rata tengah vertikal */
            padding: 12px 15px; /* Padding lebih nyaman */
            border-color: var(--telkomedika-gray-border); /* Warna border antar sel */
        }

        .table thead th {
            background-color: var(--telkomedika-gray-dark); /* Header tabel abu-abu gelap */
            color: #ffffff; /* Teks header putih */
            border-bottom: 2px solid var(--telkomedika-red); /* Garis bawah header merah */
            text-transform: uppercase; /* Huruf kapital */
            font-size: 0.9em; /* Ukuran font lebih kecil */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna baris genap abu-abu sangat muda */
        }

        .table tbody tr:hover {
            background-color: #e9ecef; /* Hover baris abu-abu muda */
        }

        .container {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        h2 {
            color: var(--telkomedika-red); /* Judul H2 merah */
            margin-bottom: 25px;
            font-weight: 600;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_telkomedika.png') }}" alt="Logo" height="60" class="me-2">                TelkoMedika
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('obats.index') }}">Obat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>