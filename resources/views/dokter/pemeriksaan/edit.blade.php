@extends('layouts.dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pemeriksaan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.pemeriksaan.update', $pemeriksaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="pasien_id">Pasien</label>
                            <input type="text" class="form-control" value="{{ $pemeriksaan->pasien->nama }}" readonly>
                            <input type="hidden" name="pasien_id" value="{{ $pemeriksaan->pasien_id }}">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pemeriksaan">Tanggal Pemeriksaan</label>
                            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" 
                                class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror" 
                                value="{{ old('tanggal_pemeriksaan', $pemeriksaan->tanggal_pemeriksaan) }}" required>
                            @error('tanggal_pemeriksaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diagnosa">Diagnosa</label>
                            <textarea name="diagnosa" id="diagnosa" rows="3" 
                                class="form-control @error('diagnosa') is-invalid @enderror" required>{{ old('diagnosa', $pemeriksaan->diagnosa) }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" 
                                class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $pemeriksaan->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 