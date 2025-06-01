@extends('Layout.app')

@section('content')
<div class="max-w-md mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Login Dokter</h2>

    <form action="{{ route('dokter.login') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" required>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Login</button>
    </form>
</div>
@endsection