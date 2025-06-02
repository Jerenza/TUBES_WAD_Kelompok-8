@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pasien</h1>
    <a href="{{ route('pasien.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">+ Tambah Pasien</a>
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Username</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasiens as $pasien)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $pasien->nama }}</td>
                <td class="border px-4 py-2">{{ $pasien->username }}</td>
                <td class="border px-4 py-2">{{ $pasien->email }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('pasien.show', $pasien->id) }}" class="text-blue-500">Lihat</a> |
                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection