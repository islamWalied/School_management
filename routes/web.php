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

    //admin routes
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


    // class routes
    Route::get('admin/class/list',[\App\Http\Controllers\ClassModelController::class,'index'])->name('admin.class.list');
    Route::get('admin/class/add',[\App\Http\Controllers\ClassModelController::class,'create'])->name('admin.class.add');
    Route::post('admin/class/add',[\App\Http\Controllers\ClassModelController::class,'store'])->name('admin.class.add');
    Route::get('admin/class/edit/{classModel}',[\App\Http\Controllers\ClassModelController::class,'edit'])->name('admin.class.edit');
    Route::patch('admin/class/update/{classModel}',[\App\Http\Controllers\ClassModelController::class,'update'])->name('admin.class.update');
    Route::delete('admin/class/delete/{classModel}', [\App\Http\Controllers\ClassModelController::class,'destroy'])->name('admin.class.delete');
    Route::get('admin/class/list/trash',[\App\Http\Controllers\ClassModelController::class,'trash'])->name('admin.class.trash');
    Route::patch('admin/class/list/{id}/restore',[\App\Http\Controllers\ClassModelController::class,'restore'])->name('admin.class.restore');
    Route::delete('admin/class/list/{id}/force-delete',[\App\Http\Controllers\ClassModelController::class,'forceDelete'])->name('admin.class.forceDelete');

    // subject routes
    Route::get('admin/subject/list',[\App\Http\Controllers\SubjectController::class,'index'])->name('admin.subject.list');
    Route::get('admin/subject/add',[\App\Http\Controllers\SubjectController::class,'create'])->name('admin.subject.add');
    Route::post('admin/subject/add',[\App\Http\Controllers\SubjectController::class,'store'])->name('admin.subject.add');
    Route::get('admin/subject/edit/{subject}',[\App\Http\Controllers\SubjectController::class,'edit'])->name('admin.subject.edit');
    Route::patch('admin/subject/update/{subject}',[\App\Http\Controllers\SubjectController::class,'update'])->name('admin.subject.update');
    Route::delete('admin/subject/delete/{subject}', [\App\Http\Controllers\SubjectController::class,'destroy'])->name('admin.subject.delete');
    Route::get('admin/subject/list/trash',[\App\Http\Controllers\SubjectController::class,'trash'])->name('admin.subject.trash');
    Route::patch('admin/subject/list/{id}/restore',[\App\Http\Controllers\SubjectController::class,'restore'])->name('admin.subject.restore');
    Route::delete('admin/subject/list/{id}/force-delete',[\App\Http\Controllers\SubjectController::class,'forceDelete'])->name('admin.subject.forceDelete');

    // assign subject routes
    Route::get('admin/assign-subjects/list',[\App\Http\Controllers\ClassSubjectController::class,'index'])->name('admin.assign.list');
    Route::get('admin/assign-subjects/add',[\App\Http\Controllers\ClassSubjectController::class,'create'])->name('admin.assign.add');
    Route::post('admin/assign-subjects/add',[\App\Http\Controllers\ClassSubjectController::class,'store'])->name('admin.assign.add');
    Route::get('admin/assign-subjects/edit/{classSubject}',[\App\Http\Controllers\ClassSubjectController::class,'edit'])->name('admin.assign.edit');
    Route::patch('admin/assign-subjects/update/{classSubject}',[\App\Http\Controllers\ClassSubjectController::class,'update'])->name('admin.assign.update');
    Route::delete('admin/assign-subjects/delete/{classSubject}', [\App\Http\Controllers\ClassSubjectController::class,'destroy'])->name('admin.assign.delete');
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
