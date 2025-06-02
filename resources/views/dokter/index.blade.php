@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Dokter</h1>
    <a href="{{ route('dokter.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">+ Tambah Dokter</a>
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
            @foreach($dokters as $dokter)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $dokter->nama }}</td>
                <td class="border px-4 py-2">{{ $dokter->username }}</td>
                <td class="border px-4 py-2">{{ $dokter->email }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('dokter.show', $dokter->id) }}" class="text-blue-500">Lihat</a> |
                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
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