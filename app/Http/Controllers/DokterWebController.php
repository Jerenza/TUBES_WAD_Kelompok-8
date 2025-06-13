<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterWebController extends Controller
{
    // Tampilkan form registrasi dokter
    public function create()
    {
        return view('dokter.create');
    }

    // Registrasi Dokter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:dokters',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = \Hash::make($validated['password']);
        $validated['role'] = 'dokter';

        \App\Models\Dokter::create($validated);

        return redirect()->route('dokter.login.form')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $dokter = \App\Models\Dokter::where('username', $credentials['username'])->first();

        if (!$dokter || !\Hash::check($credentials['password'], $dokter->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.']);
        }

        session([
            'dokter_id' => $dokter->id,
            'dokter_nama' => $dokter->nama
        ]);

        return redirect()->route('dashboard.dokter');
    }

    public function logout()
    {
        session()->forget(['dokter_id', 'dokter_nama']);
        return redirect()->route('dokter.login.form')->with('success', 'Logout berhasil!');
    }

    public function dashboard(Request $request)
    {
        $menu = $request->query('menu', 'home');
        $dokter = \App\Models\Dokter::find(session('dokter_id'));
        $reservasi = collect();
        $pemeriksaan = collect();
        if ($menu === 'jadwal') {
            $reservasi = \App\Models\Reservasi::with(['pasien', 'dokter'])
                ->where('dokter_id', $dokter->id)
                ->orderBy('tanggal_reservasi')
                ->orderBy('waktu_reservasi')
                ->get();
        } elseif ($menu === 'laporan') {
            $pemeriksaan = \App\Models\Pemeriksaan::with(['dokter', 'pasien'])
                ->where('dokter_id', $dokter->id)
                ->orderBy('tanggal_pemeriksaan', 'desc')
                ->get();
        }
        return view('dashboard.dokter', compact('menu', 'dokter', 'reservasi', 'pemeriksaan'));
    }
}