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

            $destination =  public_path() . time() .'_' .  $request->file('csv')->getClientOriginalName();

            move_uploaded_file($request->file('csv'), $destination);

            $content = str_replace("\r", "", file_get_contents($destination));
            $arrayContent = array_filter(explode("\n", $content));
            foreach ($arrayContent as $key => $s) {
            	list($firstname,$middlename,$lastname,$gender,$course,$school_year,$semester,$level) = explode(',', $s);

            	$student = new Student();
				$student->firstname   = $firstname;
				$student->middlename  = $middlename;
				$student->lastname    = $lastname;
				$student->name        = $firstname . ' ' . $middlename . ' ' . $lastname;
				$student->gender      = $gender;
				$student->course_id   = Course::where('abbr', strtoupper($course))->first(['id'])->id;
				$student->password    = '123456789';
				$student->birthdate   = Carbon::now();
				$student->school_year = $school_year;
				$student->semester    = $semester;
				$student->level       = $level;
				$student->save();
            }
     
          
            DB::commit();
            File::delete($destination);
            return back()->with('success', 'Succesfully add many new students');
        } catch (Exception $e) {
            return back();
            DB::rollback();
        }
    }
}
