<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use Freshbitsweb\Laratables\Laratables;

class CourseController extends Controller
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
        $departments = Department::all();

        return view('admin.courses.index', compact('departments'));
    }

    public function courses()
    {
        return Laratables::recordsOf(Course::class, function ($query) {
            return $query->orderBy('created_at', 'DESC');
        });
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
    public function store(AddCourseRequest $request)
    {
        $create = Course::create($request->all());

        return response()->json(['success' => $create]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Course::with(['department'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $update = $course->update($request->all());

        return response()->json(['success' => $update]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Course::find($id)->delete();

        return response()->json(['success' => $isDelete]);
    }
}
