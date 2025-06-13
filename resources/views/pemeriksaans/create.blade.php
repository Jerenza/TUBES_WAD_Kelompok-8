@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pemeriksaan Baru</h2>

        <form action="{{ route('pemeriksaans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="dokter_id" class="form-label">Dokter:</label>
                <select class="form-control" id="dokter_id" name="dokter_id" required>
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama_dokter }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="pasien_id" class="form-label">Pasien:</label>
                <select class="form-control" id="pasien_id" name="pasien_id" required>
                    <option value="">Pilih Pasien</option>
                    @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                            {{ $pasien->nama_pasien }}
                        </option>
                    @endforeach
                </select>
                @error('pasien_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa:</label>
                <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ old('diagnosa') }}" required>
                @error('diagnosa') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan:</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                @error('catatan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan:</label>
                <input type="date" class="form-control" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" required>
                @error('tanggal_pemeriksaan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
            <a href="{{ route('pemeriksaans.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection