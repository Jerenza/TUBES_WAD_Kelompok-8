@extends('staff.app')

@section('content')
<div class="container mt-4">
    <h2>Staff List</h2>
    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-2">Tambah Staff</a>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
        @foreach($staff as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->jabatan }}</td>
            <td>
                <a href="{{ route('staff.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                <a href="{{ route('staff.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('staff.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
