<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function(){
    return view('auth.login');
})->name('login');
Route::post('/login-submit',[AuthController::class,'login'])->name('login.submit');

Route::get('/registrasi', function(){
    return view('auth.register');
})->name('registrasi');

Route::middleware(['auth'])->group(function (){

    Route::get('/',[AspirasiController::class,'index'])->name('home');

});
