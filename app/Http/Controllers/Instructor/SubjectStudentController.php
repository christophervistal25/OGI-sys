<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructors\EditStudentRating;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        
        $students = Student::whereHas('subjects', function ($query) use($subject) {
             $query->where(['subject_id' => $subject, 'instructor_id' => Auth::user()->id]);
        })->with(['subjects' => function ($query) use($subject) {
             $query->where('id', $subject);
        }, 'course', 'course.department'])->get();

        $subject = Subject::find($subject);

        return view('instructor.subjectstudents.show', compact('students', 'subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the grade of the student in subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStudentRating $request, Subject $subject)
    {
        $student = Student::find($request->student_id);
        $status = $subject->students()->updateExistingPivot($student,['remarks' => $request->pivot['remarks']], false);
        return response()->json(['success' => (bool) $status], 200);
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
