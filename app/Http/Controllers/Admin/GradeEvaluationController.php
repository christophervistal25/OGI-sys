<?php

namespace App\Http\Controllers\Admin;

use App\GradeEvaluation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradeEvaluationController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = GradeEvaluation::all();

        return view('admin.evaluation-control.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.evaluation-control.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'date|before:end_date',
            'end_date' => 'date|after:start_date',
        ]);

        GradeEvaluation::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('success', 'Successfully add new grade evaluation.');
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
    public function edit(GradeEvaluation $evaluation)
    {
        return view('admin.evaluation-control.edit', compact('evaluation'));
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
        $request->validate([
            'start_date' => 'date|before:end_date|unique:grade_evaluations,start_date,'.$id,
            'end_date' => 'date|after:start_date|unique:grade_evaluations,end_date,'.$id,
        ]);

        $evaluation = GradeEvaluation::find($id);
        $evaluation->start_date = $request->start_date;
        $evaluation->end_date = $request->end_date;
        $evaluation->save();

        return back()->with('success', 'Successfully update the deadline.');
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
