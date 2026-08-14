<?php

use App\Http\Controllers\AspirasiController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::get('/registrasi', function(){
    return view('auth.register');
})->name('registrasi');

Route::middleware(['auth'])->group(function (){

    Route::get('/',[AspirasiController::class,'index'])->name('home');

});
