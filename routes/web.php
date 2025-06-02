<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffWebController;

Route::get('/staff/login', fn() => view('staff.auth.login_staff'))->name('staff.login.form');
Route::post('/staff/login', [StaffWebController::class, 'login'])->name('staff.login');
Route::post('/staff/logout', [StaffWebController::class, 'logout'])->name('staff.logout');

Route::get('/staff/register', fn() => view('auth.register_staff'))->name('staff.register.form');
Route::post('/staff/register', [StaffWebController::class, 'store'])->name('staff.register');

Route::resource('staff', StaffWebController::class);

Route::get('/dashboard/dokter', fn() => view('dashboard.dokter'))->name('dashboard.dokter');
Route::get('/dashboard/pasien', fn() => view('dashboard.pasien'))->name('dashboard.pasien');
Route::get('/dashboard/staff', fn() => view('staff.Dashboard.staff'))->name('staff.Dashboard.staff');

Route::get('/login/pasien', fn() => view('auth.login_pasien'))->name('login.pasien');
Route::get('/login/staff', fn() => view('staff.auth.login_staff'))->name('login.staff');
Route::get('/register/pasien', fn() => view('auth.register_pasien'))->name('register.pasien');
Route::get('/register/staff', fn() => view('auth.register_staff'))->name('register.staff');

Route::get('/', function () {
    return view('welcome');
});
