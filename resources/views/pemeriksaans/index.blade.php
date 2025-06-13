@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Pemeriksaan</h2>

        {{-- Pesan sukses (jika ada) --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pemeriksaans.create') }}" class="btn btn-primary mb-3">Tambah Pemeriksaan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dokter</th>
                    <th>Pasien</th> 
                    <th>Diagnosa</th>
                    <th>Catatan</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>{{ $pemeriksaan->id }}</td>
                        <td>{{ $pemeriksaan->dokter->nama_dokter ?? 'N/A' }}</td>
                        <td>{{ $pemeriksaan->pasien->nama_pasien ?? 'N/A' }}</td>
                        <td>{{ $pemeriksaan->diagnosa }}</td>
                        <td>{{ $pemeriksaan->catatan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d F Y') }}</td>
                        <td>
                            <a href="{{ route('pemeriksaans.show', $pemeriksaan->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('pemeriksaans.edit', $pemeriksaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemeriksaans.destroy', $pemeriksaan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pemeriksaan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pemeriksaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection