<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Controllers\Front\HomeController::class)->name('home');
Route::get('/font_types/{category:slug}', \App\Http\Controllers\Front\CategoryController::class)->name('category');
Route::get('/font/{font:slug}', \App\Http\Controllers\Front\FontController::class)->name('font');
