@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Detail Dokter</h2>
    <p><strong>Nama:</strong> {{ $dokter->nama }}</p>
    <p><strong>Username:</strong> {{ $dokter->username }}</p>
    <p><strong>Email:</strong> {{ $dokter->email }}</p>
    <p><strong>Role:</strong> {{ $dokter->role }}</p>
    <a href="{{ route('dokter.index') }}" class="text-blue-500 mt-4 inline-block">← Kembali ke daftar</a>
</div>
@endsection