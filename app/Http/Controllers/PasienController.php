<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    // Menampilkan semua data pasien
    public function index()
    {
        $pasiens = Pasien::all();
        return response()->json($pasiens);
    }

    // Menampilkan 1 data pasien berdasarkan ID
    public function show($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        return response()->json($pasien);
    }

    // Menyimpan data pasien baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:pasiens,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        // Hash password secara manual (bisa juga lewat mutator di model)
        $validated['password'] = Hash::make($validated['password']);

        $pasien = Pasien::create($validated);

        return response()->json($pasien, 201);
    }

    // Mengupdate data pasien
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|unique:pasiens,username,' . $id,
            'password' => 'sometimes|nullable|string|min:6',
            'role' => 'sometimes|required|string'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pasien->update($validated);

        return response()->json($pasien);
    }

    // Menghapus data pasien
    public function destroy($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $pasien->delete();

        return response()->json(['message' => 'Pasien berhasil dihapus']);
    }
}