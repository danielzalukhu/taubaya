<?php

use Faker\Generator as Faker;

use App\Student;
use App\Bank;
use App\Religion;
use App\Classes;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'ATT_ID' => $faker->ssn(),
        'CARD_NUM' => $faker->creditCardNumber,
        'NIS' => $faker->ssn(),
        'PASSWORD' => $faker->password,
        'NISN' =>  $faker->ssn(),
        'NIK' =>  $faker->ssn(),
        'FIRST_NAME' =>  $faker->name,
        'LAST_NAME' => $faker->firstNameMale,
        'GENDER' => $faker->firstNameFemale,
        'BDATE' => $faker->date,
        'MAIL' => $faker->email,
        'PHONE' => $faker->phoneNumber,
        'ADDRESS' => $faker->address,
        'RT' => $faker->randomDigit,
        'RW' => $faker->randomDigit,
        'SUBDISTRICT' => $faker->cityPrefix,                          
        'KELURAHAN' => $faker->citySuffix,
        'CITY' => $faker->city,
        'PROVINCE' => $faker->country,
        'GR_FROM' => $faker->citySuffix,
        'BANK_ACC' => $faker->company,                 
        'is_active' => $faker->randomElement(['yes', 'no']),
        'is_alumni' => $faker->randomElement(['yes', 'no']),
        'NOTES' => $faker->word,
        'YEAR_IN' => $faker->year,
        'IMG_PATH' => $faker->imageUrl($width = 640, $height = 480),
        'banks_id' => function () {
            return factory(Bank::class)->create()->id;
        },
        'religions_id' => function () {
            return factory(Religion::class)->create()->id;
        },
        'classes_id' => function () {
            return factory(Classes::class)->create()->id;
        }
    ];
});
