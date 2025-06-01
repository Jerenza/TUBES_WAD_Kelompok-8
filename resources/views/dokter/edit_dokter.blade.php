@extends('Layout.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Edit Dokter</h2>

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="nama" value="{{ $dokter->nama }}" class="w-full mb-3 p-2 border rounded">
        <input type="text" name="username" value="{{ $dokter->username }}" class="w-full mb-3 p-2 border rounded">
        <input type="email" name="email" value="{{ $dokter->email }}" class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Isi jika ingin ubah password" class="w-full mb-3 p-2 border rounded">
        <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded">Update</button>
    </form>
</div>
@endsection