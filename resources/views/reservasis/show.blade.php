@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Reservasi</h2>

        <div class="card mb-3">
            <div class="card-header">
                Informasi Reservasi #{{ $reservasi->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Pasien: {{ $reservasi->pasien->nama_pasien ?? 'N/A' }}</h5>
                <p class="card-text"><strong>Dokter:</strong> {{ $reservasi->dokter->nama_dokter ?? 'N/A' }}</p> 
                <p class="card-text"><strong>Tanggal Reservasi:</strong> {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</p>
                <p class="card-text"><strong>Waktu Reservasi:</strong> {{ \Carbon\Carbon::parse($reservasi->waktu_reservasi)->format('H:i') }}</p> 
                <p class="card-text"><strong>Jenis Layanan:</strong> {{ $reservasi->jenis_layanan }}</p>
                <p class="card-text"><strong>Status:</strong>
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
                </p>
                <p class="card-text"><strong>Dibuat Pada:</strong> {{ $reservasi->created_at->format('d F Y H:i') }}</p>
                <p class="card-text"><strong>Terakhir Diperbarui:</strong> {{ $reservasi->updated_at->format('d F Y H:i') }}</p>
            </div>
        </div>

        <a href="{{ route('reservasis.index') }}" class="btn btn-secondary">Kembali ke Daftar Reservasi</a>
        <a href="{{ route('reservasis.edit', $reservasi->id) }}" class="btn btn-warning">Edit Reservasi</a>
    </div>
@endsection