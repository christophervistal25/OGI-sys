<?php

namespace App\Http\Controllers\Instructor;

use App\GradeEvaluation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructors\EditStudentRating;
use App\Student;
use App\Subject;
use Carbon\Carbon;
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
        $daysLeft = "";
        $evaluation = GradeEvaluation::canAdd();

        $instructor = Auth::user();
        $subject = $instructor->subjects->where('id', $subject)->first();
        $students = $subject->students;
/*        $students = Student::whereHas('subjects', function ($query) use($subject) {
             $query->where(['subject_id' => $subject, 'instructor_id' => Auth::user()->id]);
        })->with(['subjects' => function ($query) use($subject) {
             $query->where('id', $subject);
        }, 'course', 'course.department'])->get();

        $subject = Subject::find($subject);*/
        if(isset($evaluation->end_date)) {
            $daysLeft = (int) $evaluation->end_date->format('d') - (int) Carbon::now()->format('d');    
        }
        return view('instructor.subjectstudents.show', compact('students', 'subject', 'evaluation', 'daysLeft'));
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
        $evaluation = GradeEvaluation::canAdd();
        if(isset($evaluation->end_date)) {
            $student = Student::find($request->student_id);
            $status = $subject->students()->updateExistingPivot($student,['remarks' => $request->pivot['remarks']], false);
            return response()->json(['success' => (bool) $status], 200);    
        } else {
            dd('You can\'t add grade.');
        }
        
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
