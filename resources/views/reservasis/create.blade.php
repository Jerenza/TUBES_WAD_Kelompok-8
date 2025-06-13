@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Buat Reservasi Baru</h2>

        <form action="{{ route('reservasis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pasien_id" class="form-label">Pasien:</label>
                <select class="form-control" id="pasien_id" name="pasien_id" required>
                    <option value="">Pilih Pasien</option>
                    @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                        </option>
                    @endforeach
                </select>
                @error('pasien_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="dokter_id" class="form-label">Dokter:</label>
                <select class="form-control" id="dokter_id" name="dokter_id" required>
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                        </option>
                    @endforeach
                </select>
                @error('dokter_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi:</label>
                <input type="date" class="form-control" id="tanggal_reservasi" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" required>
                @error('tanggal_reservasi') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="waktu_reservasi" class="form-label">Waktu Reservasi:</label>
                <input type="time" class="form-control" id="waktu_reservasi" name="waktu_reservasi" value="{{ old('waktu_reservasi') }}" required>
                @error('waktu_reservasi') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_layanan" class="form-label">Jenis Layanan:</label>
                <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="{{ old('jenis_layanan') }}" required>
                @error('jenis_layanan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Reservasi:</label>
                <select class="form-control" id="status" name="status">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dikonfirmasi" {{ old('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Reservasi</button>
            <a href="{{ route('reservasis.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection