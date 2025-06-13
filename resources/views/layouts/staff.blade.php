
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin:0; }
        .staff-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: #fff; border-right: 1px solid #eee; padding: 0; }
        .sidebar-header { font-size: 1.5rem; font-weight: bold; color: #E4002B; padding: 2rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #eee; }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-nav a { display: block; padding: 0.9rem 2rem; color: #343a40; text-decoration: none; font-weight: 500; border-left: 4px solid transparent; }
        .sidebar-nav a.active, .sidebar-nav a:hover { background: #f3f3f3; color: #E4002B; border-left: 4px solid #E4002B; }
        .sidebar-footer { padding: 1.5rem 2rem; border-top: 1px solid #eee; }
        .main-content { flex: 1; padding: 2.5rem 3rem; }
    </style>
</head>
<body>
<div class="staff-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">Staff</div>
        <div class="sidebar-nav">
            <a href="{{ route('dashboard.staff', ['menu' => 'home']) }}" class="{{ (request('menu','home') == 'home') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('dashboard.staff', ['menu' => 'obat']) }}" class="{{ (request('menu') == 'obat') ? 'active' : '' }}">Pengelolaan Obat</a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('staff.logout') }}" method="POST">
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