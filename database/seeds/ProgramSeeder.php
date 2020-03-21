<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            'NAME' => 'Multimedia',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
        DB::table('programs')->insert([
            'NAME' => 'Teknik Audio Visual',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
        DB::table('programs')->insert([
            'NAME' => 'Teknik Komputer dan Jaringan',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
        DB::table('programs')->insert([
            'NAME' => 'Teknik Kendaraan Ringan',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
        DB::table('programs')->insert([
            'NAME' => 'Teknik Pemesinan',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
        DB::table('programs')->insert([
            'NAME' => 'Teknik Sepeda Motor',
            'DESCRIPTION' => 'Jurusan SMK'
        ]);
    }
}
