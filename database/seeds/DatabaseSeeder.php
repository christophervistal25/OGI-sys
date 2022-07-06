<?php

use App\Instructor;
use App\Student;
use App\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Student', 3)->create();
        // factory('App\Subject', 8)->create();
        // factory('App\Subject', 20)->create();
        // factory('App\Instructor', 5)->create();
        $this->call([
            AdminSeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,
            SubjectSeeder::class,
            HRSeeder::class,
            // StudentSeeder::class,
            InstructorSeeder::class,
        ]);

        // Student::all()->each(function ($student) {
        //     Subject::all()->each(function ($subject) use($student) {
        //             $subject->students()->attach($student->id, ['instructor_id' => $instructor->id, 'remarks' => 1]);
        //     });
        // });
    }
}
