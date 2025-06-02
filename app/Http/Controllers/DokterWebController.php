<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterWebController extends Controller
{
    // List Dokter
    public function index()
    {
        $dokters = Dokter::all();
        return view('dokter.index', compact('dokters'));
    }

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
            'email' => 'nullable|email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'dokter';

        Dokter::create($validated);

        return redirect()->route('dokter.login.form')->with('success', 'Registrasi berhasil!');
    }

    // Detail Dokter
    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    // Edit Dokter
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }

    // Update dokter
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:dokters,username,' . $dokter->id,
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $dokter->update($validated);

        return redirect()->route('dokter.show', $dokter->id)->with('success', 'Data dokter berhasil diupdate!');
    }

    // Hapus dokter
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus!');
    }

    // login dokter
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $dokter = Dokter::where('username', $credentials['username'])->first();

        if (!$dokter || !Hash::check($credentials['password'], $dokter->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.']);
        }

        session(['dokter_id' => $dokter->id]);
        return redirect()->route('dashboard.dokter');
    }

    // logout dokter
    public function logout()
    {
        session()->forget('dokter_id');
        return redirect()->route('dokter.login.form')->with('success', 'Logout berhasil!');
    }
}