<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('loginPage');
    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login')->name('login');
});
Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration', 'showRegistrationForm')->name('registration');
    Route::post('/register', 'register')->name('register');
});
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::patch('/products/{product}/toggleFeature', [ProductController::class, 'toggleFeature'])->name('products.toggleFeature');
    Route::get('/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::post( '/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::controller(LoginController::class)->group(function () {
        Route::get('/user', 'showUserPage')->name('userPage');
        Route::post('/logout', 'logout')->name('logout');
    });
});
