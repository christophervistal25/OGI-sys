<?php

use App\Student;
use App\Subject;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Student', 50)->create();
        Student::create([
            'name' => 'John Doe',
            // 'level'        => 1,
            'gender' => 'male',
            'birthdate' => '2019-09-13 17:06:0',
            'password' => 1234,
            'course_id' => 1,
            'school_year' => '2020-2021',
            'semester' => 1,
        ]);

        Student::create([
            'name' => 'John Doe2',
            // 'level'        => 1,
            'gender' => 'male',
            'birthdate' => '2019-09-13 17:06:0',
            'password' => 1234,
            'course_id' => 1,
            'school_year' => '2020-2021',
            'semester' => 1,
        ]);

        $student = Student::find(1);
        $secondStudent = Student::find(2);

        foreach (range(1, 4) as $level) {
            foreach (range(1, 3) as $semester) {
                $subjects = Subject::where(['level' => $level, 'semester' => $semester])->get(['id']);
                foreach ($subjects as $subject) {
                    Student::all()->each(function ($s) use ($subject) {
                        $s->subjects()->attach($subject->id, ['instructor_id' => 1, 'remarks' => '1.0']);
                    });
                }
                /*foreach($subjects as $subject) {
                    $student->subjects()->attach($subject->id, ['instructor_id' => 1, 'remarks' => '1.0']);
                    $secondStudent->subjects()->attach($subject->id, ['instructor_id' => 1, 'remarks' => '1.0']);
                }*/
            }
        }
    }
}
