<?php

namespace App\Http\Controllers\Instructor;

use App\Department;
use App\GradeEvaluation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditSubjectAddNewStudentRequest;
use App\Http\Requests\Instructors\AddSubjectRequest;
use App\Instructor;
use App\Student;
use App\Subject;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubjectController extends Controller
{
    public const ID_NUMBER_KEY = 0;
    public const RATING_KEY    = 1;

    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->middleware('auth:instructor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructor = Instructor::with(['subjects', 'subjects.students' => function ($query) 
        {
            $query->where('instructor_id', Auth::user()->id);
        }])->find(Auth::user()->id);
        return view('instructor.subjects.index', compact('instructor'));
    }

    public function students($subject)
    {
        $students = Student::whereDoesntHave('subjects', function (Builder $query) use($subject) {
            $query->where('subject_id', '=', $subject);
        })->pluck('id_number')
          ->toArray();

        return Laratables::recordsOf(Student::class, function($query) use($students)
        {
            return $query->whereIn('id_number', $students);
        });

    }

    public function studentForEditSubject($subject)
    {
        $instructor = Instructor::with(['subjects' => function ($query) use ($subject) {
            $query->where('subject_id', $subject)->where('instructor_id', Auth::user()->id);
        }, 'subjects.students' => function ($query) use ($subject) {
            $query->where('subject_id', $subject);
        }])->find(Auth::user()->id);

        $studentsIdNumber = $instructor->subjects->first()->students->pluck('id_number')->toArray();

        return Laratables::recordsOf(Student::class, function($query) use($studentsIdNumber)
        {
            return $query->whereNotIn('id_number', $studentsIdNumber);
        });
    }


    public function subjects()
    {
        return Laratables::recordsOf(Subject::class);
    }

    public function select()
    {
        return view('instructor.subjects.select');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        $daysLeft = "";
        $evaluation = GradeEvaluation::canAdd();
        $canAdd = isset($evaluation->end_date);
        if(isset($evaluation->end_date)) {
            $daysLeft = (int) $evaluation->end_date->format('d') - (int) Carbon::now()->format('d');    
        }
        
        return view('instructor.subjects.create', compact('subject', 'canAdd', 'evaluation', 'daysLeft'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        $evaluation = GradeEvaluation::canAdd();
        $canAdd = isset($evaluation->end_date);
       
        $subjectId = $request->subject_id;
         // Get the instructor.
        $instructor = Instructor::with('subjects')->find(Auth::user()->id);

        $subject = Subject::with('students')->find($subjectId);



        
        // Insert the subject for the instructor.
        $instructor->subjects()->attach($subject);
        

        // Insert all students for this subject.
        foreach ($request->students['ids'] as $index => $id) {
            $subject->students()->attach($id, ['instructor_id' => Auth::user()->id, 'remarks' => $request->students['remarks'][$index] ?? '0']);
        }


        $studentWithNoInstructor = DB::table('student_subjects')->where(['subject_id' => $subjectId, 'instructor_id' => '0'])
                                                                ->first();
        DB::table('student_subjects')->update(['instructor_id' => Auth::user()->id]);                    
        

        return back()->with('success', 'Successfully add new subject named ' . $request->name . ' with ' . count($request->students['ids']) .' students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('instructor.subjects.import_student', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     * Imporation of CSV file.
     * @param  \Illuminate\Http\Request  $request
     * @param  subject id int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $evaluation = GradeEvaluation::canAdd();
        if(!isset($evaluation->end_date)) {
            return back()->withErrors(['message' => 'You are not allowed to add some grade to your students please remove it.']);
        }
        
        DB::beginTransaction();
        try {
            // Checking for Intstructor subject to avoid duplicate subject with same attributes.
            $instructor = Instructor::whereHas('subjects', function ($query) use($id) {
                $query->where(['subject_id' => $id]);
            })->find(Auth::user()->id);

            if (!is_null($instructor)) {
                // The instructor already have this subject.
                 return back()->withErrors(['message' => "You already have this subject if you want to add some changes please proceed to edit subject section."]);
            }

            $destination =  public_path() . time() .'_' .  $request->file('csv')->getClientOriginalName();

            move_uploaded_file($request->file('csv'), $destination);

            $content = str_replace("\r", "", file_get_contents($destination));
            $arrayContent = array_filter(explode("\n", $content));

            foreach ($arrayContent as $key => $student) {
                $studentInfo[] = explode(',', $student);
                $studentInfo[$key][self::ID_NUMBER_KEY] = $this->student->getId( (int) $studentInfo[$key][self::ID_NUMBER_KEY]);
            }

            $studentIdNumbers = array_filter(array_column($studentInfo, self::ID_NUMBER_KEY));

           // Get the instructor.
            $instructor = Instructor::with('subjects')->find(Auth::user()->id);
            
            $subject = Subject::with('students')->find($id);

            // Insert the subject for the instructor.
            $instructor->subjects()->attach($subject);

            foreach ($studentIdNumbers as $key => $id) {
                $subject->students()->attach($id, ['instructor_id' => Auth::user()->id, 'remarks' => $studentInfo[$key][self::RATING_KEY] ?? 0.0 ]);
            }

            DB::commit();
            File::delete($destination);
            return back()->with('success', 'Succesfully add new students to ' . $subject->name . ' - ' . $subject->description);
        } catch (Exception $e) {
            dd($e->getMessage());
            return back();
            DB::rollback();
        }
        
    }

    public function addNewStudent(Subject $subject)
    {
        $daysLeft = "";
        $evaluation = GradeEvaluation::canAdd();
        $canAddStatus = isset($evaluation->end_date);
        $subjects = Subject::all();
        if(isset($evaluation->end_date)) {
            $daysLeft = (int) $evaluation->end_date->format('d') - (int) Carbon::now()->format('d');    
        }
        
        return view('instructor.subjects.add_student', compact('subject', 'subjects', 'evaluation', 'canAddStatus', 'daysLeft'));
    }

    public function submitAddNewStudent(EditSubjectAddNewStudentRequest $request, $subject)
    {
        $evaluation = GradeEvaluation::canAdd();
        if(isset($evaluation->end_date)) {
            DB::beginTransaction();
            try {
                 // Get the instructor.
                $instructor = Instructor::with(['subjects' => function ($query) use ($subject) {
                        $query->where('id', $subject);
                }])->find(Auth::user()->id);
                
                $subject = $instructor->subjects->first();
            
                // Insert all students for this subject.
                foreach ($request->students['ids'] as $index => $id) {
                    $subject->students()->attach($id, ['instructor_id' => Auth::user()->id, 'remarks' => $request->students['remarks'][$index] ]);
                }

                DB::commit();
                return back()->with('success', 'Successfully add new subject named ' . $request->name . ' with ' . count($request->students['ids']) .' students');
              
            } catch (Exception $e) {
                dd($e->getMessage());
                return back();
                DB::rollback();
            }
        } else {
            dd('You can\'t add grade.');
        }
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
