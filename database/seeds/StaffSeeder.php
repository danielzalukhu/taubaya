<?php

use Illuminate\Database\Seeder;
use App\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            'NIK' => '2019112233',
            'NAME' => 'Sarjono Matulesi',
            'ROLE' => 'TEACHER',
            'USERS_EMAIL' => '1',
            'DEPARTMENTS_ID' => '1'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20192345633',
            'NAME' => 'Miryanti Ningseh',
            'ROLE' => 'ADMIN',
            'USERS_EMAIL' => '2',
            'DEPARTMENTS_ID' => '2'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20198899234',
            'NAME' => 'Zainal Saifudin',
            'ROLE' => 'MEDICAL',
            'USERS_EMAIL' => '3',
            'DEPARTMENTS_ID' => '3'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20193459183',
            'NAME' => 'Roida Rossa',
            'ROLE' => 'ADVISOR',
            'USERS_EMAIL' => '4',
            'DEPARTMENTS_ID' => '3'
        ]);
    }
}
