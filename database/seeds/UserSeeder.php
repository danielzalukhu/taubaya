<?php

use Illuminate\Database\Seeder;

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
            'PASSWORD' => 'rahasiadong',
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Ningsih',
            'EMAIL' => 'ningsih@staff.ac.id',            
            'PASSWORD' => 'rahasiaumum',
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Zainal',
            'EMAIL' => 'zainal@staff.ac.id',
            'PASSWORD' => 'rahasiasaya',
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Roida',
            'EMAIL' => 'roidaj@staff.ac.id',
            'PASSWORD' => 'rahasiaroida',
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Marion Jola',
            'EMAIL' => 'marion@student.ac.id',
            'PASSWORD' => 'akucantik',
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Daniel Soeparto',
            'EMAIL' => 'suparto@student.ac.id',
            'PASSWORD' => 'akumuda',
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Ahmad Abdul',
            'EMAIL' => 'abdul@student.ac.id',
            'PASSWORD' => 'suarakubagus',
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Wilhelm Mozes',
            'EMAIL' => 'wilmozes@student.ac.id',
            'PASSWORD' => 'ansos',
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Alan Walker',
            'EMAIL' => 'alan@student.ac.id',
            'PASSWORD' => 'bauketeknya',
            'ROLE' => 'STUDENT'
        ]);

    }
}
