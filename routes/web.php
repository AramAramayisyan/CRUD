<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
Route::patch('/products/{product}/toggleFeature', [ProductController::class, 'toggleFeature'])->name('products.toggleFeature');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [RegistrationController::class, 'ShowRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::get('/user', [LoginController::class, 'show'])->name('userPage');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
