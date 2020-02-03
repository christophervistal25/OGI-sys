<?php

use App\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Student::class, function (Faker $faker) {
    return [
		'name'           => $faker->name,
		// 'id_number'   => '1501756',
		// 'level'          => 1,
		'gender'         => 'male',
		'birthdate'      =>  '2019-09-13 17:06:0',
		'password'       => '1234',
		// 'remember_token' => Str::random(10),
		'course_id'      => rand(1,10),
    ];
});


