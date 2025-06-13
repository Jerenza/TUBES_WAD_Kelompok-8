@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Detail Staff</h2>
    <p><strong>Nama:</strong> {{ $staff->nama }}</p>
    <p><strong>Username:</strong> {{ $staff->username }}</p>
    <p><strong>Email:</strong> {{ $staff->email }}</p>
    <p><strong>Role:</strong> {{ $staff->role }}</p>
    <a href="{{ route('staff.index') }}" class="text-blue-500 mt-4 inline-block">← Kembali ke daftar</a>
</div>
@endsection 