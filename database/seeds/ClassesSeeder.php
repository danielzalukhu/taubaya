<?php

use Illuminate\Database\Seeder;
use App\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'NAME' => 'X MM 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X MM 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TAV 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TAV 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TKJ 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TKJ 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TKR 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TKR 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TP 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TP 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TSM 1',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'X TSM 2',
            'DESCRIPTION' => 'Tingkat Pertama',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);

        DB::table('classes')->insert([
            'NAME' => 'XI MM 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI MM 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TAV 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TAV 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TKJ 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TKJ 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TKR 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TKR 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TP 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TP 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TSM 1',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XI TSM 2',
            'DESCRIPTION' => 'Tingkat Kedua',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);

        DB::table('classes')->insert([
            'NAME' => 'XII MM 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII MM 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '1',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TAV 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TAV 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '2',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TKJ 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TKJ 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '3',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TKR 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TKR 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '4',
            'STAFFS_ID' => '4'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TP 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '1'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TP 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '5',
            'STAFFS_ID' => '2'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TSM 1',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '3'
        ]);
        DB::table('classes')->insert([
            'NAME' => 'XII TSM 2',
            'DESCRIPTION' => 'Tingkat Ketiga',
            'PROGRAMS_ID' => '6',
            'STAFFS_ID' => '4'
        ]);
    }
}
