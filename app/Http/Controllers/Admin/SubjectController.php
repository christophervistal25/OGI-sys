<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddSubjectRequest;
use App\Http\Requests\Admin\UpdateSubjectRequest;
use App\Subject;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.subjects.index');
    }

    public function subjects($id)
    {
        return Laratables::recordsOf(Subject::class, function ($query) use($id) {
            return $query->where('department_id', $id);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get(['id', 'name']);
        return view('admin.subjects.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        Subject::create($request->all());
        return back()->with('success', 'Subject successfully add.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.subjects.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $departments = Department::get(['id', 'name']);
        return view('admin.subjects.edit', compact('subject', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->all());
        return back()->with('success', 'Successfully update.');
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
