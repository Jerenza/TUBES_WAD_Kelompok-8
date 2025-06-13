@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Obat: {{ $obat->nama_obat }}</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $obat->nama_obat }}</h5>
                <p class="card-text"><strong>ID:</strong> {{ $obat->id }}</p>
                <p class="card-text"><strong>Jenis:</strong> {{ $obat->jenis }}</p>
                <p class="card-text"><strong>Harga:</strong> Rp. {{ number_format($obat->harga, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Stok:</strong> {{ $obat->stok }}</p>
                <p class="card-text"><strong>Dibuat Pada:</strong> {{ $obat->created_at }}</p>
                <a href="{{ route('obats.index') }}" class="btn btn-primary">Kembali ke Daftar Obat</a>
                <a href="{{ route('obats.edit', $obat->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
@endsection