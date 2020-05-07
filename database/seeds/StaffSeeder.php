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
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20192345633',
            'NAME' => 'Miryanti Ningseh',
            'ROLE' => 'ADMIN',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20198899234',
            'NAME' => 'Zainal Saifudin',
            'ROLE' => 'MEDICAL',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20193459183',
            'NAME' => 'Roida Rossa',
            'ROLE' => 'ADVISOR',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20193112345',
            'NAME' => 'Berliana Manurung',
            'ROLE' => 'HEADMASTER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20184121111',
            'NAME' => 'Sonyawati Tjan',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '201877766221',
            'NAME' => 'Andrias Law',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20181987465',
            'NAME' => 'Velove Vexia',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '201811238899',
            'NAME' => 'Anthony Chin',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20180123910',
            'NAME' => 'Norma Wahyuni',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20180032917',
            'NAME' => 'Wiliam Gozali',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20209019012',
            'NAME' => 'Juna Mansur',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20209916723',
            'NAME' => 'Renata Moelok',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20208710012',
            'NAME' => 'Arnold Almond',
            'ROLE' => 'TEACHER',
        ]);
        
        DB::table('staffs')->insert([
            'NIK' => '20201020991',
            'NAME' => 'Richard Jeremy',
            'ROLE' => 'TEACHER',
        ]);
        
        DB::table('staffs')->insert([
            'NIK' => '202081100991',
            'NAME' => 'Novia Nobel',
            'ROLE' => 'TEACHER',
        ]);

        DB::table('staffs')->insert([
            'NIK' => '20207112561',
            'NAME' => 'Tiara Nyaolo',
            'ROLE' => 'TEACHER',
        ]);
    }
}
