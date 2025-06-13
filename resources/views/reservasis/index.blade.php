@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Daftar Reservasi</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('reservasis.create') }}" class="btn btn-primary mb-3">Buat Reservasi Baru</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pasien</th>        
                        <th>Dokter</th>         
                        <th>Tanggal Reservasi</th>
                        <th>Waktu Reservasi</th> 
                        <th>Jenis Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $reservasi)
                        <tr>
                            <td>{{ $reservasi->id }}</td>
                            <td>{{ $reservasi->pasien->nama_pasien ?? 'N/A' }}</td>
                            <td>{{ $reservasi->dokter->nama_dokter ?? 'N/A' }}</td> 
                            <td>{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservasi->waktu_reservasi)->format('H:i') }}</td>
                            <td>{{ $reservasi->jenis_layanan }}</td>
                            <td>
                                @if ($reservasi->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($reservasi->status == 'dikonfirmasi')
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                @elseif ($reservasi->status == 'completed') 
                                    <span class="badge bg-info">Completed</span>
                                @elseif ($reservasi->status == 'dibatalkan')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @else
                                    {{ $reservasi->status }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('reservasis.show', $reservasi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('reservasis.edit', $reservasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('reservasis.destroy', $reservasi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data reservasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection