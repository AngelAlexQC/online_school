<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MallaController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\GoogleController;
use Illuminate\Http\Request;

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
    return redirect('dashboard');
});
// upload file
Route::post('/upload', function (Request $request) {
    // Validate the file
    $file = $request->file('file');
    if (!$file) {
        return response()->json(['error' => 'File is required'], 422);
    }
    // Get multiple uploaded files
    $files = $request->file('file');
    // Get the name of the uploaded file
    $name = $request->file('file')->getClientOriginalName();
    // Get the mime type of the uploaded file
    $type = $request->file('file')->getClientMimeType();
    // Get the path of the uploaded file
    $path = $request->file('file')->getRealPath();
    // Get the extension of the uploaded file
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    // Get the name of the uploaded file without extension
    $filename = pathinfo($name, PATHINFO_FILENAME);
    // Get the name of the uploaded file without extension and with random string
    $filename = md5(uniqid(mt_rand(), true)) . '.' . $ext;
    // Get the path of the uploaded file without extension and with random string
    $path = public_path('uploads/');
    // Save the uploaded file
    $request->file('file')->move($path, $filename);
    // Return the path of the uploaded file
    $url = url('/uploads/' . $filename);
    return response()->json(['link' => $url]);
});
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
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
        Route::resource('users', UserController::class);
        Route::resource('enrollments', EnrollmentController::class);
    });
