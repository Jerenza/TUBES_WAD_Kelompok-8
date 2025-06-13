@extends('layouts.admin')

@section('content')
<style>
    :root {
        --telkomedika-red: #E4002B;
        --telkomedika-green: #28a745;
        --telkomedika-green-dark: #218838;
    }
    .admin-container { padding: 2rem; }
    .admin-title { color: var(--telkomedika-red); font-size: 2rem; font-weight: bold; margin-bottom: 2rem; }
    .table thead th { background: var(--telkomedika-red); color: #fff; font-weight: 500; border: none; }
    .table td { vertical-align: middle; }
    .aksi-cell { display: flex; justify-content: center; align-items: center; gap: 0.5rem; height: 100%; }
    .btn-action { display: inline-block; padding: 0.45rem 1.1rem; font-size: 1rem; font-weight: 500; border: none; border-radius: 6px; cursor: pointer; transition: background 0.18s, color 0.18s, box-shadow 0.18s; box-shadow: 0 2px 8px rgba(228,0,43,0.07); outline: none; text-decoration: none; }
    .btn-edit { background: var(--telkomedika-green); color: #fff; }
    .btn-edit:hover { background: var(--telkomedika-green-dark); color: #fff; }
    .btn-delete { background: var(--telkomedika-red); color: #fff; }
    .btn-delete:hover { background: #b8001f; color: #fff; }
    .alert { border-radius: 8px; margin-bottom: 1.5rem; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                if(!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
<div class="admin-container">
    <h1 class="admin-title">Pengelolaan Pasien</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table style="width:100%;margin-top:1rem;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden;">
            <thead style="background:#E4002B;color:#fff;">
                <tr>
                    <th style="padding:10px;">Username</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasiens as $pasien)
                    <tr>
                        <td style="padding:10px;">{{ $pasien->username }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td class="aksi-cell">
                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn-action btn-edit">Edit</a>
                            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 