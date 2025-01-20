<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\Admin;
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

Route::middleware(['auth', 'verified'])->group(function() {
  Route::get('/calendar', [ReservationsController::class, 'calendar'])->name('calendar');
  Route::get('/reserve/{date}', [ReservationsController::class, 'userReservations'])->name('reserve');
  Route::post('/reserve/{date}/{desk}', [ReservationsController::class, 'reserveDesk'])->name('desk.reserve');
  Route::delete('/reserve/{date}/{desk}', [ReservationsController::class, 'cancelReservation'])->name('cancel.reservation');
});

Route::middleware(['auth', 'verified', Admin::class])->group(function() {
  Route::get('/admin/users', [UserController::class, 'users'])->name('admin.users');
  Route::get('/admin/users/add', [UserController::class, 'create'])->name('admin.create');
  Route::post('/admin/users/add', [UserController::class, 'store']);
  Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
  Route::patch('/admin/users/edit/{user}', [UserController::class, 'update'])->name('users.update');
  Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

  Route::get('/admin/desks', [DeskController::class, 'index'])->name('admin.desks');
  Route::get('/admin/desks/add', [DeskController::class, 'create'])->name('desks.create');
  Route::post('/admin/desks/add', [DeskController::class, 'store']);
  Route::delete('/admin/desks/{desk}', [DeskController::class, 'destroy'])->name('desks.destroy');

  Route::get('/reservations/{date}', [ReservationsController::class, 'adminReservations'])->name('reservations');
  Route::delete('/reservations/{reservation}', [ReservationsController::class, 'deleteReservation'])->name('delete.reservation');
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});