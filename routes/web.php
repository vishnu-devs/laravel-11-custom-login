<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController; 

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [CustomAuthController::class, 'index'])->name('login'); 
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');  
    Route::get('register', [CustomAuthController::class, 'registration'])->name('register'); 
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');  
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [CustomAuthController::class, 'dashboard']);  
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
});
