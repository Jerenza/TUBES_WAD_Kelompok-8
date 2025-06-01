<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Resources\StaffResource;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function home()
    {
    $staffs = Staff::all();
    return view('home', compact('staffs'));
    }

    public function index()
    {
        $staffs = Staff::all();
        return StaffResource::collection($staffs);
    }

    public function show($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff tidak ditemukan'], 404);
        }
        return new StaffResource($staff);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|string',
            'username' => 'required|string|unique:staffs',
            'email'    => 'nullable|email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $staff = Staff::create($request->all());

        return new StaffResource($staff);
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama'     => 'sometimes|required|string',
            'username' => 'sometimes|required|string|unique:staffs,username,' . $staff->id,
            'email'    => 'nullable|email',
            'password' => 'sometimes|required|string|min:6',
            'role'     => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $staff->fill($request->except('password'));

        if ($request->has('password')) {
            $staff->password = $request->password;
        }

        $staff->save();

        return new StaffResource($staff);
    }

    
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json(['message' => 'Staff berhasil dihapus']);
    }
}
