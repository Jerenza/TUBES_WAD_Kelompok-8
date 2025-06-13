@extends('layouts.app')

@section('content')
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
    .sidebar-header .pasien-name {
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
    .btn-custom-green {
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    font-size: 1rem;
    transition: background 0.2s ease-in-out;
    }
    .btn-custom-green:hover {
        background-color: #218838;
        color: #fff;
    }
    .field-row { margin-bottom: 1.5rem !important; }
    .form-control { font-weight: 400 !important; border-radius: 4px !important; }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="pasien-name">
            {{ session('pasien_nama', 'Pasien') }}
        </div>
        <div style="font-size:0.95rem; color:var(--telkomedika-gray-dark);">
            Dashboard Pasien
        </div>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard.pasien', ['menu' => 'home']) }}" class="{{ $menu == 'home' ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('dashboard.pasien', ['menu' => 'reservasi']) }}" class="{{ $menu == 'reservasi' ? 'active' : '' }}">Reservasi</a>
        <a href="{{ route('dashboard.pasien', ['menu' => 'pemeriksaan']) }}" class="{{ $menu == 'pemeriksaan' ? 'active' : '' }}">Pemeriksaan</a>
    </div>
    <div class="sidebar-logout">
        <form action="{{ route('pasien.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="main-content">
    @if($menu == 'home')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Selamat Datang, {{ $pasien->nama }}!</h1>
        <p style="font-size:1.1rem;color:#555;">Ini adalah dashboard pasien. Silakan pilih menu di samping untuk melihat reservasi atau hasil pemeriksaan Anda.</p>
    @elseif($menu == 'reservasi')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Jadwal Reservasi</h1>
        <form method="GET" style="display:inline;">
            <input type="hidden" name="menu" value="reservasi">
            <input type="hidden" name="action" value="tambah">
            <button type="submit" class="btn-custom-green mb-3">+ Tambah Data</button>
        </form>
        @if(request('action') == 'tambah')
            <div class="card mb-4" style="max-width:500px;">
                <div class="card-body">
                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <table class="w-100" style="margin-bottom:1.5rem;">
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Nama Dokter</label></td>
                                <td><input type="text" name="dokter_id" class="form-control input-normal" placeholder="Nama Dokter" required></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Tanggal Reservasi</label></td>
                                <td><input type="date" name="tanggal_reservasi" class="form-control input-normal" required></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Waktu Reservasi</label></td>
                                <td><input type="time" name="waktu_reservasi" class="form-control input-normal" required></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Status</label></td>
                                <td>
                                    <select name="status" class="form-control input-normal">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-custom-green">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <style>
            .field-row { height: 3.2rem; }
            .form-control.input-normal { font-weight: 400 !important; border-radius: 4px !important; border-width: 1px !important; box-shadow: none !important; }
            </style>
        @endif
        <div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->pasien->nama }}</td>
                        <td>{{ $item->dokter->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d/m/Y') }}</td>
                        <td>{{ $item->waktu_reservasi }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'selesai' ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada jadwal reservasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div></div>
    @elseif($menu == 'pemeriksaan')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Riwayat Pemeriksaan</h1>
        <form method="GET" style="display:inline;">
            <input type="hidden" name="menu" value="pemeriksaan">
            <input type="hidden" name="action" value="tambah">
            <button type="submit" class="btn-custom-green mb-3">+ Tambah Data</button>
        </form>
        @if(request('action') == 'tambah')
            <div class="card mb-4" style="max-width:500px;">
                <div class="card-body">
                    <form action="#" method="POST">
                        <table class="w-100" style="margin-bottom:1.5rem;">
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Nama Dokter</label></td>
                                <td><input type="text" name="dokter_id" class="form-control input-normal" placeholder="Nama Dokter" required></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Diagnosa</label></td>
                                <td><input type="text" name="diagnosa" class="form-control input-normal" required></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Catatan</label></td>
                                <td><input type="text" name="catatan" class="form-control input-normal"></td>
                            </tr>
                            <tr class="field-row">
                                <td style="min-width:140px;vertical-align:middle;"><label class="form-label mb-0" style="font-weight:400;">Tanggal Pemeriksaan</label></td>
                                <td><input type="date" name="tanggal_pemeriksaan" class="form-control input-normal" required></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-custom-green">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <style>
            .field-row { height: 3.2rem; }
            .form-control.input-normal { font-weight: 400 !important; border-radius: 4px !important; border-width: 1px !important; box-shadow: none !important; }
            </style>
        @endif
        <div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosa</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaan as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->dokter->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                        <td>{{ $item->diagnosa }}</td>
                        <td>{{ $item->catatan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pemeriksaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div></div>
    @endif
</div>
@endsection 