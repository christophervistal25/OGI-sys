<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name'         => 'John Doe',
            // 'level'        => 1,
            'gender'       => 'male',
            'birthdate'    => '2019-09-13 17:06:0',
            'password'     => 1234,
            'course_id'    => 1,
        ]);
    }
}
