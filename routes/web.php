<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController, RegistrationController, UserController, AdminController};
use App\Http\Controllers\ProductController;

Route::get('/send-test-email', [UserController::class, 'sendTestEmail']);

Route::controller(LoginController::class)->group(function() {
    Route::match(['get'], '/', 'showLoginForm')->name('loginPage');
    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login')->name('login');
});

Route::controller(RegistrationController::class)->group(function() {
    Route::get('/registration', 'showRegistrationForm')->name('registration');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('auth')->group(function() {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::prefix('profile')->controller(UserController::class)->group(function() {
        Route::get('/my', 'myProfile')->name('profile.my');
        Route::match(['get', 'put'], '/edit', 'editProfile')->name('profile.edit');
        Route::put('/update', 'updateProfile')->name('profile.update');
        Route::put('/edit-password', 'editPassword')->name('profile.editPassword');
        Route::delete('/delete/{id}', 'deleteProfile')->name('profile.delete');
        Route::get('products/{user}', 'products')->name('profile.products');
    });

    Route::resource('products', ProductController::class);
    Route::prefix('products')->group(function() {
        Route::patch('{product}/toggleFeature', [ProductController::class, 'toggleFeature'])->name('products.toggleFeature');
        Route::post('restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
        Route::match(['get'], 'trash', [ProductController::class, 'trash'])->name('products.trash');
        Route::delete('forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    });

    Route::prefix('admin')->group(function() {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('userShow/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('updateRole{id}', 'App\Http\Controllers\Auth\AdminController@updateUserRole')->name('users.updateRole');
    });
});
