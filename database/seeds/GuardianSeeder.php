<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Guardian;
use App\Student;
use App\User;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 6; $i++){
            $student = Student::all();

            $guardian = Guardian::create([
                'FIRST_NAME' => $faker->firstName,
                'LAST_NAME' => $faker->lastName,
                'B_YEAR' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'STATUS' => $faker->randomElement(['FATHER' ,'MOTHER','OTHER']), 
                'JOB' => $faker->randomElement(['PNS' ,'Wirausaha', 'Manajer', 'Pegawai Swasta']),
                'EDUCATION' => $faker->randomElement(['SMA' ,'S1', 'S2']),
                'PHONE' => $faker->phoneNumber,
                'EMAIL' => $faker->unique()->email,
                'ADDRESS' => $faker->address,
                'STUDENTS_ID' => $student->random()->id
            ]);

            $user = User::create([
                'name' => $guardian->FIRST_NAME . " " . $guardian->LAST_NAME ,
                'email' => $guardian->EMAIL,
                'password' => Hash::make($guardian->FIRST_NAME),
                'ROLE' => 'PARENT',
                'GUARDIANS_ID' => $guardian->id                                             
            ]);
    	}
    }
}
