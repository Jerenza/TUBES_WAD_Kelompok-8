@extends('Layout.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Tambah Dokter Baru</h2>

    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 border rounded" required>
        <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 border rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" required>
        <input type="hidden" name="role" value="dokter">
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Simpan</button>
    </form>
</div>
@endsection