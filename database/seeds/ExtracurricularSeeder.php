<?php

use Illuminate\Database\Seeder;

class ExtracurricularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extracurriculars')->insert([
            'NAME' => 'Pramuka',
            'DESCRIPTION' => 'Ekskul pramuka',
            'STAFFS_ID' => '1'
        ]);
        DB::table('extracurriculars')->insert([
            'NAME' => 'Basket',
            'DESCRIPTION' => 'Ekskul basket putra dan putri',
            'STAFFS_ID' => '1'
        ]);
        DB::table('extracurriculars')->insert([
            'NAME' => 'Futsal',
            'DESCRIPTION' => 'Ekskul futsal putra',
            'STAFFS_ID' => '1'
        ]);
        DB::table('extracurriculars')->insert([
            'NAME' => 'Karate',
            'DESCRIPTION' => 'Ekskul karate',
            'STAFFS_ID' => '1'
        ]);
    }
}
