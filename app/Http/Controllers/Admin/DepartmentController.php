<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        return view('admin.departments.index');
    }

    public function departments()
    {
        return Laratables::recordsOf(Department::class);
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
        $this->validate($request, [
            'departmentCode' => ['required', 'unique:departments,department_code'],
            'departmentName' => ['required'],
            'departmentShortname' => ['nullable', 'min:2'],
            'departmentHead' => ['required'],
            'departmentHeadPosition' => ['required'],
        ], [], [
            'departmentCode' => 'Department Code',
            'departmentName' => 'Department Name',
            'departmentShortname' => 'Department Shortname',
            'departmentHead' => 'Department Head',
            'departmentHeadPosition' => 'Department Head Position',
        ]);

        Department::create([
            'department_code' => $request->departmentCode,
            'name' => $request->departmentName,
            'short_name' => $request->departmentShortname,
            'department_head' => $request->departmentHead,
            'department_head_position' => $request->departmentHeadPosition,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => Department::find($id)]);
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
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'editDepartmentCode' => ['required', 'unique:departments,department_code,'.$department->id],
            'editDepartmentName' => ['required'],
            'editDepartmentShortname' => ['nullable', 'min:2'],
            'editDepartmentHead' => ['required'],
            'editDepartmentHeadPosition' => ['required'],
        ], [], [
            'editDepartmentCode' => 'Department Code',
            'editDepartmentName' => 'Department Name',
            'editDepartmentShortname' => 'Department Shortname',
            'editDepartmentHead' => 'Department Head',
            'editDepartmentHeadPosition' => 'Department Head Position',
        ]);

        // Update department
        $department->department_code = $request->editDepartmentCode;
        $department->name = $request->editDepartmentName;
        $department->short_name = $request->editDepartmentShortname;
        $department->department_head = $request->editDepartmentHead;
        $department->department_head_position = $request->editDepartmentHeadPosition;
        $department->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();

        return response()->json(['success' => true]);
    }
}
