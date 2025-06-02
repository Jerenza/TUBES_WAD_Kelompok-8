<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

    //pasien
Route::controller(UserController::class)
    ->prefix('pasien')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'index')->name('pasien');
        Route::get('/create/{menu_code}', 'create')->name('pasien.create');
        Route::post('/store', 'store')->name('pasien.store');
        Route::get('/show/{id}', 'show')->name('pasien.show');
        Route::get('/edit/{id}', 'edit')->name('pasien.edit');
        Route::put('/edit/{id}', 'update')->name('pasien.update');
        Route::delete('/destroy/{id}', 'destroy')->name('pasien.destroy');
    });
});
