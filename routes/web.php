<?php

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

Route::post('/registrasi-submit', [AuthController::class, 'registrasi'])->name('registrasi.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Sementara tanpa auth biar bisa dites
Route::get('/', [InputAspirasiController::class, 'index'])->name('home');
Route::get('/laporan/{inputAspirasi}/edit', [InputAspirasiController::class, 'edit'])->name('laporan.edit');
Route::put('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'update'])->name('laporan.update');
Route::get('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'show'])->name('laporan.show');
Route::delete('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'destroy'])->name('laporan.destroy');
Route::post('/buat-laporan', [InputAspirasiController::class, 'create'])->name('buat-laporan');