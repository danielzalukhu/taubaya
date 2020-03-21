<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'CODE' => 'A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C1-M1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-MM-1',
            'DESCRIPTION' => 'Komputer dan Jaringan Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-MM-2',
            'DESCRIPTION' => 'Pemrograman Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-MM-3',
            'DESCRIPTION' => 'Dasar Desain Grafis',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-1',
            'DESCRIPTION' => 'Desain Grafis Percetakan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-2',
            'DESCRIPTION' => 'Teknik Pengolahan Audio Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-3',
            'DESCRIPTION' => 'Teknik Animasi 2D dan 3D',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-4',
            'DESCRIPTION' => 'Design Media Interaktif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);
        
        // TAV
        
        DB::table('subjects')->insert([
            'CODE' => 'C2-TAV-1',
            'DESCRIPTION' => 'Kerja Bengkel dan Gambar Teknik',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TAV-2',
            'DESCRIPTION' => 'Dasar Listrik dan Elektronika',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TAV-3',
            'DESCRIPTION' => 'Dasar Pemrograman',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TAV-1',
            'DESCRIPTION' => 'Mikroprosesor dan Mikrokontroler',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TAV-2',
            'DESCRIPTION' => 'Penerapan Rangkaian Elektronika',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TAV-3',
            'DESCRIPTION' => 'Perencanaan dan Instalasi Sistem Audio Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-4',
            'DESCRIPTION' => 'Penerapan Sistem Radio dan Televisi',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-5',
            'DESCRIPTION' => 'Perawatan dan Perbaikan Peralatan Audio dan Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-MM-6',
            'DESCRIPTION' => 'Produk Kreatifitas dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        // TKJ

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKJ-1',
            'DESCRIPTION' => 'Komputer dan Jaringan Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKJ-2',
            'DESCRIPTION' => 'Pemrograman Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKJ-3',
            'DESCRIPTION' => 'Dasar Desain Grafis',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKJ-1',
            'DESCRIPTION' => 'Teknologi Jaringan Berbasis Luas',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKJ-2',
            'DESCRIPTION' => 'Administrasi Infrastruktur Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKJ-3',
            'DESCRIPTION' => 'Administrasi Sistem Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => 'C3-TKJ-4',
            'DESCRIPTION' => 'Teknologi Layanan Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKJ-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        // TKR

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKR-1',
            'DESCRIPTION' => 'Gambar Teknik Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKR-2',
            'DESCRIPTION' => 'Teknologi Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TKR-3',
            'DESCRIPTION' => 'Pekerjaan Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKR-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKR-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis dan Pemindaha Tenaga Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKR-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TKR-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        // TP

        DB::table('subjects')->insert([
            'CODE' => 'C2-TP-1',
            'DESCRIPTION' => 'Gambar Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TP-2',
            'DESCRIPTION' => 'Pekejeraan Dasar Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TP-3',
            'DESCRIPTION' => 'Dasar Perancangan Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-1',
            'DESCRIPTION' => 'Gambar Teknik Manufaktur',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-2',
            'DESCRIPTION' => 'Teknik Pemesinan Bubut',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-3',
            'DESCRIPTION' => 'Teknik Pemesinan Frais',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-4',
            'DESCRIPTION' => 'Teknik Pemesinan Gerinda',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-5',
            'DESCRIPTION' => 'Teknik Pemesinan NC/CNC dan CAM',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TP-6',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        // TSM

        DB::table('subjects')->insert([
            'CODE' => 'C2-TSM-1',
            'DESCRIPTION' => 'Gambar Teknik Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TSM-2',
            'DESCRIPTION' => 'Teknologi Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C2-TSM-3',
            'DESCRIPTION' => 'Pekerjaan Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TSM-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TSM-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TSM-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Sepeda Motor dan Pengelolaan Bengkel Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);

        DB::table('subjects')->insert([
            'CODE' => 'C3-TSM-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK'
        ]);
    }
}
