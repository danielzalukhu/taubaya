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
            'NAME' => '2016/2017',
            'TYPE' => 'ODD',
            'START_DATE' => '2016-08-12',
            'END_DATE' => '2016-12-12'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2016/2017',
            'TYPE' => 'EVEN',
            'START_DATE' => '2017-02-07',
            'END_DATE' => '2017-06-21'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2017/2018',
            'TYPE' => 'ODD',
            'START_DATE' => '2017-08-14',
            'END_DATE' => '2017-12-19'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2017/2018',
            'TYPE' => 'EVEN',
            'START_DATE' => '2018-02-14',
            'END_DATE' => '2018-06-20'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2018/2019',
            'TYPE' => 'ODD',
            'START_DATE' => '2018-08-06',
            'END_DATE' => '2018-12-20'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2018/2019',
            'TYPE' => 'EVEN',
            'START_DATE' => '2019-02-20',
            'END_DATE' => '2019-06-21'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2019/2020',
            'TYPE' => 'ODD',
            'START_DATE' => '2019-08-05',
            'END_DATE' => '2019-12-20'
        ]);

        DB::table('academic_years')->insert([
            'NAME' => '2019/2020',
            'TYPE' => 'EVEN',
            'START_DATE' => '2020-02-11',
            'END_DATE' => '2020-06-15'
        ]);
    }
}
