<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name'          => 'Bachelor of Science in Education',
                'abbr'          => 'BSED',
                'department_id' => 1
            ],
            [
                'name'          => 'Bachelor of Elementary Education',
                'abbr'          => 'BEED',
                'department_id' => 1
            ],

            [
                'name' => 'Bachelor of Science in Information Tech',
                'abbr' => 'BSIT',
                'department_id' => 2
            ],

            [
                'name' => 'Bachelor of Science in Information System',
                'abbr' => 'BSIS',
                'department_id' => 2
            ],

            [
                'name' => 'Bachelor of Science in Computer Science',
                'abbr' => 'BSCS',
                'department_id' => 2
            ],

            [
                'name' => 'Hotel and Restaurant Management',
                'abbr' => 'HRM',
                'department_id' => 2
            ],

            [
                'name' => 'Associate in Computer Technology',
                'abbr' => 'ACT',
                'department_id' => 2
            ],

            [
                'name' => 'Bachelor of Science in Crimonology',
                'abbr' => 'BSCrim',
                'department_id' => 3,
            ],

            [
                'name' => 'Bachelor of Science in Accountancy',
                'abbr' => 'BSA',
                'department_id' => 4,
            ],

            [
                'name' => 'Bachelor of Science in Business Administration',
                'abbr' => 'BSBA',
                'department_id' => 4,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        
    }
}
