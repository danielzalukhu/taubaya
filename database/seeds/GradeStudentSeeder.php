<?php

use Illuminate\Database\Seeder;

class GradeStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades_students')->insert([
            'STUDENTS_ID' => '1',
            'GRADES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7'            
        ]);

        DB::table('grades_students')->insert([
            'STUDENTS_ID' => '2',
            'GRADES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7'            
        ]);
        
        DB::table('grades_students')->insert([
            'STUDENTS_ID' => '3',
            'GRADES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7'            
        ]);

        DB::table('grades_students')->insert([
            'STUDENTS_ID' => '4',
            'GRADES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7'            
        ]);

        DB::table('grades_students')->insert([
            'STUDENTS_ID' => '5',
            'GRADES_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7'            
        ]);
    }
}
