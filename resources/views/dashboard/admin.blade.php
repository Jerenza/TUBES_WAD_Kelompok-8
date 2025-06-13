@extends('layouts.admin')

@section('content')
    @if($menu == 'home')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Selamat Datang, Admin!</h1>
        <p style="font-size:1.1rem;color:#555;margin-bottom:2.5rem;">Gunakan menu di samping untuk mengelola data dokter, pasien, dan staff.</p>
        <div style="display:flex;gap:2rem;flex-wrap:wrap;">
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:1.5rem 2.5rem;min-width:180px;text-align:center;">
                <div style="font-size:2.2rem;font-weight:bold;color:#E4002B;">{{ \App\Models\Dokter::count() }}</div>
                <div style="color:#888;font-size:1.1rem;">Dokter</div>
            </div>
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:1.5rem 2.5rem;min-width:180px;text-align:center;">
                <div style="font-size:2.2rem;font-weight:bold;color:#E4002B;">{{ \App\Models\Pasien::count() }}</div>
                <div style="color:#888;font-size:1.1rem;">Pasien</div>
            </div>
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:1.5rem 2.5rem;min-width:180px;text-align:center;">
                <div style="font-size:2.2rem;font-weight:bold;color:#E4002B;">{{ \App\Models\Staff::count() }}</div>
                <div style="color:#888;font-size:1.1rem;">Staff</div>
            </div>
        </div>
    @elseif($menu == 'dokter')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Pengelolaan Dokter</h1>
        @include('admin.dokter.index', ['dokters' => $dokters])
    @elseif($menu == 'pasien')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Pengelolaan Pasien</h1>
        @include('admin.pasien.index', ['pasiens' => $pasiens])
    @elseif($menu == 'staff')
        <h1 style="color:#E4002B;font-size:2rem;font-weight:bold;margin-bottom:1.5rem;">Pengelolaan Staff</h1>
        @include('admin.staff.index', ['staffs' => $staffs])
    @endif
@endsection 