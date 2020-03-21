<?php

use Faker\Generator as Faker;
use App\Staff;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        'NIK' => $faker->ssn(),
        'name' => $faker->name,
        'role' => $faker->randomElement(['teacher', 'admin', 'medical', 'advisor']),
        'email' => $faker->email,
        'password' => $faker->password
    ];
});
