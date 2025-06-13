@extends('layouts.app')

@section('content')
    <div class="container"> {{-- Pastikan ada div dengan class container --}}
        <h2>Daftar Obat</h2>
        <a href="{{ route('obats.create') }}" class="btn btn-primary mb-3">Tambah Obat Baru</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered"> {{-- Penting: class table dan table-bordered --}}
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $obat)
                    <tr>
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->jenis }}</td>
                        <td>Rp. {{ number_format($obat->harga, 2, ',', '.') }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td>
                            <a href="{{ route('obats.show', $obat->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('obats.edit', $obat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('obats.destroy', $obat->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection