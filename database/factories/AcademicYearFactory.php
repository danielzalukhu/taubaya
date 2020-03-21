<?php

use Faker\Generator as Faker;
use App\AcademicYear;

$factory->define(AcademicYear::class, function (Faker $faker) {
    return [        
        'type' => $faker->randomElement(['odd','even']),
        'start_date' => $faker->date,
        'end_date' => $faker->date
    ];
});
