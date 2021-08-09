<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MallaController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CourseClassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('schools', SchoolController::class);
        Route::resource('careers', CareerController::class);
        Route::resource('mallas', MallaController::class);
        Route::resource('matters', MatterController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('admissions', AdmissionController::class);
        Route::resource('course-classes', CourseClassController::class);
        Route::resource('comments', CommentController::class);
    });
