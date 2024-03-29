<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        return view('admin.student.import');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $destination = public_path().'/'.time().'_'.$request->file('csv')->getClientOriginalName();

            move_uploaded_file($request->file('csv'), $destination);

            $content = str_replace("\r", '', file_get_contents($destination));
            $arrayContent = array_filter(explode("\n", $content));
            foreach ($arrayContent as $key => $s) {
                [$firstname, $middlename, $lastname, $gender, $course, $school_year, $semester, $level, $parents_email] = explode(',', $s);

                $student = Student::firstOrNew(
                    [
                        'course_id' => Course::where('abbr', strtoupper($course))->first(['id'])->id,
                        'name' => $firstname.' '.$middlename.' '.$lastname,
                        'gender' => strtolower($gender),
                    ],
                    [
                        'firstname' => $firstname,
                        'middlename' => $middlename,
                        'lastname' => $lastname,
                        'name' => $firstname.' '.$middlename.' '.$lastname,
                        'gender' => strtolower($gender),
                        'course_id' => Course::where('abbr', strtoupper($course))->first(['id'])->id,
                        'password' => '123456789',
                        'birthdate' => Carbon::now(),
                        'school_year' => $school_year,
                        'semester' => $semester,
                        'level' => $level,
                        'parents_email' => $parents_email,
                    ]
                );
                $student->save();
            }

            DB::commit();
            File::delete($destination);

            return back()->with('success', 'Succesfully add many new students');
        } catch (Exception $e) {
            dd($e->getMessage());

            return back();
            DB::rollback();
        }
    }
}
