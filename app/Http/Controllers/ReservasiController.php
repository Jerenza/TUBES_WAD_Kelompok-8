<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Resources\ReservasiResource;

class ReservasiController extends Controller
{
    // Pasien - create
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_reservasi' => 'required|date',
            'waktu_reservasi' => 'required',
        ]);

        $reservasi = Reservasi::create([
            ...$validated,
            'status' => 'pending',
        ]);

        return new ReservasiResource($reservasi);
    }

    // Semua - read
    public function index()
    {
        return ReservasiResource::collection(Reservasi::with(['pasien', 'dokter'])->get());
    }

    // Dokter - update
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->only('status'));
        return new ReservasiResource($reservasi);
    }

    // Dokter - delete
    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();
        return response()->json(['message' => 'Reservasi berhasil dihapus']);
    }
}
