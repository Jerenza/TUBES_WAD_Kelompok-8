@extends('layouts.dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Reservasi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservasi as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->pasien->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d/m/Y') }}</td>
                                    <td>{{ $item->waktu_reservasi }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'selesai' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('reservasi.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ $item->status == 'selesai' ? 'pending' : 'selesai' }}">
                                            <button type="submit" class="btn btn-sm {{ $item->status == 'selesai' ? 'btn-warning' : 'btn-success' }}">
                                                {{ $item->status == 'selesai' ? 'Batalkan Selesai' : 'Tandai Selesai' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('reservasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada jadwal reservasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 