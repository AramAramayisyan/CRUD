<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::resource('product', ProductController::class);
Route::get('/edit{id}', [ProductController::class, 'edit'])->name('edit');
