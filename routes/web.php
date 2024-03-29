<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\StudentSubjectController;

Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::group(['prefix' => 'hr'], function () {
    Route::get('/', 'HRController@index')->name('hr.dashboard');

    Route::get('dashboard', 'HRController@index')->name('hr.dashboard');
    Route::get('edit', 'HRController@edit')->name('hr.edit');
    Route::put('edit/{hr}', 'HRController@update')->name('hr.update');

    Route::get('login', 'Auth\HRLoginController@login')->name('hr.auth.login');
    Route::post('login', 'Auth\HRLoginController@loginHR')->name('hr.auth.loginHR');
    Route::post('logout', 'Auth\HRLoginController@logout')->name('hr.auth.logout');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('edit/{admin}', [AdminController::class, 'update'])->name('admin.update');

    Route::get('login', [AdminLoginController::class, 'login'])->name('admin.auth.login');
    Route::post('login', [AdminLoginController::class, 'loginAdmin'])->name('admin.auth.loginAdmin');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');

    Route::get('/instructor/list', [InstructorController::class, 'instructors'])->name('instructor.lists');

    Route::resource('instructor', InstructorController::class);

    Route::get('/student/grade/{student}', 'Admin\StudentGradeController@show')->name('student.grade.show');

    Route::get('/student/list', [StudentController::class, 'students'])->name('student.lists');
    Route::resource('student', StudentController::class);

    // Route::get('/student/department/list/{departmentId}', 'Admin\StudentController@studentsByDepartment');

    Route::get('/student/subject/list/{student}', [StudentSubjectController::class, 'subjects']);
    Route::get('/student/{student}/subject/create', [StudentSubjectController::class, 'create'])->name('student.subject.create');
    Route::post('/student/{student}/subject/create', [StudentSubjectController::class, 'store'])->name('student.subject.store');
    Route::get('/student/{student}/subject/edit', [StudentSubjectController::class, 'edit'])->name('student.subject.edit');

    Route::post('/student/grade/print', 'Admin\StudentGradePrintController@print')->name('admin.student.subjects.print');

    Route::get('/import/student', 'Admin\ImportStudentController@create')->name('admin.student.import');
    Route::post('/import/student', 'Admin\ImportStudentController@store')->name('admin.student.import.action');

    Route::get('subject/list', [SubjectController::class, 'subjects'])->name('subject.lists');
    Route::resource('subject', SubjectController::class);

    Route::get('/course/list', [CourseController::class, 'courses'])->name('course.lists');

    Route::resource('course', CourseController::class);

    Route::get('/department/list', [DepartmentController::class, 'departments'])->name('department.lists');
    Route::resource('department', DepartmentController::class);

    Route::get('/department/students', [DepartmentController::class, 'index'])->name('department.students');

    // Route::resource('instructorsubjects', 'Admin\InstructorSubjectController');

    Route::get('/subject/{subject}/students', 'Admin\SubjectStudentsController@show');

    Route::resource('/grade/evaluation', 'Admin\GradeEvaluationController');

    Route::get('/student/view/grade/control', 'Admin\StudentViewGradeController@index')->name('view-grade.control.index');
    Route::get('/student/view/grade/control/create', 'Admin\StudentViewGradeController@create')->name('view-grade.control');
    Route::post('/student/view/grade/control/create', 'Admin\StudentViewGradeController@store')->name('view-grade.control.submit');
    Route::get('/student/view/grade/control/{schedule}', 'Admin\StudentViewGradeController@edit')->name('view-grade.control.edit');
    Route::put('/student/view/grade/control/{schedule}', 'Admin\StudentViewGradeController@update')->name('view-grade.control.update');
});

Route::group(['prefix' => 'student'], function () {
    Route::get('/', 'StudentController@index')->name('student.dashboard');
    Route::get('dashboard', 'StudentController@index')->name('student.dashboard');
    // Route::get('edit', 'StudentController@edit')->name('student.account.edit');
    // Route::put('edit/{student}', 'StudentController@update')->name('student.account.update');

    Route::get('login', 'Auth\StudentLoginController@login')->name('student.auth.login');
    Route::post('login', 'Auth\StudentLoginController@loginStudent')->name('student.auth.loginStudent');
    Route::post('logout', 'Auth\StudentLoginController@logout')->name('student.auth.logout');

    Route::post('grade/print', 'Student\SubjectGradePrintController@print')->name('student.subjects.print');

    Route::get('/subject', 'Student\SubjectsGradeController@index')->name('student.subjects.index');
    // Route::resource('subject', 'Student\SubjectsGradeController');
});

Route::group(['prefix' => 'instructor'], function () {
    Route::get('/', 'InstructorController@index')->name('instructor.dashboard');
    Route::get('dashboard', 'InstructorController@index')->name('instructor.dashboard');

    Route::get('edit', 'InstructorController@edit')->name('instructor.account.edit');
    Route::put('edit/{instructor}', 'InstructorController@update')->name('instructor.account.update');

    Route::get('login', 'Auth\InstructorLoginController@login')->name('instructor.auth.login');
    Route::post('login', 'Auth\InstructorLoginController@loginInstructor')->name('instructor.auth.loginInstructor');
    Route::post('logout', 'Auth\InstructorLoginController@logout')->name('instructor.auth.logout');

    Route::get('/subject/list', 'Instructor\SubjectController@subjects');
    Route::get('/subjects', 'Instructor\SubjectController@index')->name('instructor.subject.index');
    Route::get('/subject/select', 'Instructor\SubjectController@select')->name('instructor.subject.select');
    Route::get('/subject/create/{subject}', 'Instructor\SubjectController@create')->name('instructor.subject.create');
    Route::post('/subject/create', 'Instructor\SubjectController@store')->name('instructor.subject.store')->middleware('check.subject_entry');

    // Add some route name.
    Route::get('/subject/{subject}/edit', 'Instructor\SubjectController@edit');
    Route::put('/subject/{subject}/edit', 'Instructor\SubjectController@update');

    Route::get('/student/list/{subject}', 'Instructor\SubjectController@students')->name('student.list');
    Route::get('/student/edit/list/{subject}', 'Instructor\SubjectController@studentForEditSubject');

    Route::get('/subject/{subject}/add/student', 'Instructor\SubjectController@addNewStudent');
    Route::put('/subject/{subject}/add/student', 'Instructor\SubjectController@submitAddNewStudent')->name('subject.submit.new.student');

    Route::get('/subject/{subject}/students', 'Instructor\SubjectStudentController@show')->name('subject.students.show');

    Route::put('/subject/{subject}/students', 'Instructor\SubjectStudentController@update')
          ->name('subject.students.update');

    Route::get('/subject/{subject}/students/print', 'Instructor\SubjectStudentPrintController@print')->name('subject.students.print');
});
