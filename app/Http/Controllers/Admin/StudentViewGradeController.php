<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StudentViewGrade;
use Illuminate\Http\Request;

class StudentViewGradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $evaluations = StudentViewGrade::all();

        return view('admin.control.index', compact('evaluations'));
    }

    public function create()
    {
        return view('admin.control.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'date|before:end_date',
            'end_date' => 'date|after:start_date',
        ]);

        StudentViewGrade::create($request->all());

        return back()->with('success', 'Successfully add new schedule for student view grades.');
    }

    public function edit(StudentViewGrade $schedule)
    {
        return view('admin.control.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'date|before:end_date|unique:student_view_grades,start_date,'.$id,
            'end_date' => 'date|after:start_date|unique:student_view_grades,end_date,'.$id,
        ]);

        $schedule = StudentViewGrade::find($id);
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->save();

        return back()->with('success', 'Successfully update the schedule.');
    }
}
