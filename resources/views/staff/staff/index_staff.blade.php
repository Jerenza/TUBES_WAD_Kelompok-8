@extends('staff.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Staff</h1>
    <a href="{{ route('staff.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">+ Tambah Staff</a>
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
            @foreach($staffs as $staff)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $staff->nama }}</td>
                <td class="border px-4 py-2">{{ $staff->username }}</td>
                <td class="border px-4 py-2">{{ $staff->email }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('staff.show', $staff->id) }}" class="text-blue-500">Lihat</a> |
                    <a href="{{ route('staff.edit', $staff->id) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
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
