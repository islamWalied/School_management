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
Route::get('/forget-password',[\App\Http\Controllers\ForgetPasswordController::class,'forget_page'])->name('forgetPage');
Route::post('/forget-password',[\App\Http\Controllers\ForgetPasswordController::class,'forget_password'])->name('forget_password');
Route::get('/admin/reset/{remember_token}',[\App\Http\Controllers\ForgetPasswordController::class,'reset'])->name('reset');
Route::post('/admin/reset/{remember_token}',[\App\Http\Controllers\ForgetPasswordController::class,'reset_password'])->name('reset_password');



Route::middleware('auth')->group(function (){
    Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
});





Route::middleware('auth.type:admin')->group(function (){
    Route::get('/admin/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/list', [\App\Http\Controllers\AdminController::class,'index'])->name('admin.list');
    Route::get('/admin/list/add', [\App\Http\Controllers\AdminController::class,'create'])->name('admin.add');
    Route::post('/admin/list/add', [\App\Http\Controllers\AdminController::class,'store'])->name('admin.add');
    Route::get('/admin/list/edit/{id}', [\App\Http\Controllers\AdminController::class,'edit'])->name('admin.edit');
    Route::patch('/admin/list/update/{user}', [\App\Http\Controllers\AdminController::class,'update'])->name('admin.update');
    Route::delete('/admin/list/delete/{user}', [\App\Http\Controllers\AdminController::class,'destroy'])->name('admin.delete');
    Route::get('admin/list/trash',[\App\Http\Controllers\AdminController::class,'trash'])->name('admin.trash');
    Route::patch('admin/list/{id}/restore',[\App\Http\Controllers\AdminController::class,'restore'])->name('admin.restore');
    Route::delete('admin/list/{id}/force-delete',[\App\Http\Controllers\AdminController::class,'forceDelete'])->name('admin.forceDelete');
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
