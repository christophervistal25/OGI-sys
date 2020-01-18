<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SubjectStudentPrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }

    public function print($subject)
    {
        $students = Student::whereHas('subjects', function ($query) use($subject) {
             $query->where(['subject_id' => $subject, 'instructor_id' => Auth::user()->id]);
        })->with(['subjects' => function ($query) use($subject) {
             $query->where('id', $subject);
        }, 'course', 'course.department'])->get();

        $subject = Subject::find($subject);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('instructor.subjectstudents.print', compact('students', 'subject'));

        return $pdf->stream();
    }
}
