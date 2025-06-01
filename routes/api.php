<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AuthController;

// 🔓 Route publik (tanpa auth)
Route::post('/dokters/register', [DokterController::class, 'store']); // register dokter
Route::get('/dokters', [DokterController::class, 'index']);           // semua dokter
Route::get('/dokters/{id}', [DokterController::class, 'show']);       // detail dokter

// 🔐 Route yang butuh login token Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/dokters/{id}', [DokterController::class, 'update']); // update dokter
    Route::delete('/dokters/{id}', [DokterController::class, 'destroy']); // hapus dokter
});

// 🔐 Autentikasi umum
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
