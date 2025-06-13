@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pemeriksaan</h2>

        <form action="{{ route('pemeriksaans.update', $pemeriksaan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien:</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien', $pemeriksaan->nama_pasien) }}" required>
                @error('nama_pasien') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan:</label>
                <input type="date" class="form-control" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan', $pemeriksaan->tanggal_pemeriksaan) }}" required>
                @error('tanggal_pemeriksaan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="hasil_pemeriksaan" class="form-label">Hasil Pemeriksaan:</label>
                <textarea class="form-control" id="hasil_pemeriksaan" name="hasil_pemeriksaan" rows="3">{{ old('hasil_pemeriksaan', $pemeriksaan->hasil_pemeriksaan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Pemeriksaan</button>
            <a href="{{ route('pemeriksaans.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection