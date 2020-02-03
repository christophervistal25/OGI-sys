<?php

use App\Instructor;
use App\Student;
use App\Subject;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instructor::create([
            'firstname'     => 'Firstname',
            'middlename'    => 'Middlename',
            'lastname'      => 'Lastname',
            'gender'        => 'male',
            'birthdate'     =>  '2019-09-13 17:06:0',
            'password'      => 1234,
            'email'         => 'christophervistal25@gmail.com',
            'status'        => 'full-time',
            'contact_no'    => '09193693499',
            'department_id' => 1,
        ]);

        Instructor::create([
            'firstname'     => 'Firstname2',
            'middlename'    => 'Middlename2',
            'lastname'      => 'Lastname2',
            'gender'        => 'male',
            'birthdate'     =>  '2019-09-13 17:06:0',
            'password'      => 1234,
            'email'         => 'christophervistal26@gmail.com',
            'status'        => 'full-time',
            'contact_no'    => '09193693495',
            'department_id' => 1,
        ]);

        $instructor =  Instructor::find(1);
        $secondInstructor = Instructor::find(2);



        foreach(range(1,4) as $level) {
               foreach(range(1,3) as $semester) {
                    $subjects = Subject::where(['level' =>  $level, 'semester' => $semester])->get();
                    foreach($subjects as $subject) {
                        $instructor->subjects()->attach($subject->id);
                        $secondInstructor->subjects()->attach($subject->id);
                    }
                }
        }
    }
}
