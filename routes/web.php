<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', [ProjectController::class, 'index'])->name('index');
Route::resource('projects', ProjectController::class);
