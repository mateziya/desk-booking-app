<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');
Route::inertia('/calendar', 'UserCalendar')->middleware('auth')->name('calendar');

Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'create'])->name('login');
  Route::post('/login', [LoginController::class, 'store']);

  Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');
  Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');
  Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
  Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

Route::middleware(['auth', 'verified', Admin::class])->group(function() {
  Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
  Route::get('/admin/users/add', [AdminController::class, 'create'])->name('admin.create');
  Route::post('/admin/users/add', [AdminController::class, 'store']);
  Route::get('/admin/users/edit/{user}', [AdminController::class, 'edit'])->name('users.edit');
  Route::patch('/admin/users/edit/{user}', [AdminController::class, 'update'])->name('users.update');
  Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

  Route::get('/admin/desks', [DeskController::class, 'index'])->name('admin.desks');
  Route::get('/admin/desks/add', [DeskController::class, 'create'])->name('desks.create');
  Route::post('/admin/desks/add', [DeskController::class, 'store']);
  Route::delete('/admin/desks/{desk}', [DeskController::class, 'destroy'])->name('desks.destroy');
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});