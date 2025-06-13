<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Http\Resources\PemeriksaanResource;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PemeriksaanResource::collection(Pemeriksaan::with(['dokter', 'pasien'])->get());
    }

    // Dokter - melihat semua pemeriksaan yang dia lakukan
    public function indexDokter()
    {
        $dokter_id = Auth::guard('dokter')->id();
        $pemeriksaan = Pemeriksaan::with(['dokter', 'pasien'])
            ->where('dokter_id', $dokter_id)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();
        
        return view('dokter.pemeriksaan.index', compact('pemeriksaan'));
    }

    // Pasien - melihat semua pemeriksaan miliknya
    public function indexPasien()
    {
        $pasien_id = Auth::guard('pasien')->id();
        $pemeriksaan = Pemeriksaan::with(['dokter', 'pasien'])
            ->where('pasien_id', $pasien_id)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();
        
        return view('pasien.pemeriksaan.index', compact('pemeriksaan'));
    }

    public function store(Request $request)
    {
        // Cek apakah pasien login
        if (session('pasien_id')) {
            $validated = $request->validate([
                'dokter_id' => 'required|string', // nama dokter
                'diagnosa' => 'required|string',
                'catatan' => 'nullable|string',
                'tanggal_pemeriksaan' => 'required|date',
            ]);
            $pemeriksaan = Pemeriksaan::create([
                'pasien_id' => session('pasien_id'),
                'dokter_id' => $validated['dokter_id'],
                'diagnosa' => $validated['diagnosa'],
                'catatan' => $validated['catatan'],
                'tanggal_pemeriksaan' => $validated['tanggal_pemeriksaan'],
            ]);
            return redirect()->back()->with('success', 'Pemeriksaan berhasil ditambahkan');
        }
        // Jika dokter login, gunakan logic lama
        $validated = $request->validate([
            'pasien_id' => 'required',
            'diagnosa' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);
        $pemeriksaan = Pemeriksaan::create([
            ...$validated,
            'dokter_id' => Auth::guard('dokter')->id(),
        ]);
        return redirect()->route('dokter.pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.pemeriksaan.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new PemeriksaanResource(Pemeriksaan::with(['dokter', 'pasien'])->findOrFail($id));
    }

    // Dokter - form edit pemeriksaan
    public function edit($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        
        // Cek apakah pemeriksaan ini milik dokter yang sedang login
        if ($pemeriksaan->dokter_id !== Auth::guard('dokter')->id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        return view('dokter.pemeriksaan.edit', compact('pemeriksaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        
        // Cek apakah pemeriksaan ini milik dokter yang sedang login
        if ($pemeriksaan->dokter_id !== Auth::guard('dokter')->id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $validated = $request->validate([
            'diagnosa' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $pemeriksaan->update($validated);
        return redirect()->route('dokter.pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        
        // Cek apakah pemeriksaan ini milik dokter yang sedang login
        if ($pemeriksaan->dokter_id !== Auth::guard('dokter')->id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $pemeriksaan->delete();
        return redirect()->back()->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}
