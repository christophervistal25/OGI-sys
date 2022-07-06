<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'department_code' => 10001,
            'name' => 'College of Engineering and Computer Science Technology',
            'short_name' => 'CECST',
            'department_head' => '*',
            'department_head_position' => '*',
        ]);
    }
}
