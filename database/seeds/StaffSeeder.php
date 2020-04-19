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
            'DEPARTMENTS_ID' => '3'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20192345633',
            'NAME' => 'Miryanti Ningseh',
            'ROLE' => 'ADMIN',
            'DEPARTMENTS_ID' => '1'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20198899234',
            'NAME' => 'Zainal Saifudin',
            'ROLE' => 'MEDICAL',
            'DEPARTMENTS_ID' => '5'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20193459183',
            'NAME' => 'Roida Rossa',
            'ROLE' => 'ADVISOR',
            'DEPARTMENTS_ID' => '2'
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20193112345',
            'NAME' => 'Berliana Manurung',
            'ROLE' => 'HEADMASTER',
            'DEPARTMENTS_ID' => '4'
        ]);
    }
}
