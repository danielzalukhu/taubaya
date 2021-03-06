<?php

use Illuminate\Database\Seeder;
use App\achievements;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat nasional',
            'POINT' => '100',
            'GRADE' => 'Nasional',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat propinsi',
            'POINT' => '75',
            'GRADE' => 'Propinsi',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat kota/kabupaten',
            'POINT' => '50',
            'GRADE' => 'Kota',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat kecamatan',
            'POINT' => '25',
            'GRADE' => 'Kota',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser sebagai peserta (tidak juara)',
            'POINT' => '10',
            'GRADE' => 'Kota',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Mengikuti LDKS',
            'POINT' => '15',
            'GRADE' => 'Sekolah',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Diangkat menjadi pengurus OSIS',
            'POINT' => '20',
            'GRADE' => 'Sekolah',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Diangkat menjadi ketua OSIS',
            'POINT' => '25',
            'GRADE' => 'Sekolah',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Tidak pernah alpha (HANYA bagi siswa yang catatan pelanggaran bersih)',
            'POINT' => '25',
            'GRADE' => 'Sekolah',
            'TYPE' => 'NPR'
        ]);
        
        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Tidak pernah terlambat 1 bulan berturut-turut (HANYA bagi siswa yang catatan pelanggaran bersih)',
            'POINT' => '15',
            'GRADE' => 'Sekolah',
            'TYPE' => 'NPR'
        ]);
    }
}
