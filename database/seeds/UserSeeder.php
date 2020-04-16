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
            'PASSWORD' => Hash::make('rahasiadong'),
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Ningsih',
            'EMAIL' => 'ningsih@staff.ac.id',            
            'PASSWORD' => Hash::make('rahasiaumum'),
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Zainal',
            'EMAIL' => 'zainal@staff.ac.id',
            'PASSWORD' => Hash::make('rahasiasaya'),
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Roida',
            'EMAIL' => 'roidaj@staff.ac.id',
            'PASSWORD' => Hash::make('rahasiaroida'),
            'ROLE' => 'STAFF'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Marion Jola',
            'EMAIL' => 'marion@student.ac.id',
            'PASSWORD' => Hash::make('akucantik'),
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Daniel Soeparto',
            'EMAIL' => 'suparto@student.ac.id',
            'PASSWORD' => Hash::make('akumuda'),
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Ahmad Abdul',
            'EMAIL' => 'abdul@student.ac.id',
            'PASSWORD' => Hash::make('suarakubagus'),
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Wilhelm Mozes',
            'EMAIL' => 'wilmozes@student.ac.id',
            'PASSWORD' => Hash::make('ansos'),
            'ROLE' => 'STUDENT'
        ]);

        DB::table('users')->insert([
            'NAME' => 'Alan Walker',
            'EMAIL' => 'alan@student.ac.id',
            'PASSWORD' => Hash::make('bauketeknya'),
            'ROLE' => 'STUDENT'
        ]);

    }
}
