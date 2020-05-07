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
            'NAME' => 'Departemen Unit Kesehatan Siswa Kesehatan',
            'DESCRIPTION' => 'Manajemen kesehatan siswa'
        ]);

        DB::table('departments')->insert([
            'NAME' => 'Departemen Multimedia',
            'DESCRIPTION' => 'Manajemen kurikulum program multimedia'
        ]);

        DB::table('departments')->insert([
            'NAME' => 'Departemen Teknik Audio Visual',
            'DESCRIPTION' => 'Manajemen kurikulum program teknik audio visual'
        ]);

        DB::table('departments')->insert([
            'NAME' => 'Departemen Teknik Komputer Jaringan',
            'DESCRIPTION' => 'Manajemen kurikulum program teknik komputer dan jaringan'
        ]);

        DB::table('departments')->insert([
            'NAME' => 'Departemen Teknik Kendaraan Ringan',
            'DESCRIPTION' => 'Manajemen kurikulum program teknik kendaraan ringan'
        ]);

        DB::table('departments')->insert([
            'NAME' => 'Departemen Teknik Mesin',
            'DESCRIPTION' => 'Manajemen kurikulum program teknik permesinan'
        ]);
        
        DB::table('departments')->insert([
            'NAME' => 'Departemen Teknik Sepeda Motor',
            'DESCRIPTION' => 'Manajemen kurikulum program teknik sepeda motor'
        ]);
    }
}
