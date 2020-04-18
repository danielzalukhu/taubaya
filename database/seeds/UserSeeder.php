<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'NAME' => 'Sarjono Matulesi',
            'EMAIL' => 'sarjono@staff.ac.id',
            'PASSWORD' => Hash::make('sarjono'),
            'ROLE' => 'STAFF',
            'STAFFS_ID' => '1'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Miryanti Ningsih',
            'EMAIL' => 'ningsih@staff.ac.id',            
            'PASSWORD' => Hash::make('ningsih'),
            'ROLE' => 'STAFF',
            'STAFFS_ID' => '2'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Zainal Saifudin',
            'EMAIL' => 'zainal@staff.ac.id',
            'PASSWORD' => Hash::make('zainal'),
            'ROLE' => 'STAFF',
            'STAFFS_ID' => '3'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Roida Rossa',
            'EMAIL' => 'roidaj@staff.ac.id',
            'PASSWORD' => Hash::make('roida'),
            'ROLE' => 'STAFF',
            'STAFFS_ID' => '4'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Berliana Manurung',
            'EMAIL' => 'berliana@staff.ac.id',
            'PASSWORD' => Hash::make('berliana'),
            'ROLE' => 'STAFF',
            'STAFFS_ID' => '5'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Ahmad Abdul',
            'EMAIL' => 'abdul@student.ac.id',
            'PASSWORD' => Hash::make('abdul'),
            'ROLE' => 'STUDENT',
            'STUDENTS_ID' => '1'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Marion Jola',
            'EMAIL' => 'marion@student.ac.id',
            'PASSWORD' => Hash::make('marion'),
            'ROLE' => 'STUDENT',
            'STUDENTS_ID' => '2'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Wilhelm Mozes',
            'EMAIL' => 'wilmozes@student.ac.id',
            'PASSWORD' => Hash::make('mozes'),
            'ROLE' => 'STUDENT',
            'STUDENTS_ID' => '3'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Alan Walker',
            'EMAIL' => 'alan@student.ac.id',
            'PASSWORD' => Hash::make('alan'),
            'ROLE' => 'STUDENT',
            'STUDENTS_ID' => '4'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Daniel Soeparto',
            'EMAIL' => 'suparto@student.ac.id',
            'PASSWORD' => Hash::make('suparto'),
            'ROLE' => 'STUDENT',
            'STUDENTS_ID' => '5'
        ]);
    }
}
