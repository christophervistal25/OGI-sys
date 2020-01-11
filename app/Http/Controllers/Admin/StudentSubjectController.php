<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentSubjectRequest;
use App\Student;
use App\Subject;
use DB;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StudentSubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subjects($studentId)
    {
        $student = Student::with('subjects')->find($studentId);
        $studentSubjects = $student->subjects->pluck('id')->toArray();
        return Laratables::recordsOf(Subject::class, function($query) use($studentSubjects)
        {
            return $query->whereNotIn('id', $studentSubjects);
        });
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
    public function create(Student $student)
    {
        $subjects = Subject::orderBy('level')->get();
        return view('admin.studentsubject.create', compact('student', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        if ($request->has('subjects')) {
            $subjects = array_unique($request->subjects['ids']);
            $subjectNames = array_unique($request->subjects['names']);

            $student->subjects()->attach($subjects, ['instructor_id' => 0 , 'remarks' => 0]);
            return redirect()->route('student.subject.create', [$student])->with('success', 'Subjects successfully add.');
        } else {
            return back()->withErrors(['message' => 'Please add some fields click the plus(+) icon.']);
        }
        
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
    public function edit(Student $student)
    {
        $subjects = $student->subjects()
                            ->orderBy('semester', 'ASC')
                            ->get()
                            ->groupBy(['level', 'semester'])
                            ->toArray();
        return view('admin.studentsubject.edit', compact('subjects', 'student'));
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
