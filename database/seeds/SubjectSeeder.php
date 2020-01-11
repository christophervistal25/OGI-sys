<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach(range(1,4) as $level) {
    		foreach(range(1,2) as $iteration) {
    				foreach(range(1,3) as $semester) {
		    			Subject::create([
		    				'name'        => 'S ' . $level . '-' . $semester . ' ' . rand(1,999),
							'description' => 'Subject' . rand(1,999),
							'level'       => $level,
							'credits'     => 3,
							'semester'    => $semester,
							'school_year' => '2019-2020',
							'department_id' => 1,
						]);
		    		}
    		}
    	}
		/*Subject::create([
			'name'        => 'SS1 1',
			'description' => 'Sample Subject 1',
			'level'       => 1,
			'credits'     => 3,
			'semester'    => 1,
			'school_year' => '2019-2020',
			'department_id' => 1,
		]);
		
		Subject::create([
			'name'        => 'SS1 1',
			'description' => 'Sample Subject 2',
			'level'       => 1,
			'credits'     => 3,
			'semester'    => 2,
			'school_year' => '2019-2020',
			'department_id' => 1,
		]);

		Subject::create([
			'name'        => 'SS1 3',
			'description' => 'Sample Subject 3',
			'level'       => 1,
			'credits'     => 3,
			'semester'    => 3,
			'school_year' => '2019-2020',
			'department_id' => 3,
		]);*/
    }
}
