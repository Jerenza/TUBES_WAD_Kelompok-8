<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterWebController;

Route::get('/dokter/login', fn() => view('auth.login_dokter'))->name('dokter.login.form');
Route::post('/dokter/login', [DokterWebController::class, 'login'])->name('dokter.login');
Route::post('/dokter/logout', [DokterWebController::class, 'logout'])->name('dokter.logout');

Route::get('/dokter/register', fn() => view('auth.register_dokter'))->name('dokter.register.form');
Route::post('/dokter/register', [DokterWebController::class, 'store'])->name('dokter.register');

Route::resource('dokter', DokterWebController::class);

Route::get('/dashboard/dokter', fn() => view('dashboard.dokter'))->name('dashboard.dokter');
Route::get('/dashboard/pasien', fn() => view('dashboard.pasien'))->name('dashboard.pasien');
Route::get('/dashboard/staff', fn() => view('dashboard.staff'))->name('dashboard.staff');

Route::get('/login/pasien', fn() => view('auth.login_pasien'))->name('login.pasien');
Route::get('/login/staff', fn() => view('auth.login_staff'))->name('login.staff');
Route::get('/register/pasien', fn() => view('auth.register_pasien'))->name('register.pasien');
Route::get('/register/staff', fn() => view('auth.register_staff'))->name('register.staff');

Route::get('/', function () {
    return view('welcome');
});