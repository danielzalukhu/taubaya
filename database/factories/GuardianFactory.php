<?php

use Faker\Generator as Faker;

$factory->define(App\Guardian::class, function (Faker $faker) {
    return [
        'FIRST_NAME' => $faker->name,
        'LAST_NAME' => $faker->name,
        'B_YEAR' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'STATUS' => $faker->randomElement(['FATHER' ,'MOTHER', 'OTHER']), 
        'JOB' => $faker->randomElement(['PNS' ,'WIRAUSAHA', 'MANAJER']),
        'EDUACTION' => $faker->randomElement(['SMA' ,'S1', 'S2']),
        'PHONE' => $faker->phoneNumber,
        'EMAIL' => $faker->address,
        'ADDRESS' => $faker->address,
        'STUDENTS_ID' => App\Student::all()->random()->id ,
    ];
});
