<?php

use Faker\Generator as Faker;
use App\Violation;

$factory->define(Violation::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->word,
        'point' => $faker->buildingNumber
    ];
});
