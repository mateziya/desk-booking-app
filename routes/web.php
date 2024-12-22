<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'create'])->name('login');
  Route::post('/login', [LoginController::class, 'store']);
});