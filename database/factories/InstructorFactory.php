<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instructor;
use Faker\Generator as Faker;

$factory->define(Instructor::class, function (Faker $faker) {
    return [
        'firstname' => $faker->name,
        'middlename' => $faker->name,
        'lastname' => $faker->name,
        'gender' => 'male',
        'birthdate' => '2019-09-13 17:06:0',
        'password' => '1234',
        'email' => $faker->email,
        'status' => 'full-time',
        'contact_no' => '09193693499',
        'department_id' => 1,
        'remember_token' => Str::random(10),
    ];
});
