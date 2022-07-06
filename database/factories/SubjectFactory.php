<?php

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => 'Subject - '.$faker->numberBetween(1, 100),
        'description' => 'Description - '.$faker->numberBetween(1, 100),
        'level' => $faker->numberBetween(1, 4),
        'semester' => $faker->numberBetween(1, 2),
        'credits' => $faker->numberBetween(1, 3),
        'school_year' => '2019-2020',
        'department_id' => $faker->numberBetween(1, 4),
        /*'level'       => 1,
        'semester'    => 1,
        'credits'     => 1*/
    ];
});
