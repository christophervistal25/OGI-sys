<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Http\Request;

class InstructorSubjectController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function show(int $id)
    {
    	$instructor = Instructor::with(['subjects', 'subjects.students' => function ($query) use($id) 
    	{
    		$query->where('instructor_id', $id);
    	}])->find($id);
    	return view('admin.instructor.subject.show', compact('instructor'));
    }
}
