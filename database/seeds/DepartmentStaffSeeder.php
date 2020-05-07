<?php

use Illuminate\Database\Seeder;

class DepartmentStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '1',
            'DEPARTMENTS_ID' => '3'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '2',
            'DEPARTMENTS_ID' => '1'        
        ]);
        
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '3',
            'DEPARTMENTS_ID' => '5'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '4',
            'DEPARTMENTS_ID' => '2'        
        ]);        

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '5',
            'DEPARTMENTS_ID' => '4'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '6',
            'DEPARTMENTS_ID' => '6'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '12',
            'DEPARTMENTS_ID' => '6'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '7',
            'DEPARTMENTS_ID' => '7'        
        ]);
    
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '13',
            'DEPARTMENTS_ID' => '7'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '8',
            'DEPARTMENTS_ID' => '8'        
        ]);
        
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '14',
            'DEPARTMENTS_ID' => '8'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '9',
            'DEPARTMENTS_ID' => '9'        
        ]);

        
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '15',
            'DEPARTMENTS_ID' => '9'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '10',
            'DEPARTMENTS_ID' => '10'        
        ]);
        
        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '16',
            'DEPARTMENTS_ID' => '10'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '11',
            'DEPARTMENTS_ID' => '11'        
        ]);

        DB::table('departments_staffs')->insert([
            'STAFFS_ID' => '17',
            'DEPARTMENTS_ID' => '11'        
        ]);
    }
}
