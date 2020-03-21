<?php

use Illuminate\Database\Seeder;
use App\Violation;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('violations')->insert([
            'NAME' => 'R-01',
            'DESCRIPTION' => 'Tidak memakai ikat pinggan',
            'POINT' => '10'
        ]);
        
        DB::table('violations')->insert([
            'NAME' => 'R-02',
            'DESCRIPTION' => 'Ikat pinggang tidak berwarna sesuai ketentuan',
            'POINT' => '10'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'R-03',
            'DESCRIPTION' => 'Tidak memakai topi/atribut sesuai ketentuan saat upacara',
            'POINT' => '10'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'R-04',
            'DESCRIPTION' => 'Tidak memakai sepatu hitam sesuai ketentuan',
            'POINT' => '10'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'R-05',
            'DESCRIPTION' => 'Memakai kaos kaki dengan warna bukan putih/tidak sesuai ketentuan',
            'POINT' => '10'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'B-01',
            'DESCRIPTION' => 'Datang terlambat',
            'POINT' => '20'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'B-02',
            'DESCRIPTION' => 'Meninggalkan sekolah tanpa izin/bolos',
            'POINT' => '20'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'B-03',
            'DESCRIPTION' => 'Menghina/melecehkan teman, guru, kepala sekolah dan atau karyawan',
            'POINT' => '25'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'B-04',
            'DESCRIPTION' => 'Membawa/mengkonsumsi rokok di lingkungan sekolah',
            'POINT' => '100'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'B-05',
            'DESCRIPTION' => 'Merokok di luar sekolah dengan memakai baju/atribut SMK St. Louis',
            'POINT' => '100'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'SB-01',
            'DESCRIPTION' => 'Mencuri di lingkungan sekolah',
            'POINT' => '200'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'SB-02',
            'DESCRIPTION' => 'Terlibat tindakan kriminal yang mencemarkan nama baik sekolah',
            'POINT' => '250'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'SB-03',
            'DESCRIPTION' => 'Melakukan tindakan asusila di dalam/luar lingkungan sekolah',
            'POINT' => '250'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'SB-04',
            'DESCRIPTION' => 'Membawa/mengkonsumsi minuman keras/obat-obatan terlarang',
            'POINT' => '250'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'SB-05',
            'DESCRIPTION' => 'Mengederakan barang-barang terlarang di lingkungan sekolah',
            'POINT' => '250'
        ]);

        DB::table('violations')->insert([
            'NAME' => 'TTS',
            'DESCRIPTION' => 'Tidak tuntas dalam mata pelajaran',
            'POINT' => '0'
        ]);
    }
}
