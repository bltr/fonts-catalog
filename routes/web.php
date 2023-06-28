<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\FontController;
use App\Http\Controllers\Front\HomeController;
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

Route::get('/{page?}/', HomeController::class)->name('home');
Route::get('/font_types/{category:slug}/{page?}/', CategoryController::class)->name('category');
Route::get('/font/{font:slug}/', FontController::class)->name('font');
