<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MallaController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\PeriodController;
use App\Http\Controllers\Api\CareerController;
use App\Http\Controllers\Api\MatterController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AdmissionController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\MallaLevelsController;
use App\Http\Controllers\Api\CourseClassController;
use App\Http\Controllers\Api\StudentTaskController;
use App\Http\Controllers\Api\AssistancesController;
use App\Http\Controllers\Api\UserCoursesController;
use App\Http\Controllers\Api\CareerMallasController;
use App\Http\Controllers\Api\LevelMattersController;
use App\Http\Controllers\Api\ClassCommentController;
use App\Http\Controllers\Api\UserCommentsController;
use App\Http\Controllers\Api\SchoolCareersController;
use App\Http\Controllers\Api\SchoolPeriodsController;
use App\Http\Controllers\Api\PeriodCoursesController;
use App\Http\Controllers\Api\MatterCoursesController;
use App\Http\Controllers\Api\UserAdmissionsController;
use App\Http\Controllers\Api\AdmissionAtachController;
use App\Http\Controllers\Api\MallaAdmissionsController;
use App\Http\Controllers\Api\CourseClassTaskController;
use App\Http\Controllers\Api\UserEnrollmentsController;
use App\Http\Controllers\Api\UserStudentTasksController;
use App\Http\Controllers\Api\CourseEnrollmentsController;
use App\Http\Controllers\Api\StudentTaskAttachController;
use App\Http\Controllers\Api\CourseCourseClassesController;
use App\Http\Controllers\Api\CommentClassCommentsController;
use App\Http\Controllers\Api\CourseClassClassCommentsController;
use App\Http\Controllers\Api\EnrollmentAllAssistancesController;
use App\Http\Controllers\Api\CourseClassAllAssistancesController;
use App\Http\Controllers\Api\AdmissionAdmissionAtachesController;
use App\Http\Controllers\Api\CommentStudentTaskAttachesController;
use App\Http\Controllers\Api\CourseClassCourseClassTasksController;
use App\Http\Controllers\Api\CourseClassTaskStudentTasksController;
use App\Http\Controllers\Api\StudentTaskStudentTaskAttachesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');


