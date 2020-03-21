<?php

use Illuminate\Database\Seeder;
use App\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_years')->insert([
            'TYPE' => 'ODD',
            'START_DATE' => '2016-08-12',
            'END_DATE' => '2016-12-12'
        ]);

        DB::table('academic_years')->insert([
            'TYPE' => 'EVEN',
            'START_DATE' => '2017-02-07',
            'END_DATE' => '2017-06-21'
        ]);

        DB::table('academic_years')->insert([
            'TYPE' => 'ODD',
            'START_DATE' => '2017-08-14',
            'END_DATE' => '2017-12-19'
        ]);

        DB::table('academic_years')->insert([
            'TYPE' => 'EVEN',
            'START_DATE' => '2018-02-14',
            'END_DATE' => '2018-06-20'
        ]);

        DB::table('academic_years')->insert([
            'TYPE' => 'ODD',
            'START_DATE' => '2018-08-06',
            'END_DATE' => '2018-12-20'
        ]);

        DB::table('academic_years')->insert([
            'TYPE' => 'EVEN',
            'START_DATE' => '2019-02-20',
            'END_DATE' => '2019-06-21'
        ]);
    }
}
