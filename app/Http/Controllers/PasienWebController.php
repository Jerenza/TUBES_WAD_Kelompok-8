<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienWebController extends Controller
{
    // Tampilkan form registrasi pasien
    public function create()
    {
        return view('pasien.create');
    }

    // Registrasi Pasien
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:pasiens',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pasien';

        Pasien::create($validated);

        return redirect()->route('pasien.login.form')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pasien = Pasien::where('username', $credentials['username'])->first();

        if (!$pasien || !Hash::check($credentials['password'], $pasien->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.']);
        }

        session([
            'pasien_id' => $pasien->id,
            'pasien_nama' => $pasien->nama
        ]);

        return redirect()->route('dashboard.pasien');
    }

    public function logout()
    {
        session()->forget(['pasien_id', 'pasien_nama']);
        return redirect()->route('pasien.login.form')->with('success', 'Logout berhasil!');
    }

    public function dashboard(Request $request)
    {
        $menu = $request->query('menu', 'home');
        $pasien = \App\Models\Pasien::find(session('pasien_id'));
        $reservasi = collect();
        $pemeriksaan = collect();
        if ($menu === 'reservasi') {
            $reservasi = \App\Models\Reservasi::with(['pasien', 'dokter'])
                ->orderBy('tanggal_reservasi')
                ->orderBy('waktu_reservasi')
                ->get();
        } elseif ($menu === 'pemeriksaan') {
            $pemeriksaan = \App\Models\Pemeriksaan::with(['dokter', 'pasien'])
                ->where('pasien_id', $pasien->id)
                ->orderBy('tanggal_pemeriksaan', 'desc')
                ->get();
        }
        return view('dashboard.pasien', compact('menu', 'pasien', 'reservasi', 'pemeriksaan'));
    }
} 