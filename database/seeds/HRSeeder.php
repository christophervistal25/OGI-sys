<?php

use App\HR;
use Illuminate\Database\Seeder;

class HRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       HR::create([
				'name' => 'John Doe',
				'email' => 'hr@yahoo.com',
				'password' => 1234,
    	]);
    }
}
