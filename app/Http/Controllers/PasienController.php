<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Http\Resources\PasienResource;

class PasienController extends Controller
{
    // Tampilkan semua Pasien (API)
    public function index()
    {
        return PasienResource::collection(Pasien::all());
    }

    // Tampilkan detail Pasien (API)
    public function show($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }
        return new PasienResource($pasien);
    }
}