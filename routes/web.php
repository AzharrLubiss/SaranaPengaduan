<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputAspirasiController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login-submit', [AuthController::class, 'login'])->name('login.submit');

Route::get('/registrasi', function () {
    return view('auth.register');
})->name('registrasi');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [AspirasiController::class, 'index'])->name('home');

    // Edit Laporan
    Route::get('/laporan/{inputAspirasi}/edit', [InputAspirasiController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'update'])->name('laporan.update');

});