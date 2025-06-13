
@extends('layouts.staff')

@section('content')
    @if($menu == 'home')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Selamat Datang, {{ session('staff_nama') }}!</h1>
        <p style="font-size:1.1rem;color:#555;margin-bottom:2.5rem;">Gunakan menu di samping untuk mengelola data obat.</p>
        <div style="display:flex;gap:2rem;flex-wrap:wrap;">
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:1.5rem 2.5rem;min-width:180px;text-align:center;">
                <div style="font-size:2.2rem;font-weight:bold;color:#E4002B;">{{ \App\Models\Obat::count() }}</div>
                <div style="color:#888;font-size:1.1rem;">Obat</div>
            </div>
        </div>
    @elseif($menu == 'obat')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Pengelolaan Obat</h1>
        @include('staff.obat.index', ['obats' => $obats])
    @endif
@endsection