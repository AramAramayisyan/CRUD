<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\UserController;

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
    Route::controller(LoginController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::prefix('profile')->controller(UserController::class)->group(function () {
        Route::get('/my', 'myProfile')->name('profile.my');
        Route::put('/edit', 'editProfile')->name('profile.edit');
        Route::get('/edit', 'editProfile')->name('profile.edit');
        Route::put('/update', 'updateProfile')->name('profile.update');
        Route::put('/edit-password', 'editPassword')->name('profile.editPassword');
    });

    Route::resource('products', ProductController::class);
    Route::patch('/products/{product}/toggleFeature', [ProductController::class, 'toggleFeature'])->name('products.toggleFeature');
    Route::get('/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::post( '/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
});
