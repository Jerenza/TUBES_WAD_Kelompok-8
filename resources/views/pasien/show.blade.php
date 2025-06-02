@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Detail Pasien</h2>
    <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
    <p><strong>Username:</strong> {{ $pasien->username }}</p>
    <p><strong>Email:</strong> {{ $pasien->email }}</p>
    <p><strong>Role:</strong> {{ $pasien->role }}</p>
    <a href="{{ route('pasien.index') }}" class="text-blue-500 mt-4 inline-block">← Kembali ke daftar</a>
</div>
@endsection