@extends('layouts.app')

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
    .sidebar-header .doctor-name {
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

</style>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="doctor-name">
            {{ session('dokter_nama', 'Dokter') }}
        </div>
        <div style="font-size:0.95rem; color:var(--telkomedika-gray-dark);">
            Dashboard Dokter
        </div>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard.dokter', ['menu' => 'home']) }}" class="{{ $menu == 'home' ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('dashboard.dokter', ['menu' => 'jadwal']) }}" class="{{ $menu == 'jadwal' ? 'active' : '' }}">Jadwal</a>
        <a href="{{ route('dashboard.dokter', ['menu' => 'laporan']) }}" class="{{ $menu == 'laporan' ? 'active' : '' }}">Masukkan Laporan</a>
    </div>
    <div class="sidebar-logout">
        <form action="{{ route('dokter.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($menu == 'home')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Selamat Datang, {{ $dokter->nama }}!</h1>
        <p style="font-size:1.1rem;color:#555;">Ini adalah dashboard dokter. Silakan pilih menu di samping untuk melihat jadwal atau mengelola laporan pemeriksaan.</p>
    @elseif($menu == 'jadwal')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Jadwal Reservasi</h1>
        @if(!request('action'))
            <form method="GET" style="display:inline;">
                <input type="hidden" name="menu" value="jadwal">
                <input type="hidden" name="action" value="tambah">
                <button type="submit" class="btn-custom-green mb-3">+ Tambah Data</button>
            </form>
        @endif
        @if(request('action') == 'tambah')
            <form action="{{ route('reservasi.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-2">
                    <label>Pasien</label>
                    <input type="text" name="pasien_id" class="form-control" placeholder="ID Pasien" required>
                </div>
                <div class="mb-2">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_reservasi" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Waktu</label>
                    <input type="time" name="waktu_reservasi" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        @endif
        <div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->pasien->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d/m/Y') }}</td>
                        <td>{{ $item->waktu_reservasi }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'selesai' ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('reservasi.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $item->status == 'selesai' ? 'pending' : 'selesai' }}">
                                <button type="submit" class="btn btn-sm {{ $item->status == 'selesai' ? 'btn-warning' : 'btn-success' }}">
                                    {{ $item->status == 'selesai' ? 'Batalkan Selesai' : 'Tandai Selesai' }}
                                </button>
                            </form>
                            <form action="{{ route('reservasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?')">
                                    Hapus
                                </button>
                            </form>
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
    @elseif($menu == 'laporan')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;">Data Pemeriksaan</h1>
        @if(!request('action'))
            <form method="GET" style="display:inline;">
                <input type="hidden" name="menu" value="laporan">
                <input type="hidden" name="action" value="tambah">
                <button type="submit" class="btn-custom-green mb-3">+ Tambah Data</button>
            </form>
        @endif
        @if(request('action') == 'tambah')
            <form action="{{ route('dokter.pemeriksaan.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-2">
                    <label>Pasien</label>
                    <input type="text" name="pasien_id" class="form-control" placeholder="ID Pasien" required>
                </div>
                <div class="mb-2">
                    <label>Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Diagnosa</label>
                    <input type="text" name="diagnosa" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Catatan</label>
                    <input type="text" name="catatan" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        @endif
        <div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosa</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaan as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->pasien->nama }}</td>
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