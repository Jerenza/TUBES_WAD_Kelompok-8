<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Segoe+UI:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8f9fa;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 240px;
            background: #fff;
            border-right: 1px solid #eee;
            box-shadow: 2px 0 8px rgba(0,0,0,0.03);
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #E4002B;
            padding: 2rem 1.5rem 1rem 1.5rem;
            border-bottom: 1px solid #eee;
        }
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
        }
        .sidebar-nav a {
            display: block;
            padding: 0.9rem 2rem;
            color: #343a40;
            text-decoration: none;
            font-weight: 500;
            border-left: 4px solid transparent;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .sidebar-nav a.active, .sidebar-nav a:hover {
            background: #f3f3f3;
            color: #E4002B;
            border-left: 4px solid #E4002B;
        }
        .sidebar-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid #eee;
        }
        .main-content {
            flex: 1;
            padding: 2.5rem 3rem;
        }
        @media (max-width: 900px) {
            .admin-wrapper { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; border-right: none; border-bottom: 1px solid #eee; }
            .sidebar-header, .sidebar-footer { display: none; }
            .sidebar-nav { display: flex; flex-direction: row; padding: 0; }
            .sidebar-nav a { padding: 1rem 1rem; border-left: none; border-bottom: 4px solid transparent; }
            .sidebar-nav a.active, .sidebar-nav a:hover { border-bottom: 4px solid #E4002B; border-left: none; }
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">Admin</div>
        <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard', ['menu' => 'home']) }}" class="{{ (isset($menu) && $menu == 'home') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.dashboard', ['menu' => 'dokter']) }}" class="{{ (isset($menu) && $menu == 'dokter') ? 'active' : '' }}">Pengelolaan Dokter</a>
            <a href="{{ route('admin.dashboard', ['menu' => 'pasien']) }}" class="{{ (isset($menu) && $menu == 'pasien') ? 'active' : '' }}">Pengelolaan Pasien</a>
            <a href="{{ route('admin.dashboard', ['menu' => 'staff']) }}" class="{{ (isset($menu) && $menu == 'staff') ? 'active' : '' }}">Pengelolaan Staff</a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" style="background:#E4002B;color:#fff;border:none;padding:0.7rem 1.2rem;border-radius:6px;font-weight:bold;cursor:pointer;width:100%;">Logout</button>
            </form>
        </div>
    </nav>
    <main class="main-content">
        @yield('content')
    </main>
</div>
</body>
</html> 