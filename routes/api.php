<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DokterController, PasienController, StaffController};

// API Dokter (hanya index & show)
Route::get('/dokters', [DokterController::class, 'index']);
Route::get('/dokters/{id}', [DokterController::class, 'show']);

// API Pasien (jika ada)
Route::get('/pasiens', [PasienController::class, 'index']);
Route::get('/pasiens/{id}', [PasienController::class, 'show']);

// API Staff (jika ada)
Route::get('/staffs', [StaffController::class, 'index']);
Route::get('/staffs/{id}', [StaffController::class, 'show']);