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

Route::get('/',[\App\Http\Controllers\AuthController::class,'index'])->name('index');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::middleware('auth')->group(function (){
    Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
});

Route::get('/dashboard/admin/list', function () { return view('dashboard.admin.list'); })->name('dashboard.list');




Route::middleware('auth.type:admin')->group(function (){
    Route::get('/admin/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('admin.dashboard');
});




Route::middleware('auth.type:student')->group(function (){
    Route::get('/student/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('student.dashboard');
});


//TODO adjust the redirect pages to every user type in the project


Route::middleware('auth.type:teacher')->group(function (){
    Route::get('/teacher/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('teacher.dashboard');
});




Route::middleware('auth.type:parents')->group(function (){
    Route::get('/parents/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('parents.dashboard');
});
