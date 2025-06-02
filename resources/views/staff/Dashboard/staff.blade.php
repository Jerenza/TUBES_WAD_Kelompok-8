@extends('staff.layouts.app')

@section('content')
<!-- Tambahkan link Google Fonts di head layout atau di sini -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --telkomedika-red: #E4002B;
        --telkomedika-gray-dark: #343a40;
        --telkomedika-gray-light: #f8f9fa;
        --telkomedika-gray-border: #dee2e6;
    }
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background-color: var(--telkomedika-gray-light);
        color: var(--telkomedika-gray-dark);
    }
    .sidebar {
        width: 240px;
        background: #fff;
        border-right: 2px solid var(--telkomedika-red);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10;
        box-shadow: 2px 0 8px rgba(0,0,0,0.04);
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .sidebar-header {
        padding: 2rem 1.5rem 1rem 1.5rem;
        border-bottom: 1px solid var(--telkomedika-gray-border);
        text-align: left;
    }
    .sidebar-header .staff-name {
        font-weight: 700;
        color: var(--telkomedika-red);
        font-size: 1.15rem;
        margin-bottom: 0.2rem;
        letter-spacing: 0.5px;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .sidebar-header div {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .sidebar-menu {
        flex: 1;
        padding: 1.5rem 0.5rem 1rem 0.5rem;
    }
    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 0.7rem 1.5rem;
        color: var(--telkomedika-gray-dark);
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 0.3rem;
        font-weight: 500;
        font-size: 1.08rem;
        letter-spacing: 0.2px;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        transition: background 0.15s, color 0.15s;
    }
    .sidebar-menu a.active, .sidebar-menu a:hover {
        background: var(--telkomedika-red);
        color: #fff;
    }
    .sidebar-logout {
        margin-top: auto;
        padding: 1.5rem;
        border-top: 1px solid var(--telkomedika-gray-border);
    }
    .sidebar-logout form {
        margin: 0;
    }
    .sidebar-logout button {
        width: 100%;
        background: var(--telkomedika-red);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.7rem 0;
        font-weight: 600;
        font-size: 1.08rem;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        cursor: pointer;
        transition: background 0.15s;
    }
    .sidebar-logout button:hover {
        background: #c70025;
    }
    .main-content {
        margin-left: 240px;
        padding: 2.5rem 2rem;
        min-height: 100vh;
        background: var(--telkomedika-gray-light);
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .main-content h1 {
        font-family:'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    @media (max-width: 900px) {
        .sidebar { width: 100%; min-height: auto; position: static; }
        .main-content { margin-left: 0; padding: 1rem; }
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="staff-name">
            {{ session('staff_nama', 'Staff') }}
        </div>
        <div style="font-size:0.95rem; color:var(--telkomedika-gray-dark);">
            Dashboard Staff
        </div>
    </div>
    <div class="sidebar-menu">
        <a>Jadwal</a>
        <a>Input Laporan</a>
    </div>
    <div class="sidebar-logout">
        <form action="{{ route('staff.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="main-content">
    {{-- Default page: Jadwal --}}
    <h1 style="color:var(--telkomedika-red); font-size:2rem; font-weight:bold;">Jadwal Staff</h1>
    <p>Selamat datang di halaman jadwal. (Tampilkan tabel jadwal di sini)</p>
    {{-- Tambahkan konten jadwal di sini --}}
</div>
@endsection
