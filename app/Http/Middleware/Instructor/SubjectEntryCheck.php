<?php

namespace App\Http\Middleware\Instructor;

use App\Instructor;
use App\Student;
use App\Subject;
use Auth;
use Closure;

class SubjectEntryCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Refactor this code.
        $studentsAlreadyHaveThisSubject = [];

        // Checking for Intstructor subject to avoid duplicate subject with same attributes.
        $instructor = Instructor::whereHas('subjects', function ($query) use ($request) {
            $query->where(['subject_id' => $request->subject_id]);
        })->find(Auth::user()->id);

        // Checking for student subjects.
        if (! is_null($request->students)) {
            foreach ($request->students['ids'] as $id) {
                $studentsAlreadyHaveThisSubject[] = Student::whereHas('subjects', function ($query) use ($request, $id) {
                    $query->where(['student_id' => $id, 'subject_id' => $request->subject_id])
                          ->where('instructor_id', '!=', '0');
                })->find($id, ['name', 'id_number']);
            }
        }
        if (! is_null($instructor)) {
            return back()->withInput($request->all())->withErrors(['message' => 'You already have this subject please check your subjects if you want to add new student.']);
        } elseif (is_null($request->students)) {
            return back()->withInput($request->only('name', 'description', 'level', 'semester', 'school_year', 'subject_id'))
                                 ->withErrors(['message' => 'Please include your students to this subject.']);
        } elseif (count(array_filter($studentsAlreadyHaveThisSubject)) >= 1) {
            $studentNames = array_column($studentsAlreadyHaveThisSubject, 'name');

            return back()->withInput($request->all())->withErrors(['message' => implode(',', $studentNames).' already have this subject.']);
        } else {
            return $next($request);
        }
    }
}
