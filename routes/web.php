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

Route::get('/',[\App\Http\Controllers\AuthController::class,'index']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::get('/dashboard/admin/list', function () {
    return view('dashboard.admin.list');
})->name('dashboard.list');
