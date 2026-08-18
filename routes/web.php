<?php

use App\Http\Controllers\AdminController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/', [InputAspirasiController::class, 'index'])->name('home');

    //bikin laporan
    Route::post('/buat-laporan',[InputAspirasiController::class,'store'])->name('buat-laporan');

    // detail & edit
    Route::get('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{inputAspirasi}/edit', [InputAspirasiController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{inputAspirasi}', [InputAspirasiController::class, 'destroy'])->name('laporan.destroy');

});

// ================== ADMIN ==================

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/laporan/{inputAspirasi}', [AdminController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{inputAspirasi}', [AdminController::class, 'updateFeedback'])->name('laporan.update-feedback');
    Route::get('/kategori/create', [AdminController::class, 'createKategori'])->name('kategori.create');
    Route::post('/kategori', [AdminController::class, 'storeKategori'])->name('kategori.store');
    
});