Route::name('api.')
    ->group(function () {
        Route::apiResource('schools', SchoolController::class);
        Route::apiResource('courses', CourseController::class);
    });

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);


        // School Careers
        Route::get('/schools/{school}/careers', [
            SchoolCareersController::class,
            'index',
        ])->name('schools.careers.index');
        Route::post('/schools/{school}/careers', [
            SchoolCareersController::class,
            'store',
        ])->name('schools.careers.store');

        // School Periods
        Route::get('/schools/{school}/periods', [
            SchoolPeriodsController::class,
            'index',
        ])->name('schools.periods.index');
        Route::post('/schools/{school}/periods', [
            SchoolPeriodsController::class,
            'store',
        ])->name('schools.periods.store');

        Route::apiResource('careers', CareerController::class);

        // Career Mallas
        Route::get('/careers/{career}/mallas', [
            CareerMallasController::class,
            'index',
        ])->name('careers.mallas.index');
        Route::post('/careers/{career}/mallas', [
            CareerMallasController::class,
            'store',
        ])->name('careers.mallas.store');

        Route::apiResource('mallas', MallaController::class);

        // Malla Levels
        Route::get('/mallas/{malla}/levels', [
            MallaLevelsController::class,
            'index',
        ])->name('mallas.levels.index');
        Route::post('/mallas/{malla}/levels', [
            MallaLevelsController::class,
            'store',
        ])->name('mallas.levels.store');

        // Malla Admissions
        Route::get('/mallas/{malla}/admissions', [
            MallaAdmissionsController::class,
            'index',
        ])->name('mallas.admissions.index');
        Route::post('/mallas/{malla}/admissions', [
            MallaAdmissionsController::class,
            'store',
        ])->name('mallas.admissions.store');

        Route::apiResource('matters', MatterController::class);

        // Matter Courses
        Route::get('/matters/{matter}/courses', [
            MatterCoursesController::class,
            'index',
        ])->name('matters.courses.index');
        Route::post('/matters/{matter}/courses', [
            MatterCoursesController::class,
            'store',
        ])->name('matters.courses.store');

        // Route::apiResource('courses', CourseController::class);

        // Course Course Classes
        Route::get('/courses/{course}/course-classes', [
            CourseCourseClassesController::class,
            'index',
        ])->name('courses.course-classes.index');
        Route::post('/courses/{course}/course-classes', [
            CourseCourseClassesController::class,
            'store',
        ])->name('courses.course-classes.store');

        // Course Enrollments
        Route::get('/courses/{course}/enrollments', [
            CourseEnrollmentsController::class,
            'index',
        ])->name('courses.enrollments.index');
        Route::post('/courses/{course}/enrollments', [
            CourseEnrollmentsController::class,
            'store',
        ])->name('courses.enrollments.store');

        Route::apiResource('admissions', AdmissionController::class);

        // Admission Admission Ataches
        Route::get('/admissions/{admission}/admission-ataches', [
            AdmissionAdmissionAtachesController::class,
            'index',
        ])->name('admissions.admission-ataches.index');
        Route::post('/admissions/{admission}/admission-ataches', [
            AdmissionAdmissionAtachesController::class,
            'store',
        ])->name('admissions.admission-ataches.store');

        Route::apiResource('course-classes', CourseClassController::class);

        // CourseClass Course Class Tasks
        Route::get('/course-classes/{courseClass}/course-class-tasks', [
            CourseClassCourseClassTasksController::class,
            'index',
        ])->name('course-classes.course-class-tasks.index');
        Route::post('/course-classes/{courseClass}/course-class-tasks', [
            CourseClassCourseClassTasksController::class,
            'store',
        ])->name('course-classes.course-class-tasks.store');

        // CourseClass All Assistances
        Route::get('/course-classes/{courseClass}/all-assistances', [
            CourseClassAllAssistancesController::class,
            'index',
        ])->name('course-classes.all-assistances.index');
        Route::post('/course-classes/{courseClass}/all-assistances', [
            CourseClassAllAssistancesController::class,
            'store',
        ])->name('course-classes.all-assistances.store');

        // CourseClass Class Comments
        Route::get('/course-classes/{courseClass}/class-comments', [
            CourseClassClassCommentsController::class,
            'index',
        ])->name('course-classes.class-comments.index');
        Route::post('/course-classes/{courseClass}/class-comments', [
            CourseClassClassCommentsController::class,
            'store',
        ])->name('course-classes.class-comments.store');

        Route::apiResource('comments', CommentController::class);

        // Comment Class Comments
        Route::get('/comments/{comment}/class-comments', [
            CommentClassCommentsController::class,
            'index',
        ])->name('comments.class-comments.index');
        Route::post('/comments/{comment}/class-comments', [
            CommentClassCommentsController::class,
            'store',
        ])->name('comments.class-comments.store');

        // Comment Student Task Attaches
        Route::get('/comments/{comment}/student-task-attaches', [
            CommentStudentTaskAttachesController::class,
            'index',
        ])->name('comments.student-task-attaches.index');
        Route::post('/comments/{comment}/student-task-attaches', [
            CommentStudentTaskAttachesController::class,
            'store',
        ])->name('comments.student-task-attaches.store');

        Route::apiResource('users', UserController::class);

        // User Comments
        Route::get('/users/{user}/comments', [
            UserCommentsController::class,
            'index',
        ])->name('users.comments.index');
        Route::post('/users/{user}/comments', [
            UserCommentsController::class,
            'store',
        ])->name('users.comments.store');

        // User Admissions
        Route::get('/users/{user}/admissions', [
            UserAdmissionsController::class,
            'index',
        ])->name('users.admissions.index');
        Route::post('/users/{user}/admissions', [
            UserAdmissionsController::class,
            'store',
        ])->name('users.admissions.store');

        // User Student Tasks
        Route::get('/users/{user}/student-tasks', [
            UserStudentTasksController::class,
            'index',
        ])->name('users.student-tasks.index');
        Route::post('/users/{user}/student-tasks', [
            UserStudentTasksController::class,
            'store',
        ])->name('users.student-tasks.store');

        // User Enrollments
        Route::get('/users/{user}/enrollments', [
            UserEnrollmentsController::class,
            'index',
        ])->name('users.enrollments.index');
        Route::post('/users/{user}/enrollments', [
            UserEnrollmentsController::class,
            'store',
        ])->name('users.enrollments.store');

        // User Courses
        Route::get('/users/{user}/courses', [
            UserCoursesController::class,
            'index',
        ])->name('users.courses.index');
        Route::post('/users/{user}/courses', [
            UserCoursesController::class,
            'store',
        ])->name('users.courses.store');

        Route::apiResource('enrollments', EnrollmentController::class);

        // Enrollment All Assistances
        Route::get('/enrollments/{enrollment}/all-assistances', [
            EnrollmentAllAssistancesController::class,
            'index',
        ])->name('enrollments.all-assistances.index');
        Route::post('/enrollments/{enrollment}/all-assistances', [
            EnrollmentAllAssistancesController::class,
            'store',
        ])->name('enrollments.all-assistances.store');
    });
