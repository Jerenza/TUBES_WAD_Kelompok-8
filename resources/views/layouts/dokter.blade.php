<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Telkomedika</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar { width: 240px; background: #fff; border-right: 2px solid #E4002B; min-height: 100vh; position: fixed; }
        .main-content { margin-left: 240px; padding: 2.5rem 2rem; }
        .sidebar-header { padding: 2rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #dee2e6; }
        .sidebar-menu a { display: block; padding: 0.7rem 1.5rem; color: #343a40; text-decoration: none; border-radius: 6px; margin-bottom: 0.3rem; font-weight: 500; }
        .sidebar-menu a.active, .sidebar-menu a:hover { background: #E4002B; color: #fff; }
        .sidebar-logout { margin-top: auto; padding: 1.5rem; border-top: 1px solid #dee2e6; }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-header">
            <div style="font-weight:700;color:#E4002B;font-size:1.15rem;">{{ Auth::guard('dokter')->user()->nama ?? 'Dokter' }}</div>
            <div style="font-size:0.95rem;color:#343a40;">Dashboard Dokter</div>
        </div>
        <div class="sidebar-menu flex-grow-1">
            <a href="{{ route('dokter.jadwal') }}" class="{{ request()->routeIs('dokter.jadwal') ? 'active' : '' }}">Jadwal</a>
            <a href="{{ route('dokter.pemeriksaan.index') }}" class="{{ request()->routeIs('dokter.pemeriksaan.*') ? 'active' : '' }}">Masukkan Laporan</a>
        </div>
        <div class="sidebar-logout">
            <form action="{{ route('dokter.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html> 