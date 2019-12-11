<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructors\AddInstructorRequest;
use App\Http\Requests\Instructors\EditInstructorRequest;
use App\Instructor;
use App\Repositories\InstructorRepository;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    protected $instructorRepository;

    public function __construct(InstructorRepository $instructorRepo)
    {
        $this->middleware('auth:admin');
        $this->instructorRepository = $instructorRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.instructor.index');
    }

    public function instructors()
    {
        return Laratables::recordsOf(Instructor::class, function ($query) {
            return $query->where('active', 'yes')->with('department');
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
        return view('admin.instructor.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddInstructorRequest $request)
    {
        $instructor = $this->instructorRepository
                        ->store($request->except('password_confirmation'));
        return back()->with('success', 'Successfully add the instructor with ID Number ' . $instructor->id_number . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Instructor::with('department')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
         $departments = Department::get(['id', 'name']);
        return view('admin.instructor.edit', compact('instructor', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditInstructorRequest $request, $id)
    {
        $instructor = $this->instructorRepository
                        ->update($request->all());
        return back()->with('success', 'Successfully update the instructor information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $update = (bool) $instructor->update(['active' => 'no']);
        return response()->json(['success' => $update]);
    }
}
