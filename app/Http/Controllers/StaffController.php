<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Resources\StaffResource;

class StaffController extends Controller
{
    // Tampilkan semua Staff (API)
    public function index()
    {
        return StaffResource::collection(Staff::all());
    }

    // Tampilkan detail Staff (API)
    public function show($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff tidak ditemukan'], 404);
        }
        return new StaffResource($staff);
    }
}