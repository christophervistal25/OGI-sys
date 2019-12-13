<?php


Route::get('/', 'WelcomeController@index');


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

Route::group(['prefix' => 'admin'] , function () {
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('edit', 'AdminController@edit')->name('admin.edit');
    Route::put('edit/{admin}', 'AdminController@update')->name('admin.update');

  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');

    Route::get('/instructor/list', 'Admin\InstructorController@instructors')
        ->name('instructor.lists');

    Route::resource('instructor', 'Admin\InstructorController');

    Route::resource('instructorsubjects', 'Admin\InstructorSubjectController');
    
    Route::get('/student/grade/{student}', 'Admin\StudentGradeController@show')->name('student.grade.show');

    Route::get('/student/list', 'Admin\StudentController@students')
        ->name('student.lists');

    Route::resource('student', 'Admin\StudentController');

    Route::get('/student/{student}/subject/create', 'Admin\StudentSubjectController@create')
        ->name('student.subject.create');

    Route::post('/student/{student}/subject/create', 'Admin\StudentSubjectController@store')
        ->name('student.subject.store');

    Route::get('/student/{student}/subject/edit', 'Admin\StudentSubjectController@edit')
        ->name('student.subject.edit');

    Route::post('/student/grade/print', 'Admin\StudentGradePrintController@print')->name('admin.student.subjects.print');

    // Route::get('/instructor/list', 'Admin\InstructorController@instructors')
    //     ->name('instructor.lists');

    // Route::resource('instructor', 'Admin\InstructorController');

    Route::get('/subject/list/{id}', 'Admin\SubjectController@subjects')
        ->name('subject.lists');

    Route::resource('subject', 'Admin\SubjectController');

    Route::get('/course/list', 'Admin\CourseController@courses')
        ->name('course.lists');
    Route::resource('course', 'Admin\CourseController');

    Route::get('/department/list', 'Admin\DepartmentController@departments')
        ->name('department.lists');
        
    Route::resource('department', 'Admin\DepartmentController');

    // Route::resource('instructorsubjects', 'Admin\InstructorSubjectController');

    Route::get('/subject/{subject}/students', 'Admin\SubjectStudentsController@show');
});

Route::group(['prefix' => 'student'] , function () {
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

Route::group(['prefix' => 'instructor'] , function () {
	Route::get('/', 'InstructorController@index')->name('instructor.dashboard');
  	Route::get('dashboard', 'InstructorController@index')->name('instructor.dashboard');

    Route::get('edit', 'InstructorController@edit')->name('instructor.account.edit');
    Route::put('edit/{instructor}', 'InstructorController@update')->name('instructor.account.update');
    
  	Route::get('login', 'Auth\InstructorLoginController@login')->name('instructor.auth.login');
  	Route::post('login', 'Auth\InstructorLoginController@loginInstructor')->name('instructor.auth.loginInstructor');
  	Route::post('logout', 'Auth\InstructorLoginController@logout')->name('instructor.auth.logout');


    Route::get('/subjects', 'Instructor\SubjectController@index')->name('instructor.subject.index');
    Route::get('/subject/create', 'Instructor\SubjectController@create')->name('instructor.subject.create');
    Route::post('/subject/create', 'Instructor\SubjectController@store')->name('instructor.subject.store')->middleware('check.subject_entry');

    // Add some route name.
    Route::get('/subject/{subject}/edit', 'Instructor\SubjectController@edit');
    Route::put('/subject/{subject}/edit', 'Instructor\SubjectController@update');

    Route::get('/student/list', 'Instructor\SubjectController@students')->name('student.list');
    Route::get('/student/edit/list/{subject}', 'Instructor\SubjectController@studentForEditSubject');

    Route::get('/subject/{subject}/add/student', 'Instructor\SubjectController@addNewStudent');
    Route::put('/subject/{subject}/add/student', 'Instructor\SubjectController@submitAddNewStudent')->name('subject.submit.new.student');
    
    Route::get('/subject/{subject}/students', 'Instructor\SubjectStudentController@show')->name('subject.students.show');

    Route::put('/subject/{subject}/students', 'Instructor\SubjectStudentController@update')
          ->name('subject.students.update');
});


