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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/test-login', function () {
    $user = \App\Models\User::first();
    auth()->login($user);
    session()->save();
    return redirect()->route('home');
});

// Sementara tanpa auth biar bisa dites
Route::get('/', [AspirasiController::class, 'index'])->name('home');
Route::get('/laporan/{inputAspirasi}/edit', [InputAspirasiController::class, 'edit'])->name('laporan.edit');
Route::put('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'update'])->name('laporan.update');