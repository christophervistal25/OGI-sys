<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Service\StudentAchievementService;
use App\Service\StudentEducationService;
use App\Service\StudentService;
use App\Student;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public $studentService;

    public function __construct(StudentService $studentService, StudentEducationService $studentEducationService, StudentAchievementService $studentAchievementService)
    {
        $this->middleware('auth:admin');
        $this->studentService = $studentService;
        $this->studentEducationService = $studentEducationService;
        $this->studentAchievementService = $studentAchievementService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student.index');
    }

    public function students()
    {
        return Laratables::recordsOf(Student::class);
    }

    public function studentsByDepartment($departmentId)
    {
        return Laratables::recordsOf(Student::class, function ($query) use ($departmentId) {
            return $query->with(['course', 'course.department'])->whereHas('course', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            });
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get(['id', 'name']);
        $departments = Department::get();

        return view('admin.student.create', compact('courses', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * AddStudentRequest
     */
    public function store(AddStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $student = $this->studentService->addNewStudent($request->all());
            $this->studentEducationService->addNewStudentEducation($request->all(), $student);
            $this->studentService->addFamilyBackground($request->all(), $student);
            $this->studentAchievementService->addAchievements($request->all(), $student);
        });

        return back()->with('success', 'Student added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($departmentId)
    {
        return view('admin.student.show', compact('departmentId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $courses = Course::all();
        // $hasSubjects = $student->subjects->count();
        return view('admin.student.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStudentRequest $request, int $id)
    {
        $this->studentRepo->update($request->all());

        return back()->with('success', 'Successfully student information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
