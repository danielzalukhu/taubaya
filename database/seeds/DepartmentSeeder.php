<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'NAME' => 'Departemen ADUM',
            'DESCRIPTION' => 'Manajemen administrasi umum'
        ]);
        DB::table('departments')->insert([
            'NAME' => 'Departemen Pengembangan Karakter',
            'DESCRIPTION' => 'Manajemen pengembangan karakter individu siswa'
        ]);
        DB::table('departments')->insert([
            'NAME' => 'Departemen PENJASKES',
            'DESCRIPTION' => 'Manajemen keolahragaan siswa'
        ]);
        DB::table('departments')->insert([
            'NAME' => 'Departemen Kurikulum',
            'DESCRIPTION' => 'Manajemen struktur kurikulum dan organisasi siswa'
        ]);
        DB::table('departments')->insert([
            'NAME' => 'Departemen Kesehatan',
            'DESCRIPTION' => 'Manajemen kesehatan siswa'
        ]);
    }
}
