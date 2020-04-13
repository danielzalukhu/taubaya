<?php

use Illuminate\Database\Seeder;
use App\KD;

class KdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kd')->insert([
            'NUMBER' => '3.1',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.1.1',
            'DESCRIPTION' => 'Kompetensi Menengah Dasar Keahlian',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.2',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 2',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.2.1',
            'DESCRIPTION' => 'Kompetensi Lanjutan Dasar Keahlian',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.3',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 3',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.4',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 4',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.5',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 5',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.6',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 6',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.7',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 7',
            'SUBJECTS_ID' => '10'
        ]);

        DB::table('kd')->insert([
            'NUMBER' => '3.8',
            'DESCRIPTION' => 'Kompetensi Dasar Keahlian Tingkat 8',
            'SUBJECTS_ID' => '10'
        ]);
    }
}
