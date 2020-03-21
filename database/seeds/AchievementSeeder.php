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
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat propinsi',
            'POINT' => '75',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat kota/kabupaten',
            'POINT' => '50',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser tingkat kecamatan',
            'POINT' => '25',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Kejuaraan, kompetisi atau konser sebagai peserta (tidak juara)',
            'POINT' => '10',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Mengikuti LDKS)',
            'POINT' => '15',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Diangkat menjadi pengurus OSIS',
            'POINT' => '20',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Diangkat menjadi ketua OSIS',
            'POINT' => '25',
            'TYPE' => 'PR'
        ]);

        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Tidak pernah alpha (HANYA bagi siswa yang catatan pelanggaran bersih)',
            'POINT' => '25',
            'TYPE' => 'NPR'
        ]);
        
        DB::table('achievements')->insert([
            'DESCRIPTION' => 'Tidak pernah terlambat 1 bulan berturut-turut (HANYA bagi siswa yang catatan pelanggaran bersih)',
            'POINT' => '15',
            'TYPE' => 'NPR'
        ]);
    }
}
