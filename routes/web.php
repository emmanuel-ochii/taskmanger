<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/



Route::get('/', [TaskController::class, 'welcome'])->name('welcome');

Route::resource('task', TaskController::class);

Route::resource('category', CategoryController::class);

