@extends('layouts.dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pemeriksaan Baru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.pemeriksaan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="pasien_id">Pasien</label>
                            <select name="pasien_id" id="pasien_id" class="form-control @error('pasien_id') is-invalid @enderror" required>
                                <option value="">Pilih Pasien</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                        {{ $pasien->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pasien_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pemeriksaan">Tanggal Pemeriksaan</label>
                            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" 
                                class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror" 
                                value="{{ old('tanggal_pemeriksaan') }}" required>
                            @error('tanggal_pemeriksaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diagnosa">Diagnosa</label>
                            <textarea name="diagnosa" id="diagnosa" rows="3" 
                                class="form-control @error('diagnosa') is-invalid @enderror" required>{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" 
                                class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 