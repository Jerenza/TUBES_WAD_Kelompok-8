<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffWebController extends Controller
{
    // List Staff
    public function index()
    {
        $staffs = Staff::all();
        return view('staff.staff.index_staff', compact('staffs'));
    }

    // Tampilkan form registrasi staff
    public function create()
    {
        return view('staff.create');
    }

    // Registrasi Staff
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:staff',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'staff';

        Staff::create($validated);

        return redirect()->route('staff.login.form')->with('success', 'Registrasi berhasil!');
    }

    // Detail Staff
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    // Edit Staff
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    // Update Staff
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:staff,username,' . $staff->id,
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $staff->update($validated);

        return redirect()->route('staff.show', $staff->id)->with('success', 'Data staff berhasil diupdate!');
    }

    // Hapus Staff
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.staff.index_staff')->with('success', 'Staff berhasil dihapus!');
    }

    // Login Staff
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = Staff::where('username', $credentials['username'])->first();

        if (!$staff || !Hash::check($credentials['password'], $staff->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.']);
        }

        session([
            'staff_id' => $staff->id,
            'staff_nama' => $staff->nama
        ]);

        return redirect()->route('staff.Dashboard.staff');
    }

    // Logout Staff
    public function logout()
    {
        session()->forget(['staff_id', 'staff_nama']);
        return redirect()->route('staff.login.form')->with('success', 'Logout berhasil!');
    }
}
