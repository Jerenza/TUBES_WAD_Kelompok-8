@extends('layouts.admin')

@section('content')
<style>
    .edit-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 400px;
        margin: 40px auto;
        border-top: 8px solid #E4002B;
    }
    .edit-title {
        color: #E4002B;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.3rem;
        color: #343a40;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 1.1rem;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .edit-btn {
        background: #E4002B;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.75rem;
        font-weight: bold;
        width: 100%;
        margin-top: 0.5rem;
        transition: background 0.2s;
        font-size: 1.1rem;
    }
    .edit-btn:hover {
        background: #c70025;
    }
    .cancel-btn {
        background: #888;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.75rem;
        font-weight: bold;
        width: 100%;
        margin-top: 0.5rem;
        font-size: 1.1rem;
        margin-left: 0;
    }
    .btn-row {
        display: flex;
        gap: 1rem;
        margin-top: 1.2rem;
    }
    .alert-error {
        background:#ffeaea;
        color:#e4002b;
        border:1px solid #e4002b;
        border-radius:6px;
        padding:10px 15px;
        margin-bottom:18px;
    }
</style>
<div class="edit-card">
    <div class="edit-title">Edit Data Pasien</div>
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom:2px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label class="form-label" for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $pasien->username }}" readonly>
        </div>
        <div>
            <label class="form-label" for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $pasien->nama) }}" required>
        </div>
        <div class="btn-row">
            <button type="submit" class="edit-btn">Simpan Perubahan</button>
            <a href="{{ route('admin.pasien.index') }}" class="cancel-btn" style="text-align:center;line-height:2.2rem;">Batal</a>
        </div>
    </form>
</div>
@endsection 