@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Pemeriksaan</h2>

        <div class="card mb-3">
            <div class="card-header">
                Informasi Pemeriksaan #{{ $pemeriksaan->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $pemeriksaan->nama_pasien }}</h5>
                <p class="card-text"><strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d F Y') }}</p>
                <p class="card-text"><strong>Hasil Pemeriksaan:</strong> {{ $pemeriksaan->hasil_pemeriksaan }}</p>
                <p class="card-text"><strong>Dibuat Pada:</strong> {{ $pemeriksaan->created_at->format('d F Y H:i') }}</p>
                <p class="card-text"><strong>Terakhir Diperbarui:</strong> {{ $pemeriksaan->updated_at->format('d F Y H:i') }}</p>
            </div>
        </div>

        <a href="{{ route('pemeriksaans.index') }}" class="btn btn-secondary">Kembali ke Daftar Pemeriksaan</a>
        <a href="{{ route('pemeriksaans.edit', $pemeriksaan->id) }}" class="btn btn-warning">Edit Pemeriksaan</a>
    </div>
@endsection