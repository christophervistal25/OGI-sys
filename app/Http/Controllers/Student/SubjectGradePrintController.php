<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SubjectGradePrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function print(Request $request)
    {
        $student = Student::with(['course', 'course.department', 'subjects' => function ($query) {
            $query->whereBetween('level', [request('from_year'), request('to_year')])
                  ->whereIn('semester', request('semesters'))
                  ->orderBy('level', 'ASC');
        }])->find(Auth::user()->id);

        $subjects = $student->subjects->groupBy(['level', 'semester'])->map(function ($year) {
            return $year->sortKeys();
        });

        if (count($subjects) >= 1) {
            $student = Student::with('subjects')->find(Auth::user()->id);
            $studentLevel = max($student->subjects->pluck('level')->toArray());
        } else {
            $studentLevel = '';
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('student.subjects.print.grade', compact('student', 'subjects', 'studentLevel'));

        return $pdf->stream();
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
    public function show($id)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
