<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Admin::create([
				'name' => 'John Doe',
				'email' => 'admin@yahoo.com',
				'password' => '1234',
    	]);
         
    }
}
