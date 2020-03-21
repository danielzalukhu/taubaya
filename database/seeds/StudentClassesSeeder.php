<?php

use Illuminate\Database\Seeder;

class StudentClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes_students')->insert([
            'STUDENTS_ID' => '1',
            'CLASSES_ID' => '2',
            'ACADEMIC_YEAR_ID' => '1'
        ]);
        DB::table('classes_students')->insert([
            'STUDENTS_ID' => '2',
            'CLASSES_ID' => '2',
            'ACADEMIC_YEAR_ID' => '1'
        ]);
        DB::table('classes_students')->insert([
            'STUDENTS_ID' => '3',
            'CLASSES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2'
        ]);
        DB::table('classes_students')->insert([
            'STUDENTS_ID' => '4',
            'CLASSES_ID' => '3',
            'ACADEMIC_YEAR_ID' => '2'
        ]);
        DB::table('classes_students')->insert([
            'STUDENTS_ID' => '5',
            'CLASSES_ID' => '3',
            'ACADEMIC_YEAR_ID' => '3'
        ]);
    }
}
