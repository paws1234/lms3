<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SchoolCalendarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\ClassMaterialsController;
use App\Http\Controllers\ClassEnrollmentsController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\StudentClassesController;
use App\Http\Controllers\StudentAnnouncementsController;
use App\Http\Controllers\StudentsStudentsController;

// Routes for admin
Route::group(['middleware' => 'admin'], function () {
    // Routes for adminstudents
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    // Routes for adminteachers
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    // Routes for adminsubjects
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    // Routes for adminclasses
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
    // Routes for admincalendar
    Route::get('/school_calendars', [SchoolCalendarController::class, 'index'])->name('school_calendars.index');
    Route::get('/school_calendars/create', [SchoolCalendarController::class, 'create'])->name('school_calendars.create');
    Route::post('/school_calendars', [SchoolCalendarController::class, 'store'])->name('school_calendars.store');
    Route::get('/school_calendars/{event}/edit', [SchoolCalendarController::class, 'edit'])->name('school_calendars.edit');
    Route::put('/school_calendars/{event}', [SchoolCalendarController::class, 'update'])->name('school_calendars.update');
    Route::delete('/school_calendars/{event}', [SchoolCalendarController::class, 'destroy'])->name('school_calendars.destroy');

    // Routes for afterlogin
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
});

// Routes for teachers
Route::middleware(['auth', 'teacher'])->group(function () {

    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');

    // Routes for quizzes
    Route::get('/quizzes', [QuizzesController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizzesController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizzesController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}/edit', [QuizzesController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{quiz}', [QuizzesController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [QuizzesController::class, 'destroy'])->name('quizzes.destroy');
    // Routes for grades
    Route::get('grades', [GradesController::class, 'index'])->name('grades.index');
    Route::get('grades/create', [GradesController::class, 'create'])->name('grades.create');
    Route::post('grades', [GradesController::class, 'store'])->name('grades.store');
    Route::get('grades/{grade}/edit', [GradesController::class, 'edit'])->name('grades.edit');
    Route::put('grades/{grade}', [GradesController::class, 'update'])->name('grades.update');
    Route::delete('grades/{grade}', [GradesController::class, 'destroy'])->name('grades.destroy');
    // Routes for class_materials
    Route::get('/class-materials', [ClassMaterialsController::class, 'index'])->name('class-materials.index');
    Route::get('/class-materials/create', [ClassMaterialsController::class, 'create'])->name('class-materials.create');
    Route::post('/class-materials', [ClassMaterialsController::class, 'store'])->name('class-materials.store');
    Route::get('/class-materials/{class_material}/edit', [ClassMaterialsController::class, 'edit'])->name('class-materials.edit');
    Route::put('/class-materials/{class_material}', [ClassMaterialsController::class, 'update'])->name('class-materials.update');
    Route::delete('/class-materials/{class_material}', [ClassMaterialsController::class, 'destroy'])->name('class-materials.destroy');
    Route::get('class-materials/{id}/download', 'App\Http\Controllers\ClassMaterialsController@download')->name('class-materials.download');
    // Class Enrollments routes
    Route::get('/class_enrollments', [ClassEnrollmentsController::class, 'index'])->name('class_enrollments.index');
    Route::get('/class_enrollments/create', [ClassEnrollmentsController::class, 'create'])->name('class_enrollments.create');
    Route::post('/class_enrollments', [ClassEnrollmentsController::class, 'store'])->name('class_enrollments.store');
    Route::get('/class_enrollments/{enrollment}/edit', [ClassEnrollmentsController::class, 'edit'])->name('class_enrollments.edit');
    Route::put('/class_enrollments/{enrollment}', [ClassEnrollmentsController::class, 'update'])->name('class_enrollments.update');
    Route::delete('/class_enrollments/{class_enrollment}', [ClassEnrollmentsController::class, 'destroy'])->name('class_enrollments.destroy');
    // announcemnet routes
    Route::resource('announcements', AnnouncementsController::class);
    //download routes


});

Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/classes', [StudentClassesController::class, 'index'])->name('student.classes.index');
    Route::get('/announcements', [StudentAnnouncementsController::class, 'index'])->name('student.announcements.index');
    Route::get('/quizzes', [StudentsStudentsController::class, 'quizzes'])->name('student.quizzes.index');
    Route::get('/grades', [StudentsStudentsController::class, 'grades'])->name('student.grades.index');
    Route::get('/class-materials', [StudentsStudentsController::class, 'classMaterials'])->name('student.class_materials.index');
    Route::get('/class-materials/{id}/download', [StudentsStudentsController::class, 'download'])->name('student.class_materials.download');

});

// Routes for loginandregister
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Routes for landingpage
Route::get('/', function () {
    return view('welcome');
});
