<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'employment_date' => $faker->date,
        'salary' => $faker->randomFloat(2, 99, 99999),
    ];
});
