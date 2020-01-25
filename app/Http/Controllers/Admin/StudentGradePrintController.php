<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendGrade;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class StudentGradePrintController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	 public function print(Request $request)
    {
        $student = Student::with(['course','course.department','subjects' => function ($query) {
                       $query->whereBetween('level', [request('from_year'), request('to_year')])
                            ->whereIn('semester', request('semesters'))
                            ->orderBy('level', 'ASC');
        }])->find($request->student_id);

          $subjects = $student->subjects->groupBy(['level', 'semester'])->map(function ($year) {
              return $year->sortKeys();
          });

          if (count($subjects) >= 1) {
              $student = Student::with('subjects')->find($request->student_id);
              $studentLevel = max($student->subjects->pluck('level')->toArray());
          } else {
             $studentLevel = 1;
          }

        if($request->action != 'send-email') {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('admin.student.print.grade', compact('student','subjects', 'studentLevel'));
            return $pdf->stream();
        } else {
             Mail::to($student->parents_email)->send(new SendGrade($student, $subjects, $studentLevel));
             return back()->with('success', 'Succesfully send the grade to it\'s parent.');
        }
      }
}
