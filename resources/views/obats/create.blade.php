@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Obat Baru</h2>

        <form action="{{ route('obats.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat:</label>
                <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
            </div>

            <div class="mb-3">
                <label for="golongan_obat" class="form-label">Jenis:</label>
                <input type="text" class="form-control" id="jenis" name="golongan_obat" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('obats.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection