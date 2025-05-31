<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar sumber.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('obats.index_obat', compact('obats'));
    }

    /**
     * Tampilkan formulir untuk membuat sumber baru.
     */
    public function create()
    {
        return view('obats.create_obat');
    }

    /**
     * Simpan sumber yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
    // 1. Validasi Input
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
    ]);

    // 2. Simpan Data Baru ke Database
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

    // 3. Redirect kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('obats.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Menampilkan sumber yang ditentukan.
     */
    public function show(Obat $obat)
    {
        return view('obats.show_obat', compact('obat'));
    }

    /**
     * Menampilkan formulir untuk mengedit sumber yang ditentukan.
     */
    public function edit(Obat $obat)
    {
        return view('obats.edit_obat', compact('obat'));
    }

    /**
     * Perbarui sumber yang ditentukan dalam penyimpanan.
     */
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('obats.index')->with('success', 'Obat berhasil diperbarui!');
    }

    /**
     * Hapus sumber yang ditentukan dari penyimpanan.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obats.index_obat')->with('success', 'Obat berhasil dihapus!');
    }
}