<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('student.subjects.index');

        return view('student.dashboard');
    }

    public function edit()
    {
        return view('student.auth.edit');
    }

    public function update(Request $request, Student $student)
    {
        $rules = [
            'profile' => 'nullable',
        ];

        if (! is_null(request()->password) || ! is_null(request()->password_confirmation)) {
            $rules['password'] = 'required|confirmed|min:8|max:20';
        }

        $this->validate($request, $rules);

        if ($request->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ['width' => 150, 'height' => 150]);
            $student->profile = $image_url;
        }

        if (! is_null($request->password)) {
            $student->password = $request->password;
        }
        $student->save();

        return back()->with('success', 'Successfully update your account.');
    }
}
