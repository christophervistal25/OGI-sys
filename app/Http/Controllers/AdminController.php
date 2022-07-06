<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Course;
use App\Department;
use App\Http\Requests\Admin\UpdateAccountRequest;
use App\Instructor;
use App\Student;
use JD\Cloudder\Facades\Cloudder;

class AdminController extends Controller
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
        $noOfStudents = Student::count();
        $noOfInstructors = Instructor::count();
        $noOfCourse = Course::count();
        $noOfDepartments = Department::count();

        return view('admin.dashboard', compact('noOfStudents', 'noOfInstructors', 'noOfCourse', 'noOfDepartments'));
    }

    public function create()
    {
        // return view('admin.auth.register');
    }

    public function edit()
    {
        return view('admin.auth.edit');
    }

    public function update(UpdateAccountRequest $request, Admin $admin)
    {
        if ($request->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ['width' => 150, 'height' => 150]);
            $admin->profile = $image_url;
        }

        $admin->name = $request->name;

        if (! is_null($request->password)) {
            $admin->password = $request->password;
        }
        $admin->save();

        return back()->with('success', 'Successfully update your account.');
    }
}
