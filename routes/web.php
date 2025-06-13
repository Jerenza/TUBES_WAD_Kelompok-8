<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterWebController;
use App\Http\Controllers\PasienWebController;
use App\Http\Controllers\StaffWebController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthDokter;
use App\Http\Middleware\AuthStaff;
use App\Http\Middleware\AuthPasien;
use App\Http\Middleware\AuthAdmin;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes for Admin
Route::prefix('admin')->group(function () {
    // Public Routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware([AuthAdmin::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Dokter Management
        Route::get('/dashboard/dokter', [AdminController::class, 'dokterIndex'])->name('admin.dokter.index');
        Route::get('/dashboard/dokter/{id}/edit', [AdminController::class, 'dokterEdit'])->name('admin.dokter.edit');
        Route::put('/dashboard/dokter/{id}', [AdminController::class, 'dokterUpdate'])->name('admin.dokter.update');
        Route::delete('/dashboard/dokter/{id}', [AdminController::class, 'dokterDestroy'])->name('admin.dokter.destroy');
        // Pasien Management
        Route::get('/dashboard/pasien', [AdminController::class, 'pasienIndex'])->name('admin.pasien.index');
        Route::get('/dashboard/pasien/{id}/edit', [AdminController::class, 'pasienEdit'])->name('admin.pasien.edit');
        Route::put('/dashboard/pasien/{id}', [AdminController::class, 'pasienUpdate'])->name('admin.pasien.update');
        Route::delete('/dashboard/pasien/{id}', [AdminController::class, 'pasienDestroy'])->name('admin.pasien.destroy');
        // Staff Management
        Route::get('/dashboard/staff', [AdminController::class, 'staffIndex'])->name('admin.staff.index');
        Route::get('/dashboard/staff/{id}/edit', [AdminController::class, 'staffEdit'])->name('admin.staff.edit');
        Route::put('/dashboard/staff/{id}', [AdminController::class, 'staffUpdate'])->name('admin.staff.update');
        Route::delete('/dashboard/staff/{id}', [AdminController::class, 'staffDestroy'])->name('admin.staff.destroy');
    });
});

// Authentication Routes for Dokter
Route::prefix('dokter')->group(function () {
    // Public Routes
    Route::get('/login', fn() => view('auth.login_dokter'))->name('dokter.login.form');
    Route::post('/login', [DokterWebController::class, 'login'])->name('dokter.login');
    Route::post('/logout', [DokterWebController::class, 'logout'])->name('dokter.logout');
    
    Route::get('/register', [DokterWebController::class, 'create'])->name('dokter.create');
    Route::post('/register', [DokterWebController::class, 'store'])->name('dokter.store');
    
    // Protected Dokter Routes
    Route::middleware([AuthDokter::class])->group(function () {
        Route::get('/dashboard', [DokterWebController::class, 'dashboard'])->name('dashboard.dokter');
        Route::get('/profile', [DokterWebController::class, 'show'])->name('dokter.show');
        Route::get('/profile/edit', [DokterWebController::class, 'edit'])->name('dokter.edit');
        Route::put('/profile', [DokterWebController::class, 'update'])->name('dokter.update');
        Route::delete('/profile', [DokterWebController::class, 'destroy'])->name('dokter.destroy');
        
        // Jadwal Routes
        Route::get('/jadwal', [ReservasiController::class, 'jadwalDokter'])->name('dokter.jadwal');
        
        // Pemeriksaan Routes
        Route::get('/pemeriksaan', [PemeriksaanController::class, 'indexDokter'])->name('dokter.pemeriksaan.index');
        Route::get('/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('dokter.pemeriksaan.create');
        Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('dokter.pemeriksaan.store');
        Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('dokter.pemeriksaan.edit');
        Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('dokter.pemeriksaan.update');
        Route::delete('/pemeriksaan/{id}', [PemeriksaanController::class, 'destroy'])->name('dokter.pemeriksaan.destroy');
    });
});

// Authentication Routes for Staff
// Public Routes for Staff
Route::prefix('staff')->group(function () {
    Route::get('/login', fn() => view('auth.login_staff'))->name('staff.login.form');
    Route::post('/login', [StaffWebController::class, 'login'])->name('staff.login');
    Route::post('/logout', [StaffWebController::class, 'logout'])->name('staff.logout');
    Route::get('/register', [StaffWebController::class, 'create'])->name('staff.create');
    Route::post('/register', [StaffWebController::class, 'store'])->name('staff.store');

    Route::middleware(['staff.auth'])->group(function () {
    Route::get('/dashboard', [StaffWebController::class, 'dashboard'])->name('dashboard.staff');
    Route::get('/obat', [ObatController::class, 'index'])->name('staff.obat.index');
    Route::post('/logout', [StaffWebController::class, 'logout'])->name('staff.logout');
    });
});

// Authentication Routes for Pasien
Route::prefix('pasien')->group(function () {
    // Public Routes
    Route::get('/login', fn() => view('auth.login_pasien'))->name('pasien.login.form');
    Route::post('/login', [PasienWebController::class, 'login'])->name('pasien.login');
    Route::post('/logout', [PasienWebController::class, 'logout'])->name('pasien.logout');
    Route::get('/register', [PasienWebController::class, 'create'])->name('pasien.create');
    Route::post('/register', [PasienWebController::class, 'store'])->name('pasien.store');
    // Protected Pasien Routes
    Route::middleware([AuthPasien::class])->group(function () {
        Route::get('/dashboard', [PasienWebController::class, 'dashboard'])->name('dashboard.pasien');
    });
});

// Common Resource Routes
Route::middleware([AuthDokter::class, AuthStaff::class])->group(function () {
    Route::resource('reservasi', ReservasiController::class);
});

Route::resource('obats', ObatController::class);
