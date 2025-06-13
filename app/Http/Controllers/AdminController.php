<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Login Methods
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = \App\Models\Admin::where('username', $credentials['username'])->first();

        if (!$admin || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ]);
        }

        session(['admin_logged_in' => true, 'admin_id' => $admin->id]);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);
        return redirect()->route('admin.login.form');
    }

    // Dashboard
    public function dashboard(Request $request)
    {
        $menu = $request->query('menu', 'home');
        $dokters = $menu === 'dokter' ? \App\Models\Dokter::all() : collect();
        $pasiens = $menu === 'pasien' ? \App\Models\Pasien::all() : collect();
        $staffs  = $menu === 'staff'  ? \App\Models\Staff::all()  : collect();
        return view('dashboard.admin', compact('menu', 'dokters', 'pasiens', 'staffs'));
    }

    // Dokter Management
    public function dokterIndex()
    {
        $dokters = Dokter::all();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function dokterEdit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function dokterUpdate(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $dokter->update($validated);
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui');
    }

    public function dokterDestroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus');
    }

    // Pasien Management
    public function pasienIndex()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function pasienEdit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function pasienUpdate(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $pasien->update($validated);
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function pasienDestroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }

    // Staff Management
    public function staffIndex()
    {
        $staffs = Staff::all();
        return view('admin.staff.index', compact('staffs'));
    }

    public function staffEdit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function staffUpdate(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $staff->update($validated);
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui');
    }

    public function staffDestroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil dihapus');
    }
} 