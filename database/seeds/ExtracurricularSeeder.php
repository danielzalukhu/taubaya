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
    }
}
