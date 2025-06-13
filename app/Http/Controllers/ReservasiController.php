<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Resources\ReservasiResource;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    // Pasien - create
    public function store(Request $request)
    {
        // Cek apakah pasien login
        if (session('pasien_id')) {
            $validated = $request->validate([
                'dokter_id' => 'required|string', // nama dokter
                'tanggal_reservasi' => 'required|date',
                'waktu_reservasi' => 'required',
            ]);
            $reservasi = Reservasi::create([
                'pasien_id' => session('pasien_id'),
                'dokter_id' => $validated['dokter_id'],
                'tanggal_reservasi' => $validated['tanggal_reservasi'],
                'waktu_reservasi' => $validated['waktu_reservasi'],
                'status' => 'pending',
            ]);
            return redirect()->back()->with('success', 'Reservasi berhasil ditambahkan');
        }
        // Jika dokter login (atau staff), gunakan validasi dan logic lama
        $validated = $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'tanggal_reservasi' => 'required|date',
            'waktu_reservasi' => 'required',
        ]);
        $reservasi = Reservasi::create([
            ...$validated,
            'status' => 'pending',
        ]);
        return redirect()->back()->with('success', 'Reservasi berhasil ditambahkan');
    }

    // Dokter - melihat jadwal reservasi miliknya
    public function jadwalDokter()
    {
        $dokter_id = Auth::guard('dokter')->id();
        $reservasi = Reservasi::with(['pasien', 'dokter'])
            ->where('dokter_id', $dokter_id)
            ->orderBy('tanggal_reservasi')
            ->orderBy('waktu_reservasi')
            ->get();
        
        return view('dokter.jadwal', compact('reservasi'));
    }

    // Pasien - melihat jadwal reservasi miliknya
    public function jadwalPasien()
    {
        $pasien_id = Auth::guard('pasien')->id();
        $reservasi = Reservasi::with(['pasien', 'dokter'])
            ->where('pasien_id', $pasien_id)
            ->orderBy('tanggal_reservasi')
            ->orderBy('waktu_reservasi')
            ->get();
        
        return view('pasien.jadwal', compact('reservasi'));
    }

    // Dokter - update status reservasi
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        // Cek apakah reservasi ini milik dokter yang sedang login
        if ($reservasi->dokter_id !== Auth::guard('dokter')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:selesai,pending'
        ]);

        $reservasi->update($validated);
        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui');
    }

    // Dokter - delete reservasi
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        // Cek apakah reservasi ini milik dokter yang sedang login
        if ($reservasi->dokter_id !== Auth::guard('dokter')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservasi->delete();
        return redirect()->back()->with('success', 'Reservasi berhasil dihapus');
    }
}
