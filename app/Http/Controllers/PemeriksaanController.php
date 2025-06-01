<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Http\Resources\PemeriksaanResource;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PemeriksaanResource::collection(Pemeriksaan::with(['dokter', 'pasien'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'pasien_id' => 'required|exists:pasiens,id',
            'diagnosa' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $pemeriksaan = Pemeriksaan::create($validated);
        return new PemeriksaanResource($pemeriksaan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new PemeriksaanResource(Pemeriksaan::with(['dokter', 'pasien'])->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->update($request->only(['diagnosa', 'catatan', 'tanggal_pemeriksaan']));
        return new PemeriksaanResource($pemeriksaan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pemeriksaan::findOrFail($id)->delete();
        return response()->json(['message' => 'Pemeriksaan dihapus']);
    }
}
