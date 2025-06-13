<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Resources\DokterResource;

class DokterController extends Controller
{
    // Tampilkan semua Dokter (API)
    public function index()
    {
        return DokterResource::collection(Dokter::all());
    }

    // Tampilkan detail Dokter (API)
    public function show($id)
    {
        $dokter = Dokter::find($id);
        if (!$dokter) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
        return new DokterResource($dokter);
    }


    #Registrasi Dokter baru
    //public function store(Request $request)
    //{
    //$validator = Validator::make($request->all(), [
    //    'nama'     => 'required|string',
    //    'username' => 'required|string|unique:dokters',
    //    'email'    => 'nullable|email',
    //    'password' => 'required|string|min:6',
    //    'role'     => 'required|string',
    //]);

    //if ($validator->fails()) {
    //    return response()->json($validator->errors(), 422);
    //}

    //$request->merge([
    //    'password' => Hash::make($request->password)
    //]);

    //$dokter = Dokter::create($request->all());

    //return new DokterResource($dokter);
    //}

    #Update informasi Dokter
    //public function update(Request $request, $id)
    //{
    //$dokter = Dokter::find($id);
    //if (!$dokter) {
    //    return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
    //}

    //$validator = Validator::make($request->all(), [
    //    'nama'     => 'sometimes|required|string',
    //    'username' => 'sometimes|required|string|unique:dokters,username,' . $dokter->id,
    //    'email'    => 'nullable|email',
    //    'password' => 'sometimes|required|string|min:6',
    //    'role'     => 'sometimes|required|string',
    //]);

    //if ($validator->fails()) {
    //    return response()->json($validator->errors(), 422);
    //}

    //$dokter->fill($request->except('password'));

    //if ($request->filled('password')) {
    //    $dokter->password = Hash::make($request->password);
    //}

    //$dokter->save();

    //return new DokterResource($dokter);
    //}

    #Hapus Dokter
    //public function destroy($id)
    //{
    //    $dokter = Dokter::find($id);
    //    if (!$dokter) {
    //        return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
    //    }

    //    $dokter->delete();

    //    return response()->json(['message' => 'Dokter berhasil dihapus']);
    //}
}