<?php

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'NAME' => 'X MM 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X MM 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TAV 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TAV 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TKJ 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TKJ 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TKR 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TKR 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TP 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TP 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TSM 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'X TSM 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'GRADE' => '10',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);

        DB::table('grades')->insert([
            'NAME' => 'XI MM 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI MM 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TAV 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TAV 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TKJ 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TKJ 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TKR 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TKR 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TP 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TP 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TSM 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XI TSM 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'GRADE' => '11',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);

        DB::table('grades')->insert([
            'NAME' => 'XII MM 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII MM 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TAV 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TAV 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TKJ 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TKJ 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TKR 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TKR 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TP 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TP 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TSM 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('grades')->insert([
            'NAME' => 'XII TSM 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'GRADE' => '12',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);
    }
}
