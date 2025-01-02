<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'create'])->name('login');
  Route::post('/login', [LoginController::class, 'store']);

  Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');
  Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');
  Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
  Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});