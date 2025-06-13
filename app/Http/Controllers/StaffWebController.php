<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffWebController extends Controller
{
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
            'username' => 'required|string|unique:staffs',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'staff';

        \App\Models\Staff::create($validated);

        return redirect()->route('staff.login.form')->with('success', 'Registrasi berhasil!');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login_staff');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $staff = \App\Models\Staff::where('username', $request->username)->first();
        if ($staff && \Illuminate\Support\Facades\Hash::check($request->password, $staff->password)) {
            session([
                'staff_id' => $staff->id,
                'staff_nama' => $staff->nama,
                'staff_username' => $staff->username,
            ]);
            return redirect()->route('dashboard.staff');
        }
        return back()->with('error', 'Username atau password salah');
    }

    // Logout
    public function logout()
    {
        session()->forget(['staff_id', 'staff_nama', 'staff_email']);
        return redirect()->route('staff.login.form');
    }

    // Dashboard
    public function dashboard(Request $request)
    {
        if (!session()->has('staff_id')) {
            return redirect()->route('staff.login.form')->with('error', 'Silahkan login terlebih dahulu!');
        }

        $menu = $request->query('menu', 'home');
        $obats = $menu === 'obat' ? Obat::all() : collect();

        return view('dashboard.staff', compact('menu', 'obats'));
    }
}