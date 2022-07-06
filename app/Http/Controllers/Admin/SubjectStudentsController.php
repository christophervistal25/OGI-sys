<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subject;

class SubjectStudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show($id)
    {
        $subject = Subject::with('students')->find($id);

        return view('admin.subjects.students', compact('subject'));
    }
}
